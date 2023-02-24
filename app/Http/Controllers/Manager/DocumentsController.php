<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Gate;

class DocumentsController extends Controller
{
    public function index()
    {
        Gate::any(['asManager', 'asHeadManager']) ?: abort(403);
        return view('livewire.manager.documents.index');
    }

    public function createReverseInvoice(Order $order)
    {
        Gate::any(['asManager', 'asHeadManager']) ?: abort(403);
        return view('livewire.manager.documents.reverse-invoice.create');
    }

    public function createComplaint(Order $order)
    {
        Gate::any(['asManager', 'asHeadManager']) ?: abort(403);
        return view('livewire.manager.documents.complaint.create');
    }
}
