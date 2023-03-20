<?php

namespace App\Http\Livewire\Customer\Chats;

use App\DTO\ChatMessage\AskQuestion as ChatMessageAskQuestion;
use App\DTO\ChatMessage\Vacancy as ChatMessageVacancy;
use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class IndexContentSectionLivewire extends Component
{
    use WithPagination;
    use WithPerPage;
    public array $perPageListItems = [5, 10, 20, 30, 40];

    protected ?User $customer;
    protected bool $revalidateTable = false;
    protected string $paginationTheme = 'paginator-cabinet';

    protected $listeners = [
        'eventNewChatCreated',
        'reloadChatsIndex' => 'reloadChatsIndex',
    ];


    public function boot()
    {
        $this->customer = auth()->user();
    }

    public function mount()
    {
        //$this->checkChatsMessage();
    }

    public function render()
    {
        // ToDo: сделать автообновление списка чатов на периодическое получение новых
        // ссобщений менеджера когда будет собран кабинет менеджера

        $chats = $this->revalidateData();
        $customer = $this->customer;

        return view(
            'livewire.customer.chats.index-content-section-livewire',
            compact('chats', 'customer')
        );
    }

    public function updatedPaginators($page, $pageName)
    {
        $this->revalidateTable = true;
    }

    /** Event Handlers */

    public function eventNewChatCreated()
    {
        $this->revalidateTable = true;
    }

    /** Служебные функции */
    protected function revalidateData(): LengthAwarePaginator
    {
        $query = $this->customer->chats()
            ->orderBy('updated_at', 'desc');

        $chats = $query->paginate($this->getPerPageValue());
        $chats->getCollection()
            ->each(function (Chat $chat) {
                $chat->subject = $chat->source
                    ? __('custom::site.chat.subject.' . $chat->source)
                    : '';
                $chat->lastMessage = $this->tryUnpackMessage($chat->latestMessage()->first());
            });

        return $chats;
    }
    protected function tryUnpackMessage(ChatMessage $cm)
    {
        $data = json_decode(htmlspecialchars_decode($cm->message), true);
        if (is_array($data)){
            switch ($data['type']){
                case 'vacancy':
                    return ChatMessageVacancy::from($data)->formatMultiLine();
                case 'ascQuestion':
                    return ChatMessageAskQuestion::from($data)->formatMultiLine();
            }
        }

        return $cm->message;
    }

    public function isNeedRevalidateFootable(): bool
    {
        return $this->revalidateTable;
    }

    public function reloadChatsIndex()
    {
        $this->revalidateTable = true;
    }

    public function checkChatsMessage()
    {
        if (auth()->user()) {
            $sendEmitReloadMessages = false;
            //if (session('playAudio') === true) {
            foreach (auth()->user()->chats as $key => $value) {
                # code...
                if ($message = $value->latestMessage()->first() and $sendEmitReloadMessages === false and $message->owner_id != auth()->user()->id)
                    $sendEmitReloadMessages = true;
            }

            if (isset($message)) {
                //$message = ChatMessage::latest()->first();
                if (!session()->exists('lastMessage') and isset($message->id)) {
                    session()->put('lastMessage', $message->id);
                }

                if (session('lastMessage') != $message->id and $message->owner_id != auth()->user()->id and $sendEmitReloadMessages === true) {
                    session()->put('lastMessage', $message->id);
                    $this->dispatchBrowserEvent('startAudioMessage');

                    $sendEmitReloadMessages = false;
                }
            }
            // }
        }
    }

}
