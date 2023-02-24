<?php

namespace App\Http\Livewire\Forms;

use App\Events\CustomerToLegalInvitationEvent;
use App\Models\Counterparty;
use App\Models\User;
use App\Models\UserNotification;
use Livewire\Component;

class CustomerInvitationLivewire extends Component
{
    public int $recipient_id = 0;
    public int $sender_id = 0;
    public int $counterparty_id = 0;
    public string $result = '';
    public string $phone = '';
    public string $phone_raw = '';

    public bool $isUploadLazyContent = false;
    public string $currentUrl;

    public function mount()
    {
        $this->currentUrl = url()->full();
    }

    protected array $rules = [
        'phone' => 'required|min:12',
    ];

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/[^\d]/', '', $value);

        $this->validateOnly('phone');

        $user = User::query()
            ->role('simple')
            ->where('phone', $this->phone)
            ->first();

        if ($user){
            $this->recipient_id = $user->id;
            $this->result = $user->name;
        } else {
            $this->recipient_id = 0;
            $this->result = __('custom::site.customer_not_found');
        }
    }

    public function render()
    {
        return view('livewire.forms.customer-invitation-livewire');
    }

    public function submit()
    {
        if (!$this->recipient_id){
            return;
        }

        $counterparty = Counterparty::find($this->counterparty_id);

        UserNotification::query()->updateOrCreate(
            [
                'user_id' => $this->recipient_id,
                'type' => 'customerToLegalInvitation',
            ],

            [
            'user_id' => $this->recipient_id,
            'type' => 'customerToLegalInvitation',
            'level' => 'none',
            'event' => CustomerToLegalInvitationEvent::class,
            'message' => sprintf(
                __('custom::site.info_messages.customer_to_legal_invitation_prompt'),
                $counterparty->name
            ),
            'payload' => [
                'sender_id' => auth()->user()->id,
                'counterparty_id' => $counterparty->id,
                'redirect_yes' => true,
                'buttons' => [
                    'yes' => __('custom::site.agree'),
                    'no' => __('custom::site.refuse'),
                ]
            ]
        ]);


        session()->flash('success', __('custom::site.invitation_is_sent'));

    }

    public function uploadLazyContent($payload = null)
    {
        $this->restoreForm();
        $this->isUploadLazyContent = false;

        $this->sender_id = User::whereId((int)($payload['sender_id'] ?? 0))->value('id') ?? 0;
        $this->counterparty_id = Counterparty::whereId((int)($payload['counterparty_id'] ?? 0))->value('id') ?? 0;
        if (!$this->counterparty_id || !$this->sender_id) {
            $this->payload_hash = null;
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.invite_user'),
                'message' => __('custom::site.form_load_error'),
                'state' => 'danger',
            ]);
            return;
        }

        $this->isUploadLazyContent = true;

    }

    public function restoreForm()
    {
        $this->reset(['result', 'phone', 'phone_raw', 'recipient_id', 'sender_id', 'counterparty_id']);
        $this->clearValidation();
    }

}
