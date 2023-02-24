<?php

namespace App\Http\Livewire\Admin\Forms;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;

class SelectColorLivewire extends Component
{
    public string $color = '';

    protected $listeners = [
        'eventSetColor'
    ];

    public function render()
    {
        return view('livewire.admin.forms.select-color-livewire');
    }

    public function eventSetColor($payload)
    {
        $this->color = $payload['color'] ?? '';
        $show = $payload['show'] ?? true;

        if ($show) {
            $this->dispatchBrowserEvent('showModal', [
                'modalId' => 'm-select-color',
            ]);
            $this->dispatchBrowserEvent('setColorToPicker', [
                'color' => $this->color
            ]);
        }
    }

}
