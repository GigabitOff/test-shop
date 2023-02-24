<?php

namespace App\Http\Livewire\Manager\Widget;

use App\Models\Document;
use App\Models\User;
use Livewire\Component;

class ComplaintsWidget extends Component
{
    protected ?User $user;

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        $totalCount = $this->complaintsCount();
        $documents = $totalCount
            ? $this->revalidateComplaints()
            : [];

        return view('livewire.manager.widget.complaints-widget',
            compact('documents', 'totalCount')
        );
    }

    protected function complaintsCount()
    {
        return $this->complaintsQuery()->count();
    }

    public function revalidateComplaints()
    {
        return $this->complaintsQuery()->take(3)->get();
    }

    public function complaintsQuery()
    {
        $sub = $this->user->customers()->select('id')->toRawSql();
        return Document::query()
            ->onlyComplaints()
            ->onlyNew()
            ->whereHas('order', fn($q) => $q->whereInRaw('customer_id', $sub))
            ->with('products.translations')
            ->with('order.customer');
    }
}
