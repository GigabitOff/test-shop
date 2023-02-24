<?php

namespace App\Http\Livewire\Forms\Manager;

use App\Http\Livewire\Traits\WithFilterableDropdown;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChatNewMessageLivewire extends Component
{
    use WithFilterableDropdown;

    public array $filterableCustomer = [];

    public string $managerName = '';
    public string $newText = '';

    protected array $rules = [
        'newText' => 'required',
        'filterableCustomer.id' => 'required',
    ];

    public function mount()
    {
        $this->initFilterable();

        if ($manager = auth()->user()->manager){
            $this->managerName = $manager->name;
        }
    }

    public function render()
    {
        return view('livewire.forms.manager.chat-new-message-livewire',[
            'filterableMode' => $this->filterableMode,
        ]);
    }

    public function updated($field, $value)
    {
        $this->updatedFilterable($field, $value);
    }

    public function submit()
    {
        $this->validate();

        $manager = auth()->user();
        $customer = User::find($this->filterableCustomer['id']);
        try {
            DB::beginTransaction();
            $chat = $customer->chats()->create();
            $chat->messages()->create([
                'owner_id' => $manager->id,
                'message' => $this->newText,
            ]);

            $this->newText = '';

            $this->emit('eventNewChatCreated');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            logger('Chat new message create error: ' . $e->getMessage());
        }
    }

    public function messages(): array
    {
        return [
            'filterableCustomer.id.required' => __('custom::site.choice_value_from_list'),
        ];
    }

    public function setFilterableCustomerList($value): array
    {
        if (!$value){
            return [];
        }

        $manager = auth()->user();

        return $manager->customers()
            ->withTranslation()
            ->where(function($q) use ($value){
                $q->whereTranslationLike('name', "%$value%")
                    ->orWhereDigitFieldLike('phone', "%{$value}%");
            })
            ->select('id')
            ->take(10)->get()
            ->keyBy('id')->map->name->toArray();

    }
}
