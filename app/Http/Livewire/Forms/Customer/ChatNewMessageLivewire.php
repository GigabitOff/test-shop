<?php

namespace App\Http\Livewire\Forms\Customer;

use App\Models\Chat;
use App\Models\User;
use App\Models\Popup;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChatNewMessageLivewire extends Component
{
    public string $managerName = '';
    public string $newText = '';
    public $subject = 'Повідомлення з попап клієнт',
        $popup_id = 4,
        $emailSend,
        $popup;

    protected array $rules = [
        'newText' => 'required',
    ];

    public function mount()
    {
        if ($manager = auth()->user()->manager){
            $this->managerName = $manager->name;
        }
    }

    public function render()
    {
        return view('livewire.forms.customer.chat-new-message-livewire');
    }

    public function submit()
    {
        $this->validate();

        //$managers = $this->getManagers($this->popup_id);
        $popup = Popup::where('id', $this->popup)->first();
        //dd($this->popup);
        $customer_id = null;

        if (!$popup) {
            $this->popup_id = null;
        } else {
            $this->subject = $popup->name;
            $this->popup_id = $this->popup;
        }

        /** @var User $customer */
        $customer = auth()->user();
        try {
            DB::beginTransaction();
            $chat = $customer->chats()->create([
                'manager_id' => $customer->manager_id,
                'source' => Chat::SOURCE_PRIVATE,
                'subject' => $this->subject,
                'popup_id' => $this->popup_id,
            ]);
            $chat->messages()->create([
                'owner_id' => $customer->id,
                'message' => $this->newText,
            ]);

            $this->newText = '';

            $this->emit('eventNewChatCreated');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            logger('Chat new message create error: ' . $e->getMessage());
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.message'),
                'message' => __('custom::site.send_message_error'),
                'state' => 'danger'
            ]);
        }
    }

    public function getManagers($id)
    {
        $managers = null;
        $popup = Popup::find($id);
        $this->popup = $popup;
        if ($popup) {
            $contucts = $popup->contucts;
            if (count($contucts) > 0) {
                foreach ($contucts as $key_c => $value_c) {
                    if (count($value_c->users) > 0) {
                        foreach ($value_c->users as $key_c => $value_c) {
                            if ($value_c->pivot->send_mail == 1) {
                                $managers[$value_c->id] = $value_c;
                                //$managers[$value_c->id]['contuct'] = $value_c->id;
                            }
                        }
                    }
                    # code...
                }
            }
        }
        return $managers;
    }

}
