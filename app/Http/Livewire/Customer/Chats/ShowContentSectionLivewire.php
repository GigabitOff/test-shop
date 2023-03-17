<?php

namespace App\Http\Livewire\Customer\Chats;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Livewire\Component;
use Livewire\WithPagination;

class ShowContentSectionLivewire extends Component
{
    use WithPagination;

    public Chat $chat;

    public string $subject;
    public string $newText = '';
    public int $newedQty = 0;

    protected ?User $customer;

    protected $listeners = [
        'reloadChatsIndex' => 'reloadChatsIndex',
    ];

    public function boot()
    {
        $this->customer = auth()->user();
    }

    public function mount()
    {
        $this->subject = $this->chat->source
            ? __('custom::site.chat.subject.' . $this->chat->source)
            : '';
    }

    public function render()
    {
        $messageGroups = $this->revalidateData();
        $customer = $this->customer;

        $this->dispatchBrowserEvent('checkUnViewedMessages');

        return view(
            'livewire.customer.chats.show-content-section-livewire',
            compact('messageGroups', 'customer')
        );
    }

    public function submitNewMessage()
    {

        if ($this->newText) {
            $this->chat->messages()->create([
                'owner_id' => $this->customer->id,
                'message' => $this->newText,
            ]);

        //dd($this->newText);

            $this->reset('newText');
        }

    }

    public function setViewed($ids)
    {
        if ($ids = array_filter((array)$ids)) {
            ChatMessage::query()
                ->whereIn('id', $ids)
                ->update(['viewed' => true]);
        }

        $this->emit('eventMessagesViewedStatusChanged');
    }

    /** Служебные функции */

    protected function revalidateData(): EloquentCollection
    {
        $messages = $this->chat->messages()
            ->with('owner')
            ->orderBy('id')
            ->get();

        $this->newedQty = $messages
            ->where('owner_id', '!=', $this->customer->id)
            ->where('viewed', false)
            ->count();

        /**
         * Формируем группы  подряд идущих сообщений одного владельца
         */
        $grouped = $messages
            ->tap(function (EloquentCollection $c) {
                $group = 0;
                $prevOwnerId = 0;
                foreach ($c as $message) {
                    if ($message->owner_id != $prevOwnerId) {
                        $group++;
                        $prevOwnerId = $message->owner_id;
                    }
                    $message->group = $group;
                }
            })
            ->groupBy->group;

        return $grouped;
    }

    protected function isChatClosed(): bool
    {
        return (bool)$this->chat->closed;
    }

    protected function isChatOpen(): bool
    {
        return !$this->isChatClosed();
    }

    public function reloadChatsIndex()
    {
        
        $this->resetPage();
       // $this->revalidateTable = true;
    }
}
