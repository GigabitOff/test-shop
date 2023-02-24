<?php

namespace App\Http\Livewire\Forms;

use App\Models\Chat;
use App\Models\Contuct;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FeedbackLivewire extends Component
{
//    use WithFilterableDropdown;

public string $fio = '';
public string $phone = '';
public string $phoneRaw = '';
public string $email = '';
public string $message = '';
public string $department = '';
public string $departmentId = '';
//    public string $filterableDepartment = '';
public int $branchId = 0;

protected array $rules = [
'fio' => 'required|min:4',
'phone' => 'required|min:12|bail|unique:users,phone',
'email' => 'required|email',
'message' => 'required|min:10',
'department'=>'required',
];

    protected $listeners = [
        'eventSetBranch',
    ];

    public function mount()
    {
        $this->departmentList = $this->setDepartmentList();
    }

    public function render()
    {
        return view('livewire.forms.feedback-livewire');
    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/[^\d]/', '', $value);
       // $this->validateOnly('phone');
    }

    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $chat = Chat::create([
                'department_id' => $this->departmentId,
                'name' => $this->fio,
                'phone' => $this->phone,
                'email' => $this->email,
                'message' => $this->message,
            ]);

            $chat->messages()->create([
                'message' => $this->message,
            ]);

            DB::commit();

//            session()->flash('chat_message_success', __('custom::site.send_message_success'));
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.on_project_domain'),
                'message' => __('custom::site.send_message_success'),
                'state' => 'success'
            ]);
            $this->resetForm();
        } catch (\Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . $e->getMessage());
            //session()->flash('chat_message_fail', __('custom::site.send_message_error'));
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.on_project_domain'),
                'message' => __('custom::site.send_message_error'),
                'state' => 'danger'
            ]);
        }
    }


    /** Event Handlers */
    public function eventSetBranch($id)
    {
        $this->branchId = (int)$id;
    }

    /** Service Functions */
    protected function messages(): array
    {
        return [
            'departmentId.required' => __('custom::site.choice_value_from_list'),
        ];
    }

protected function setFilterableDepartmentList($value): array
    {
//        return Contuct::query()
//            ->withTranslation('')
//            ->whereHas('users')
//            ->get()
//            ->keyBy('id')->map->title->toArray();
        return [];
    }

    protected function setDepartmentList(): array
    {
        return Contuct::query()
            ->withTranslation('')
            ->where(function ($query){
                $query->whereHas('users')
                    ->orwhereHas('getSelf');
            })
            ->get()
            ->keyBy('id')->map->title->toArray();
    }

    protected function validationAttributes(): array
    {
        return [
            'fio' => __('custom::site.fio'),
            'message' => __('custom::site.questions'),
        ];
    }

    protected function resetForm()
{
    $this->reset('fio', 'phone', 'phoneRaw', 'message', 'email');
    $this->resetValidation();
    $this->dispatchBrowserEvent('eventResetFeedbackForm');
}

    protected function getRecipientEmail(): string
    {
        $email = '';
        // Т.к. филиал пока не имеет своего email
//        if ($this->branchId){
//            $email = Shop::query()->where('id', $this->branchId)->value('email');
//        }

        if (!$email){
            $email = getGlobalAdminEmail();
        }

        if (!$email){
            throw new \Exception('recipient email not found');
        }

        return $email;
    }
}
