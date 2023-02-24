<?php

namespace App\Http\Livewire\Manager\Widget;

use Livewire\Component;

class PersonalDataWidget extends Component
{
    public $name;
    public $phone;
    public $email;

    protected $user;

    protected $listeners = [
        'eventPersonalDataChanged',
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->user = auth()->user();
    }

    public function mount()
    {
        $this->initFields();
    }

    public function render()
    {

        return view('livewire.manager.widget.personal-data-widget');
    }

    protected function formatPhone($number){
        return preg_replace("/^(\d{2})(\d{3})(\d{3})(\d{4})$/", "+$1($2) $3 $4", $number);
    }

    public function eventPersonalDataChanged()
    {
        $this->initFields();
    }

    protected function initFields(){
        $this->name = $this->user->name;
        $this->phone = $this->formatPhone( $this->user->phone);
        $this->email = $this->user->email;
    }
}
