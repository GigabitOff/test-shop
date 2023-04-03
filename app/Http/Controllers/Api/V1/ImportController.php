<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Import\PriceImportService;
use App\Services\ImportService;
use App\Traits\JsonResponseFormat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    use JsonResponseFormat;

    protected ImportService $importService;

    public function __construct(ImportService $importService)
    {
        $this->importService = $importService;
    }

    public function setCustomers(Request $request): JsonResponse
    {
        $this->validate($request, ['customers' => 'required']);

        if ($errors = $this->importService->setCustomers($request->customers)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setCounterparties(Request $request): JsonResponse
    {
        $this->validate($request, ['counterparties' => 'required']);

        if ($errors = $this->importService->setCounterparties($request->counterparties)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setCounterpartyRewards(Request $request): JsonResponse
    {
        $this->validate($request, ['rewards' => 'required']);

        if ($errors = $this->importService->setCounterpartyRewards($request->rewards)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setContracts(Request $request): JsonResponse
    {
        $this->validate($request, ['contracts' => 'required']);

        if ($errors = $this->importService->setContracts($request->contracts)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setManagers(Request $request): JsonResponse
    {
        $this->validate($request, ['managers' => 'required']);

        if ($errors = $this->importService->setManagers($request->managers)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setDrivers(Request $request): JsonResponse
    {
        $this->validate($request, ['drivers' => 'required']);

        if ($errors = $this->importService->setDrivers($request->drivers)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setProductsPrice(Request $request): JsonResponse
    {
        $this->validate($request, ['prices' => 'required']);

        if ($errors = $this->importService->setProductPrice($request->prices)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setProductsStock(Request $request): JsonResponse
    {
        $this->validate($request, ['stock' => 'required']);

        if ($errors = $this->importService->setProductsStock($request->stock)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setProductsVariations(Request $request): JsonResponse
    {
        $this->validate($request, ['variations' => 'required']);

        if ($errors = $this->importService->setProductsVariations($request->variations)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setUsersDiscounts(Request $request, PriceImportService $service): JsonResponse
    {
        $this->validate($request, ['discounts' => 'required']);

        if ($errors = $service->setUsersDiscounts($request->discounts)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setBrands(Request $request): JsonResponse
    {
        $this->validate($request, ['brands' => 'required']);

        if ($errors = $this->importService->setBrands($request->brands)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setOrdersRegistered(Request $request): JsonResponse
    {
        $this->validate($request, ['orders' => 'required']);

        if ($errors = $this->importService->setOrdersRegistered($request->orders)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setStatusesList(Request $request): JsonResponse
    {
        $this->validate($request, ['statuses' => 'required']);

        if ($errors = $this->importService->setStatuses($request->statuses)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setOrdersStatuses(Request $request): JsonResponse
    {
        $this->validate($request, ['orders' => 'required']);

        if ($errors = $this->importService->setOrdersStatuses($request->orders)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setOrderTtn(Request $request): JsonResponse
    {
        $this->validate($request, ['orders' => 'required']);

        if ($errors = $this->importService->setOrderTtn($request->orders)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setInvoice(Request $request): JsonResponse
    {
        $this->validate($request, ['invoices' => 'required']);

        if ($errors = $this->importService->setInvoice($request->invoices)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setCategories(Request $request): JsonResponse
    {
        $this->validate($request, ['categories' => 'required']);

        if ($errors = $this->importService->setCategories($request->categories)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setProducts(Request $request): JsonResponse
    {
        $this->validate($request, ['products' => 'required']);

        if ($errors = $this->importService->setProducts($request->products)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setPersonalOffers(Request $request): JsonResponse
    {
        $this->validate($request, ['personal_offers' => 'required']);

        if ($errors = $this->importService->setPersonalOffers($request['personal_offers'])) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setCustomerPersonalOffers(Request $request): JsonResponse
    {
        $this->validate($request, ['customer_personal_offers' => 'required']);

        if ($errors = $this->importService->setCustomerPersonalOffers($request['customer_personal_offers'])) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setAttributes(Request $request): JsonResponse
    {
        $this->validate($request, ['attributes' => 'required']);

        if ($errors = $this->importService->setAttributes($request['attributes'])) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setCounterpartyDebts(Request $request): JsonResponse
    {
        $this->validate($request, ['debts' => 'required']);

        if ($errors = $this->importService->setCounterpartyDebts($request->debts)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setOrderDebts(Request $request): JsonResponse
    {
        $this->validate($request, ['debts' => 'required']);

        if ($errors = $this->importService->setOrderDebts($request->debts)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setDocs(Request $request): JsonResponse
    {
        $this->validate($request, ['docs' => 'required']);

        if ($errors = $this->importService->setDocs($request->docs)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setDocsStatuses(Request $request): JsonResponse
    {
        $this->validate($request, ['docs' => 'required']);

        if ($errors = $this->importService->setDocsStatuses($request->docs)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setDeliveryAddresses(Request $request): JsonResponse
    {
        $this->validate($request, ['addresses' => 'required']);

        if ($errors = $this->importService->setDeliveryAddresses($request->addresses)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setDeliveryTypes(Request $request): JsonResponse
    {
        $this->validate($request, ['delivery_types' => 'required']);

        if ($errors = $this->importService->setDeliveryTypes($request->delivery_types)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setStorages(Request $request): JsonResponse
    {
        $this->validate($request, ['storages' => 'required']);

        if ($errors = $this->importService->setStorages($request->storages)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setTransferred(Request $request): JsonResponse
    {
        $this->validate($request, ['targets' => 'required']);

        if ($errors = $this->importService->setTransferred($request->targets)) {
            return $this->error('Some data wrong', 200, $errors);
        }

        return $this->success([], 'Import success');
    }

    public function setUsersChat(Request $request): JsonResponse
    {
        $this->validate($request, ['chat' => 'required']);

        //dd($request);
        $res = $this->importService->setUserChat($request->chat);

        if (isset($res['error'])) {
            return $this->error('Some data wrong', 200, $res['error']);
        } else {
           // return $this->success([$res], 'Import success');
        }

        return $this->success([], 'Import success');
    }

}
