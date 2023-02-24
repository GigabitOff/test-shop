<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class OrderProductsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // Собираем в строки "sku qty" и очищаем от пустых элементов
        $rows = $collection
            ->map(function (Collection $row) {
                return trim(
                    $row->map(function ($item) {
                        // очищаем от лишних пробелов
                        return trim(preg_replace('/\s+/', ' ', $item));
                    })
                    ->join(' ')
                );
            })
            ->filter()
            ->toArray();

        session()->put('importOrderProducts', $rows);

    }
}
