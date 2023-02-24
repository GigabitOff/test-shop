<?php

namespace App\Http\Livewire\Forms;

use App\Imports\OrderProductsImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class BulkUploadOrderProductsLivewire extends Component
{
    use WithFileUploads;

    public $file;
    public string $manual = '';
    public array $productRows = [];

    protected array $rules = [
        'file' => [
            'mimes:xls,xlsx',
            'max:25600', // 25MB Max
        ]
    ];

    protected $listeners = [
        'eventParseDataCorrection',
        'eventBulkOrderProductsUploaded'
    ];

    public function mount()
    {
        session()->forget('importOrderProducts');
    }

    public function render()
    {
        return view('livewire.forms.bulk-upload-order-products-livewire');
    }

    public function updatedFile($value)
    {
        $this->validate();

        $path = $this->file->storeAs('excel', 'temp-order.' . $value->getClientOriginalExtension());
        Excel::import(app(OrderProductsImport::class), $path);

        $this->productRows = session()->get('importOrderProducts', []);

        $this->forceToParse();
    }

    public function messages(): array
    {
        return [
            'file.mimes' => __('custom::site.select_excel_file_type'),
        ];
    }

    public function addProductsToParse()
    {
        $rows = collect(preg_split('/\r\n|\r|\n/', $this->manual))
            ->each(function ($row) {
                // очищаем от лишних пробелов
                return trim(preg_replace('/\s+/', ' ', $row));
            })->filter()->toArray();

        session()->put('importOrderProducts', $rows);

        $this->forceToParse();
    }

    public function forceToParse()
    {
        $this->emit('eventParseDataShow');
    }

    public function eventParseDataCorrection($payload)
    {
        $this->manual = $payload ?? '';
        $this->dispatchBrowserEvent('bulkUploaderSelectorShow');
    }

    public function eventBulkOrderProductsUploaded()
    {
        $this->reset('manual');
        session()->forget('importOrderProducts');
    }
}
