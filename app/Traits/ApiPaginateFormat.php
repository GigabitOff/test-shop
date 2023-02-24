<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait ApiPaginateFormat
{
    /**
     * Return a success JSON response.
     *
     * @param LengthAwarePaginator $paginator
     * @param string $resourceClass // Must derive from Illuminate\Http\Resources\Json\JsonResource
     * @return array
     */
    protected function summary( LengthAwarePaginator $paginator, string $resourceClass): array
    {

        return [
            'data' => $resourceClass::collection($paginator)->toArray(null),
            'summary' => [
                'total_records' => $paginator->total(),
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'page_records' => $paginator->count(),
                'total_pages' => $paginator->lastPage(),
            ]
        ];
    }
}
