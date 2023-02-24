<?php

namespace App\Http\Livewire\Manager\Chats;

use App\Http\Livewire\Traits\WithPerPage;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class IndexTableSectionLivewire extends Component
{
    use WithPagination;
    use WithPerPage;

    protected ?User $manager;
    protected bool $revalidateTable = false;
    protected string $paginationTheme = 'paginator-buttons';

    protected $listeners = [
        'eventNewChatCreated',
    ];

    public function boot()
    {
        $this->manager = auth()->user();
    }

    public function render()
    {
        if ($this->revalidateTable) {
            $this->dispatchBrowserEvent('updateFooData');
        }

        $chats = $this->revalidateData();

        $table = view('livewire.manager.chats.index-footable-render', compact('chats'))->render();
        return view(
            'livewire.manager.chats.index-table-section-livewire',
            compact('chats', 'table')
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
        $query = $this->manager->managerChats()
            ->with('customer.translations')
            ->orderBy('updated_at', 'desc');

        $chats = $query->paginate($this->getPerPageValue());
        $chats->getCollection()->each(function (Chat $chat) {
            $chat->lastMessage = $chat->latestMessage()->value('message');
        });
        return $chats;
    }


}
