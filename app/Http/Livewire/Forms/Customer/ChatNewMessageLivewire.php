<?php

namespace App\Http\Livewire\Forms\Customer;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChatNewMessageLivewire extends Component
{
    public string $managerName = '';
    public string $newText = '';

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

        /** @var User $customer */
        $customer = auth()->user();
        try {
            DB::beginTransaction();
            $chat = $customer->chats()->create([
                'manager_id' => $customer->manager_id,
                'source' => Chat::SOURCE_PRIVATE,
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

}
