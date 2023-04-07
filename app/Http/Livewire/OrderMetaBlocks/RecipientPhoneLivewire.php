<?php
namespace App\Http\Livewire\OrderMetaBlocks;
use App\Models\User;
use Livewire\Component;
class RecipientPhoneLivewire extends Component
{
    public array $recipients = [];
    public ? int $recipientId = null;
    protected bool $isOpen = false;
    public $recipientPhone;
    public ? int $test = 0;
    protected $listeners = ['recipientNaUpdated'];
    public function render()
    {
            return view('livewire.order-meta-blocks.recipient-phone-livewire', [ 'isOpen' => $this->isOpen, ]);
    }

    public function recipientNaUpdated($value)
    {
        $this->recipientPhone = $value;
        $this->emit('eventSetOrderRecipientPhone', $this->recipientId, $this->recipientPhone);
    }








}
