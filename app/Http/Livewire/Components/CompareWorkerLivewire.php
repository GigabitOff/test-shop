<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class CompareWorkerLivewire extends Component
{
    protected $listeners = [
        'eventToggleComparisons',
        'eventRemoveComparisonsItem',
        'eventAddComparisonsItem',
        'eventClearComparisons',
    ];

    public function render()
    {
        return view('livewire.components.compare-worker-livewire');
    }

    public function eventToggleComparisons($payload)
    {
        $product_id = $payload['product_id'];
        comparisons()->toggleProduct($product_id);
        $this->emit('eventComparisonsChanged');
        $this->dispatchComparisonsToggle($product_id);
    }

    public function eventRemoveComparisonsItem($payload)
    {
        $product_id = $payload['product_id'];
        comparisons()->removeProduct($product_id);
        $this->emit('eventComparisonsChanged');
        $this->dispatchComparisonsToggle($product_id);
    }

    public function eventAddComparisonsItem($payload)
    {
        $product_id = $payload['product_id'];
        comparisons()->addProduct($product_id);
        $this->emit('eventComparisonsChanged');
        $this->dispatchComparisonsToggle($product_id);
    }

    public function eventClearComparisons()
    {
        comparisons()->clear();
        $this->emit('eventComparisonsChanged');
    }

    private function dispatchComparisonsToggle($product_id)
    {
        $this->dispatchBrowserEvent('comparisonsToggle', [
            'product' => $product_id,
            'exist' => comparisons()->isExistProduct($product_id),
        ]);
    }

}
