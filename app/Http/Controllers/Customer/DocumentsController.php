<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Gate;

class DocumentsController extends Controller
{
    public function index()
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return view('livewire.customer.documents.index');
    }

    public function createReverseInvoice(Order $order)
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return view('livewire.customer.documents.reverse-invoice.create');
    }

    public function createComplaint(Order $order)
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return view('livewire.customer.documents.complaint.create');
    }
}
