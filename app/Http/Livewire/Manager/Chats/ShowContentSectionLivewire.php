<?php

namespace App\Http\Livewire\Manager\Chats;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use Livewire\Component;

class ShowContentSectionLivewire extends Component
{

    public Chat $chat;
    public string $newText = '';
    public int $newedQty = 0;

    protected ?User $manager;

    public function boot()
    {
        $this->manager = auth()->user();
    }

    public function mount()
    {
        if (!$this->chat->manager_id){
            $this->chat->manager_id = $this->manager->id;
            $this->chat->save();
        }
    }

    public function render()
    {
        $messages = $this->revalidateData();
        $manager = $this->manager;

        $this->dispatchBrowserEvent('checkUnViewedMessages');

        return view(
            'livewire.manager.chats.show-content-section-livewire',
            compact('messages', 'manager')
        );
    }

    public function submitNewMessage()
    {
        if ($this->newText) {
            $this->chat->messages()->create([
                'owner_id' => $this->manager->id,
                'message' => $this->newText,
            ]);
            $this->reset('newText');

            if (!$this->chat->manager_id){
                $this->chat->update(['manager_id' => $this->manager->id]);
            }
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

    protected function revalidateData(): \Illuminate\Database\Eloquent\Collection
    {
        $messages = $this->chat->messages()
            ->with('owner')
            ->orderBy('id')
            ->get();

        $this->newedQty = $messages
            ->where('owner_id', '!=', $this->manager->id)
            ->where('viewed', false)
            ->count();

        $chat = $this->chat;
        $manager = $this->manager;
        $messages = $messages
            ->map(function($m) use($chat, $manager){
                $owner = $m->owner;
                $m->isSelf = $owner && $owner->id === $manager->id;
                $m->ownerAvatar = $owner ? $owner->correctAvatar() : '';
                $m->ownerName = $owner ? $owner->name : "$chat->fio (" . formatPhoneNumber($chat->phone) . ')';

                return $m;
            });

        return $messages;
    }

    protected function isChatClosed(): bool
    {
        return (bool)$this->chat->closed;
    }

    protected function isChatOpen(): bool
    {
        return !$this->isChatClosed();
    }

}
