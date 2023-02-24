<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ManagerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        if ($user->hasRole('director')) {
            Gate::any(['asDirector']) ?: abort(403);
            return view('livewire.manager.cabinet-director');
        } elseif ($user->hasRole('manager')) {
            Gate::any(['asManager']) ?: abort(403);
            return view('livewire.manager.cabinet-manager');
        } elseif ($user->hasRole('head_manager')) {
            Gate::any(['asHeadManager']) ?: abort(403);
            return view('livewire.manager.cabinet-head-manager');
        }
        abort(403);
    }

    public function cart()
    {
        Gate::any(['asManager', 'asHeadManager']) ?: abort(403);
        return view('livewire.manager.cart');
    }

    public function debts(Request $request)
    {
        Gate::any(['asDirector', 'asManager', 'asHeadManager']) ?: abort(403);

        if ($param = $request->get('contract_id')){
            if (Contract::query()->whereId($param)->exists()) {
                return view('livewire.manager.debts.show');
            }
        }
        return view('livewire.manager.debts.index');
    }

    public function customers()
    {
        return view('livewire.manager.customers');
    }

}
