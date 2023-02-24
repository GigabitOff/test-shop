<?php

namespace App\Http\Livewire\OrderMetaBlocks;

use App\Models\User;
use Livewire\Component;

class RecipientSelectorLivewire extends Component
{
    public User $customer;

    public array $recipients = [];
    public ?int $recipientId = null;
    public ?string $recipientName = null;

    protected bool $isOpen = false;

    public function mount()
    {
        $this->revalidateRecipientList();
    }

    public function render()
    {
        return view('livewire.order-meta-blocks.recipient-selector-livewire', [
            'isOpen' => $this->isOpen,
        ]);
    }

    public function updatedRecipientName($value)
    {
        $value = trim($value);
        $this->revalidateRecipientList($value);

        $this->isOpen = true;
        $this->recipientId = null;
    }

    public function setClient($id, $name)
    {
        $this->recipientId = $id;
        $this->recipientName = $name;
        $this->emit('eventSetOrderRecipient', $id, $name);
    }

    public function setName()
    {
        $this->emit('eventSetOrderRecipient', $this->recipientId, $this->recipientName);
    }

    protected function revalidateRecipientList($value = '')
    {
        $query = $this->customer->recipients()->orderBy('name');
        if ($value){
            $query->where('name', 'like', "%$value%");
        }

        $this->recipients = $query->take(10)->get()
            ->keyBy('id')->map->name->toArray();
    }

}
