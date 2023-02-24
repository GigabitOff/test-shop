<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Компонент информационного модального окна
 */
class ModalInfo extends Component
{
    public $message;
    public $key;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (session('show_message_popup')){
            $this->key = session('show_message_popup');
            $this->message = __("custom::site.info_messages.{$this->key}");
        }
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if ($this->key){
            return view('components.modal-info');
        }

        return '';
    }
}
