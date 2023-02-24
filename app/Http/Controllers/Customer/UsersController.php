<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function index()
    {
        Gate::any(['asCustomerLegalAdmin']) ?: abort(403);
        return view('livewire.customer.users.index');
    }

    public function edit($id)
    {
        Gate::any(['asCustomerLegalAdmin']) ?: abort(403);
        return view('livewire.customer.users.edit', ['id' => $id]);
    }

    public function relation()
    {
        Gate::any(['asCustomerLegalAdmin']) ?: abort(403);
        return view('livewire.customer.users.relation');
    }


}
