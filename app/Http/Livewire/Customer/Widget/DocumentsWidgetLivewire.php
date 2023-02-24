<?php

namespace App\Http\Livewire\Customer\Widget;

use App\Models\Document;
use App\Models\User;
use Livewire\Component;

class DocumentsWidgetLivewire extends Component
{
    protected ?User $user;

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        $total = $this->revalidateUnsignedCount();
        $records = $total
            ? $this->revalidateUnSignedDocuments()
            : [];

        return view(
            'livewire.customer.widget.documents-widget-livewire',
            compact('records', 'total')
        );
    }

    protected function revalidateUnsignedCount()
    {
        return $this->searchUnsignedQuery()->count();
    }

    protected function revalidateUnsignedDocuments()
    {
        return $this->searchUnsignedQuery()
            ->select(['id', 'registry_no', 'date_at', 'type', 'path'])
            ->limit(3)->get();
    }

    protected function searchUnsignedQuery()
    {
        return Document::query()
            ->onlyWaybillsAndReconciliations()
            ->where(function ($q) {
                $q->whereInRaw('contract_id', $this->getContractsRawSql())
                    ->orWhereHas('order', function ($q2) {
                        $q2->whereInRaw('customer_id', $this->getCustomersRawSql());
                    });
            })
            ->latest('updated_at');
    }

    protected function getContractsRawSql()
    {
        return $this->user->contracts()->select('id')->toRawSql();
    }

    protected function getCustomersRawSql()
    {
        return $this->user->customers()->select('id')->toRawSql();
    }
}
