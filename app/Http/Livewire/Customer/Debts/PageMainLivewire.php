<?php

namespace App\Http\Livewire\Customer\Debts;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Http\Livewire\Traits\WithPerPage;
use App\Models\ContractDebt;
use App\Models\Counterparty;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Services\ReconciliationService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class PageMainLivewire extends Component
{
    use WithPagination;
    use WithPerPage;
    use WithFilterableDropdown;

    public array $filterableContracts = [];

    protected ?User $customer;
    protected bool $revalidateTable = false;
    protected string $paginationTheme = 'paginator-buttons';

    public function boot()
    {
        $this->customer = auth()->user();
    }

    public function mount()
    {
        $this->initFilterable();

        // обновляем список контрактов
        $this->contract_list = $this->revalidateContractList();
    }

    public function render()
    {
        if ($this->revalidateTable) {
            $this->dispatchBrowserEvent('updateFooData');
        }

        $orders = $this->revalidateOrders();
        $debt = $this->revalidateDebt();

        $table = view(
            'livewire.customer.debts.footable-render',
            compact('orders')
        )->render();

        return view('livewire.customer.debts.page-main-livewire', [
            'table' => $table,
            'orders' => $orders,
            'debt' => $debt,
            'filterableMode' => $this->filterableMode,
        ]);
    }

    public function updatedContractId($value)
    {
        $this->revalidateTable = true;
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->revalidateTable = true;
    }

    protected function onSetFilterableContracts($id, $name)
    {
        $this->revalidateTable = true;
    }

    protected function onResetFilterableContracts()
    {
        $this->revalidateTable = true;
    }

    public function revalidateOrders(): LengthAwarePaginator
    {
        $query = Order::query()
            ->with(['contract', 'paymentType.translation'])
            ->where('debt_sum', '>', 0)
            ->whereRelation('contract', 'id', '=', $this->filterableContracts['id']);

        return $query->paginate($this->getPerPageValue());
    }

    public function revalidateDebt()
    {
        return ContractDebt::query()
            ->where('contract_id', $this->filterableContracts['id'])
            ->firstOrNew();
    }

    public function revalidateContractList(): array
    {
        return $this->customer->contracts()
            ->with('counterparty:name,id')
            ->select('registry_no', 'id', 'counterparty_id')
            ->get()->keyBy('id')
            ->map(fn($el) => "{$el->registry_no} -- {$el->counterparty->name}")
            ->toArray();
    }

    public function unloadBalance()
    {
        $counterparty = Counterparty::query()
            ->whereRelation('contracts', 'id', '=', $this->filterableContracts['id'])
            ->first();

        try {
            $settings = Setting::query()
                ->where('category', 'api-settings')
                ->get();
            $url = $settings->firstWhere('key', 'getbalancedata_url')->value ?? '';
            $authorization = $settings->firstWhere('key', 'getbalancedata_authorization')->value ?? '';

            $payload = [
                'user_id_1c' => $this->customer->id_1c,
                'counterparty_id_1c' => $counterparty->id_1c,
                'date_start' => now()->subMonth()->format('Ymd'),
                'date_end' => now()->format('Ymd'),
            ];

            $dir = "counterparty/{$counterparty->id}/balance";
            // подчищаем старые файлы
            File::cleanDirectory(Storage::disk('public')->path($dir));

            $headers = $authorization
                ? ['Authorization' => $authorization]
                : [];

//            $url = 'http://tm.fairtech.local/getbalance';
            $rawResponse = Http::withHeaders($headers)->get($url, $payload)->throw();

            // Удаляем bom байты
            $body = preg_replace('/^([^\{]+)/', '', $rawResponse->body());

            $response = json_decode($body);

            if ($response) {
                if ('success' === $response->status) {
                    $filename = $response->content->file_name;
                    $filePath = "{$dir}/{$filename}";
                    $fileContent = base64_decode($response->content->file_content);

                    Storage::disk('public')->put($filePath, $fileContent);

                    $this->dispatchBrowserEvent('openUnloadBalance', [
                        'url' => Storage::disk('public')->url($filePath)
                    ]);

                    //                // Просто отдает файл на выгрузку
                    //                return response()->streamDownload(function () use($fileContent){
                    //                    echo $fileContent;
                    //                }, $filename);
                } else {
                    $this->dispatchBrowserEvent('flashMessage', [
                        'title' => __('custom::site.unload_balance'),
                        'message' => __('custom::site.data_is_absent'),
                        'state' => 'warning'
                    ]);
                }
            } else {
                throw(new \Exception('Response error for: ' . json_encode($payload)));
            }
        } catch (\Exception $e) {
            logger('UnloadBalance error: ' . $e->getMessage());
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.unload_balance'),
                'message' => __('custom::site.unload_balance_error'),
                'state' => 'warning'
            ]);
        }
    }

    public function uploadReconciliationActs()
    {
        $counterparty = Counterparty::query()
            ->whereRelation('contracts', 'id', '=', $this->filterableContracts['id'])
            ->first();

        try {
            $model = ReconciliationService::uploadFrom1C($counterparty, $this->customer);

            if ($model) {
                $this->dispatchBrowserEvent('uploadReconciliationActs', [
                    'url' => Storage::disk('public')->url($model->uri)
                ]);
            } else {
                $this->dispatchBrowserEvent('flashMessage', [
                    'title' => __('custom::site.reconciliation_act'),
                    'message' => __('custom::site.data_is_absent'),
                    'state' => 'warning'
                ]);
            }
        } catch (\Exception $e) {
            logger('uploadReconciliationActs error: ' . $e->getMessage());
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.reconciliation_act'),
                'message' => __('custom::site.reconciliation_act_upload_error'),
                'state' => 'warning'
            ]);
        }
    }

    public function isContractSelected(): bool
    {
        return (bool) $this->filterableContracts['id'];
    }

    protected function setFilterableContractsList($value): array
    {
        return $this->customer->contracts()
            ->with('counterparty:name,id')
            ->select('registry_no', 'id', 'counterparty_id')
            ->get()->keyBy('id')
            ->map(fn($el) => "{$el->registry_no} -- {$el->counterparty->name}")
            ->toArray();
    }
}
