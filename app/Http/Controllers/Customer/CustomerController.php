<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function toDashboard()
    {
        return redirect()->route('customer.dashboard');
    }

    public function dashboard()
    {
        Gate::any(['asCustomerSimple', 'asCustomerLegal']) ?: abort(403);
        return view('livewire.customer.cabinet-customer');
    }

    public function discounts()
    {
        Gate::any(['asCustomerSimple', 'asCustomerLegalAdmin']) ?: abort(403);
        return view('livewire.customer.discounts.index');
    }

    public function comparisons()
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return view('livewire.customer.comparisons');
    }

    public function favorites()
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return view('livewire.customer.favorites');
    }

    public function debts()
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return view('livewire.customer.receivables');
    }

    public function cart()
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return view('livewire.cart');
    }

}
