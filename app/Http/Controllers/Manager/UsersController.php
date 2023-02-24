<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function index()
    {
        Gate::any(['asManager', 'asHeadManager']) ?: abort(403);
        return view('livewire.manager.users.index');
    }

    public function relation()
    {
        Gate::any(['asManager', 'asHeadManager']) ?: abort(403);
        return view('livewire.manager.users.relation');
    }

}
