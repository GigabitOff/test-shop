<?php

namespace App\Http\Livewire\Customer\Users;

use Livewire\Component;

class IndexSubmenuRowLivewire extends Component
{
    public string $display = 'all';
    public string $search = '';

    public int $count_all = 0;
    public int $count_new = 0;
    public int $count_change = 0;
    public int $count_moderation = 0;
    public int $count_deleted = 0;

    protected $queryString = [
        'display' => ['except' => 'all'],
    ];

    public function render()
    {
        $res = $this->revalidateData();
        return view('livewire.customer.users.index-submenu-row-livewire', [
            'count' => 0,
        ]);
    }

    protected function revalidateData()
    {
        return [];
    }

    public function setDisplay($display = 'all')
    {
        if ($this->display !== $display) {
            $this->display = $display;
            $this->emit('eventSetUsersSubmenu', $display);
        }
    }
}
