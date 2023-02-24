<?php

namespace App\Http\Livewire\Forms\Manager;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormPersonalDataEdit extends Component
{
    use WithFileUploads;

    public $phone_raw;
    public $name_uk;
    public $name_ru;
    public $name_en;
    public $email;
    public $avatar;
    public $avatar_url = '/assets/img/avatar-1.png';
    public $avatar_exist = false;

    public $phone = '';

    /**
     * @var User|null
     */
    protected $user;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->user = auth()->user();
    }

    public function mount()
    {
        $this->phone = $this->user->phone;
        $this->phone_raw = $this->formatPhone($this->phone);
        $this->email = $this->user->email;
        $translations = collect($this->user->getTranslationsArray())
            ->map(function ($el) {
                return $el['name'] ?? '';
            })->filter();

        $this->name_uk = $translations['uk'] ?? '';
        $this->name_ru = $translations['ru'] ?? '';
        $this->name_en = $translations['en'] ?? '';

        if ($this->user->avatar_url) {
            $this->avatar_url = '/storage/' . $this->user->avatar_url;
            $this->avatar_exist = true;
        }
    }

    public function updatedAvatar($field)
    {
        // todo: сделать отображение файла, т.к. файл из временной папки livewire
        // не будет отображаться на сервере.
        $this->avatar_url = $this->avatar->temporaryUrl();
        $this->avatar_exist = true;
    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/[^\d]/', '', $value);
    }

    public function render()
    {
        return view('livewire.forms.manager.form-personal-data-edit');
    }

    public function submit()
    {
        $fields = $this->validate();

        $this->user->phone = $fields['phone'];
        $this->user->email = $fields['email'];

        $this->user->{'name:uk'} = $this->name_uk;
        $this->user->{'name:ru'} = $this->name_ru;
        $this->user->{'name:en'} = $this->name_en;

        if ($this->avatar) {
            $this->removeAvatarFromDisk();
            $filename = $this->avatar->store('avatars', 'public');
            $this->user->avatar_url = $filename ?? null;
            $this->avatar_url = '/storage/' . $filename;
        }
        $this->user->save();

        $this->emit('eventPersonalDataChanged');

        session()->flash('edit_success', __('custom::site.personal_data_change_success'));

    }

    public function rules()
    {
        $rules = [
            'phone' => ['required', Rule::unique('users', 'phone')->ignore($this->user->id)],
            'email' => ['required', Rule::unique('users', 'email')->ignore($this->user->id)],
        ];

        if ($this->avatar){
            $rules['avatar'] =['sometimes', 'image', 'max:1024'];
        }

        return $rules;
    }

    public function removeAvatar()
    {
        $this->avatar_url = '/assets/img/avatar-1.png';
        $this->avatar_exist = false;
        $this->removeAvatarFromDisk();

        $this->emit('eventPersonalDataChanged');
    }

    protected function formatPhone($number)
    {
        return preg_replace("/^(\d{2})(\d{3})(\d{3})(\d{2})(\d{2})$/", "+$1/$2/ $3 $4 $5", $number);
    }

    protected function removeAvatarFromDisk(){
        if ($this->user->avatar_url) {
            try {
                unlink(storage_path('app/public/'. $this->user->avatar_url));
            } catch (\Exception $e) {
            }

            $this->user->avatar_url = null;
            $this->user->save();
        }
    }

}
