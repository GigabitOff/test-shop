<?php

namespace App\Http\Livewire\Forms;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FoundCheaperLivewire extends Component
{
    public ?User $user = null;
    public string $link = '';
    public string $message = '';

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view(
            'livewire.forms.found-cheaper-livewire'
        );
    }

    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $chat = $this->user->chats()->create([
                'manager_id' => $this->user->manager_id,
                'department_id' => $this->user->manager_id ? null : Department::TYPE_GLOBAL,
            ]);

            $chat->messages()->create([
                'message' => sprintf(
                    '%s %s',
                    $this->link,
                    $this->message,
                ),
                'owner_id' => $this->user->id,
            ]);

            DB::commit();
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.Found cheaper'),
                'message' => __('custom::site.send_message_success'),
                'state' => 'success'
            ]);

            $this->resetForm();
        } catch (\Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . $e->getMessage());

            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.Found cheaper'),
                'message' => __('custom::site.send_message_error'),
                'state' => 'danger'
            ]);
        }
    }

    protected function rules(): array
    {
        $pattern = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        return [
            'link' => 'required|regex:' . $pattern,
            'message' => 'required',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'link' => __('custom::site.Product link'),
            'message' => __('custom::site.message'),
        ];
    }

    protected function resetForm()
    {
        $this->reset('link', 'message');
    }
}
