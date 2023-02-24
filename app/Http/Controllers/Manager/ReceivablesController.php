<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ReceivablesController extends Controller
{
    public function index()
    {
        Gate::any(['asDirector', 'asManager', 'asHeadManager']) ?: abort(403);
        return 'customer list';
    }


    public function show(User $customer)
    {
        Gate::any(['asDirector', 'asManager', 'asHeadManager']) ?: abort(403);
        return 'customer data for' . $customer->id;
    }
}
