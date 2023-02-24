<?php

namespace App\Http\Livewire\Forms;

use App\Models\Chat;
use App\Models\Contuct;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FeedbackToLkLivewire extends Component
{
    public string $fio = '';
    public string $phone = '';
    public string $email = '';
    public string $message = '';
    public ?int $department = null;
    public array $departmentList = [];

    protected $listeners = [
        'updatedDepartmentId',
        'closeModal'
    ];

    protected array $rules = [
        'fio' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'message' => 'required',
        'department' => 'required',
    ];

    public function mount()
    {
        $this->departmentList = $this->setDepartmentList();
    }

    public function render()
    {
        return view('livewire.forms.feedback-to-lk-livewire');
    }

    public function updatedDepartmentId($value)
    {
        $this->department = (int)$value ?: null;
        $this->clearValidation();
    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/[^\d]/', '', $value);
    }

    public function submit()
    {
        $this->validate();

        $this->updatedPhoneRaw($this->phone);

        try {
            DB::beginTransaction();

            $chat = Chat::create([
                'department_id' => $this->department,
                'fio' => $this->fio,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);

            $chat->messages()->create([
                'message' => $this->message,
            ]);

            DB::commit();

            $this->resetForm();
           // session()->flash('chat_message_success', __('custom::site.send_message_success'));
            $this->dispatchBrowserEvent('closeModal');
        } catch (\Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . $e->getMessage());
            session()->flash('chat_message_fail', __('custom::site.send_message_error'));
        }
    }


    /** Service Functions */
    protected function messages(): array
    {
        return [
            'department.required' => __('custom::site.choice_value_from_list'),
        ];
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

    protected function resetForm()
    {
        $this->reset('fio', 'phone', 'email', 'message', 'department');
        $this->resetValidation();
        $this->dispatchBrowserEvent('reset_department_toDefault');
    }
}
