<?php

namespace App\Actions;

use App\Models\ProductImport;
use App\Services\ProductImporters\ProductArrayImporter;
use App\Services\ProductImporters\ProductXmlImporter;

class ProcessProductImport
{
    /**
     * Процесс обработки импорта товаров
     *
     * @return void
     */
    public function __invoke(ProductImport $import)
    {
        try {
            $import->setStateProcessing()->save();
            $this->work($import);
        } catch (\Exception $e){
            logger('ProcessProductImport error: for id #{$import->id}; ' . $e->getMessage());
            $import->setStateError()->save();
        }
    }

    protected function work(ProductImport $import)
    {
        switch (true){
            case $import->isTypeXml():
                $service = new ProductXmlImporter($import);
                $success = $service->importProductsXml();
                break;
            case $import->isTypeCsv():
                $service = new ProductArrayImporter($import);
                $success = $service->importProductsCsv();
                break;
            case $import->isTypeXls():
                $service = new ProductArrayImporter($import);
                $success = $service->importProductsExcel();
                break;
            default:
                throw (new \Exception('Undefined ProductImportType'));
        }

        $import
            ->setStateResult($success ?? false)
            ->setErrors($service->getMessages())
            ->save();
    }

}
