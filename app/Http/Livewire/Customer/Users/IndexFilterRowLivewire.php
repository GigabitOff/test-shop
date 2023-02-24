<?php

namespace App\Http\Livewire\Customer\Users;

use App\Models\User;
use Livewire\Component;

class IndexFilterRowLivewire extends Component
{
    public string $fio = '';
    public $fio_id;
    public array $fio_list = [];

    public string $position_id = '';
    public array $position_list = [];

    public $date_start;
    public $date_end;

    public $search = '';
    public $search_id;
    public array $search_list = [];

    public $mode = '';

    protected ?User $leader;
    protected array $revalidateJsItems = [];

    protected $listeners = [
        'eventResetFilters',
        'eventSetFilterToCustomer',
    ];

    public function boot()
    {
        $this->leader = auth()->user();
    }

    public function mount()
    {
        $this->setAvailablePositions();
    }

    public function updatedSearch($value)
    {
        $this->search_list = $this->searchByAll($value);
        $this->mode = !empty($this->search_list) ? 'search' : '';
    }

    public function updatedFio($value)
    {
        $this->fio_list = $this->searchByName($value);
        $this->mode = !empty($this->fio_list) ? 'fio' : '';
    }

    public function updatedPositionId($value)
    {
        $this->resetLists();
        $this->mode = '';
        $this->emitRevalidateTable();
    }

    public function updatedDateStart($value)
    {
        $this->resetLists();
        $this->mode = '';
        $this->emitRevalidateTable();
        $this->updatePosition();
    }

    public function updatedDateEnd($value)
    {
        $this->resetLists();
        $this->mode = '';
        $this->emitRevalidateTable();
        $this->updatePosition();
    }

    public function render()
    {
        if ($this->revalidateJsItems) {
            $this->emit('revalidate', $this->uniqueJsItems($this->revalidateJsItems));
        }
        return view('livewire.customer.users.index-filter-row-livewire');
    }

    public function setFilteredFio($data)
    {
        $this->fio = $data['value'];
        $this->reset('mode');
        if ($this->fio_id != $data['id']) {
            $this->fio_id = $data['id'];
            $this->emitRevalidateTable();

            $this->updatePosition();
        }
    }

    public function setFilteredSearch($data)
    {
        $this->search = $data['value'];
        $this->reset('mode');
        if ($this->search_id != $data['id']) {
            $this->fio = $this->search;
            $this->search_id = $data['id'];
            $this->fio_id = $data['id'];
            $this->emitRevalidateTable();

            $this->updatePosition();
        }
    }

    public function clearFilteredFio()
    {
        $this->reset(['fio', 'fio_list', 'fio_id']);
        $this->emitRevalidateTable();

        $this->updatePosition();
    }


    /** События */

    public function eventResetFilters()
    {
        $this->reset([
            'search',
            'search_list',
            'search_id',
            'fio',
            'fio_list',
            'fio_id',
            'position_list',
            'position_id',
            'date_start',
            'date_end',
        ]);
        $this->updatePosition();
        $this->emitRevalidateTable();
    }

    public function eventSetFilterToCustomer($data)
    {
        $this->reset([
            'fio',
            'fio_list',
            'fio_id',
            'position_list',
            'position_id',
            'date_start',
            'date_end',
        ]);
        $this->fio = $data['name'] ?? null;
        $this->fio_id = $data['id'] ?? null;
        $this->updatePosition();
        $this->emitRevalidateTable();
    }

    /** Служебные функции */

    protected function emitRevalidateTable()
    {
        $this->emit('eventRevalidateTable', [
            'customerId' => $this->fio_id,
            'position' => $this->position_id,
            'ordersDateFrom' => $this->date_start,
            'ordersDateTo' => $this->date_end,
        ]);
    }

    protected function resetLists()
    {
        $this->reset(['search_list', 'fio_list']);
    }

    protected function searchByAll($value)
    {
        return $this->leader->customers()
            ->withTrashed()
            ->where(function ($q) use ($value) {
                $value = trim($value);
                $q->whereTranslationLike('name', "%{$value}%")
                    ->orWhereDigitFieldLike('phone', "%{$value}%")
                    ->orWhere('position', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%");
            })
            ->take(10)->get()->keyBy('id')->toArray();
    }

    protected function searchByName($value)
    {
        $value = trim($value);
        return $this->customersFilter($this->leader->customers())
            ->withTrashed()
            ->whereUserNameLike("%{$value}%")
            ->take(10)->get()->keyBy('id')->toArray();
    }

    protected function setAvailablePositions()
    {
        $customersQuery = $this->customersFilter($this->leader->customers());
        $this->position_list = $customersQuery
            ->select('position as id', 'position as name')
            ->toBase()->get()->keyBy('id')
            ->map(function ($el) {
                return [
                    'id' => $el->id,
                    'name' => $el->name,
                ];
            })->toArray();
    }

    protected function customersFilter($query)
    {
        $query->withTrashed();

        if ($this->fio_id) {
            $query->whereUserId($this->fio_id);
        }
        if ($this->position_id) {
            $query->whereUserPosition($this->position_id);
        }
        if ($this->date_start) {
            $query->whereUserOrdersDateFrom($this->date_start);
        }

        if ($this->date_end) {
            $query->whereUserOrdersDateTo($this->date_end);
        }
        return $query;
    }

    private function updatePosition()
    {
        if (!$this->position_id) {
            $this->setAvailablePositions();
            $this->revalidateJsPositionSelect();
        }
    }

    private function revalidateJsPositionSelect()
    {
        $this->revalidateJsItems['nice_select'][] =
            '.lk-user-table-filter select[name="position"]';
    }

    private function uniqueJsItems($data)
    {
        foreach ($data as &$item) {
            $item = array_unique($item);
        }
        return $data;
    }
}
