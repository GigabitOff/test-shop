<?php

namespace App\Http\Livewire\Manager\Widget;

use Livewire\Component;

class MenuWidget extends Component
{
    public $user_name;
    public $user;

    protected $listeners = [];

    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->user = auth()->user();
    }

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.manager.widget.menu-widget');
    }
}
