<?php

namespace App\Http\Livewire\Manager\Widget;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class NewUsersWidget extends Component
{
    public int $lastId = 0;
    public int $counter = 0;
    public ?Setting $setting = null;
    protected ?User $user;

    public function boot()
    {
        $this->user = auth()->user();
    }
    public function mount()
    {
        $setting = Setting::query()->where('key', $this->makeKey())->first();
        $this->lastId = (int) ($setting->value ?? 0);
        $this->revalidateCounter();
        $this->setting = $setting;
    }

    public function render()
    {
        $records = $this->revalidateNewUsers();
        return view('livewire.manager.widget.new-users-widget',
            ['records' => $records]
        );
    }

    public function revalidateNewUsers()
    {
        return $this->queryNewUsers()
            ->take(4)
            ->get();
    }

    public function revalidateCounter()
    {
        $this->counter = $this->queryNewUsers()->where('id', '>', $this->lastId)->count();
    }

    public function queryNewUsers(): Builder
    {
        return $this->user->customers()
            ->with(['counterparty'])
            ->with('orders', fn($q) => $q->latest()->take(1))
            ->latest();
    }

    public function flashCounter()
    {
        $setting = $this->setting ?: new Setting();
        $setting->key = $this->makeKey();
        $setting->value = User::query()->latest()->value('id');
        $setting->category = 'last_viewed';
        $setting->save();
    }

    private function makeKey(): string
    {
        $id = (int)auth()->id();
        return "last_viewed_new_users_for_{$id}";
    }
}
