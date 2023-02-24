<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Support\Facades\Gate;

class ChatsController extends Controller
{
    public function index()
    {
        Gate::any(['asManager', 'asHeadManager', 'asDirector']) ?: abort(403);
        return view('livewire.manager.chats.index');
    }

    public function show(Chat $chat)
    {
        Gate::any(['asManager', 'asHeadManager', 'asDirector']) ?: abort(403);
        return view('livewire.manager.chats.show', compact('chat'));
    }

}
