<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ReceivablesController extends Controller
{
    public function index()
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return 'customer list';
    }


    public function show(User $customer)
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return 'customer data for' . $customer->id;
    }
}
