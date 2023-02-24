<?php

namespace App\Http\Controllers\Api\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Mobile\V1\ContractResource;
use App\Http\Resources\Api\Mobile\V1\CounterpartyResource;
use App\Traits\ApiPaginateFormat;
use App\Traits\JsonResponseFormat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CounterpartyExportController extends Controller
{
    use JsonResponseFormat;
    use ApiPaginateFormat;

    protected $perPage;

    public function __construct()
    {
        $this->perPage = config('app.api.export.per_page', 100);
    }

    /**
     * Экспорт контрагентов
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getCounterparties(Request $request): JsonResponse
    {
        $counterparties = $request->user()->counterparties()
            ->with('contracts')->get();

       return $this->success(CounterpartyResource::collection($counterparties));
    }

    /**
     * Экспорт контрактов.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getContracts(Request $request): JsonResponse
    {
        $contracts = $request->user()->contracts()->get();

       return $this->success(ContractResource::collection($contracts));
    }

}
