<?php

namespace App\Http\Livewire\Forms\Auth;

use Livewire\Component;

class FormPasswordChange extends Component
{
    public $password;
    public $password_confirmation;

    public bool $autoShow = false;

    protected $success = false;

    protected $rules = [
        'password' => 'required|confirmed|min:6',
    ];

    protected $messages = [
        'password.min' => 'Необхідно ввести більш надійний пароль'
    ];

    public function mount(){
        $this->checkAutoShow();
    }

    public function render()
    {
        if ($this->success){
            return view('livewire.forms.auth.password-change-success');
        }
        return view('livewire.forms.auth.form-password-change');
    }

    public function submit()
    {
        $this->validate();

        $user = auth()->user();
        $user->password = bcrypt($this->password);
        $user->unsetOption('query_password_change_after_login');

        $user->save();

        $this->success = true;
    }

    public function restoreForm()
    {
        $this->reset(['password', 'password_confirmation']);
        $this->success = false;
    }

    protected function checkAutoShow()
    {
        if (auth()->check() && !empty(auth()->user()->getOption('query_password_change_after_login'))){
            $this->autoShow = true;
        }
    }

    public function clearAutoShow()
    {
        if ($user = auth()->user()){

            if ($user->isOptionExists('query_password_change_after_login')) {
                $user->setOption('query_password_change_after_login', false);
                $user->save();
            }

            $this->autoShow = false;
        }
    }
}
