<?php

namespace App\Http\Livewire\Components;

use App\Imports\OrderProductsImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class FileExcelInputLivewire extends Component
{
    use WithFileUploads;

    public $file;
    public array $diff = [];

    protected array $rules = [
        'file' => [
            'mimes:xls,xlsx',
            'max:25600', // 25MB Max
        ]
    ];

    public function render()
    {

        return view('livewire.components.file-excel-input-livewire');
    }

    public function updatedFile($value)
    {
        $this->validate();

        $path = $this->file->storeAs('excel', 'temp-order.' . $value->getClientOriginalExtension());
        Excel::import(new OrderProductsImport(), $path);

        $this->diff = session()->get('importOrderProductsFail', []);

        $this->emit('eventFileExcelUploaded');

    }

    public function messages(): array
    {
        return [
            'file.mimes' => __('custom::site.select_excel_file_type'),
        ];
    }

}
