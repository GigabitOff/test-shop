<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Support\Facades\Gate;

class ChatsController extends Controller
{
    public function index()
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return view('livewire.customer.chats.index');
    }

    public function show(Chat $chat)
    {
        Gate::any(['asCustomerRegistered']) ?: abort(403);
        return view('livewire.customer.chats.show', compact('chat'));
    }

}
