<?php

namespace App\Http\Livewire\Forms\Jobs;

use App\DTO\ChatMessage\Vacancy as ChatMessageVacancy;
use App\Models\Chat;
use App\Models\Popup;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormJobLivewire extends Component
{
    use WithFileUploads;

    // Evaluated from caller
public string $vacancyName = '';

public array $countryCodes = [];
public string $countryCode = '';
public string $fio = '';
public string $phoneRaw = '';
public string $phone = '';
//public string $phoneFull = '';
public string $text = '';
public string $email = '';
    public $file,
    $popup_id=5,
    $subject;

protected ?User $user = null;

protected array $rules = [
'fio' => 'required|min:5',
'phone' => 'required|bail|min:12|unique:users,phone',
'text' => 'required|min:5',
'email' => 'required|email',
];

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function mount()
    {
        $this->revalidateCountryCodes();
    }

    public function render()
    {
        return view('livewire.forms.jobs.form-job-livewire');
    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/[^\d]/', '', $value);
        //$this->phoneFull = preg_replace('/[^\d]/', '', $this->countryCode . $value);
    }

    public function changeCountryCode($code)
    {
        $this->countryCode = $code;
    }

    public function submit()
    {
        if ($this->file) {
            $this->rules['file'] = 'required|max:1024';
        }

        $this->validate();

        $managers = $this->getManagers($this->popup_id);
        $customer = $this->getCustomers();
        $popup = Popup::where('id', $this->popup_id)->first();
        //dd($this->popup);
        $customer_id = null;

        if ($customer)
        $customer_id = $customer->id;


        if (!$popup) {
            $this->popup_id = null;
        } else {
            $this->subject = $popup->name;
            //$this->popup_id = $this->popup_id;
        }


        try {
            $path = $this->file
                ? $this->file->store('job/applications', 'public')
                : '';



            DB::beginTransaction();

            $chat = Chat::create([
                'customer_id' => auth()->id(),
                'manager_id' => $this->user->manager_id ?? null,
                    'fio' => $this->fio,
                    'phone' => $this->phone,
                    'source' => Chat::SOURCE_VACANCY,
                    'popup_id' => $this->popup_id,
                ]);

            $cm = ChatMessageVacancy::from([
                'vacancy' => $this->vacancyName,
                'fio' => $this->fio,
                'phone' => $this->phone,
                'email' => $this->email,
                'text' => $this->text,
                'file' => $path,
            ]);

            $chat->messages()->create([
                'owner_id' => auth()->id(),
                'message' => $cm->toString(),
                'options' => $this->file
                    ? ['application_file' => $path]
                    : null,
            ]);

            $this->refreshForm();

            DB::commit();

            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.on_project_domain'),
                'message' => __('custom::site.Application is sent'),
                'state' => 'success'
            ]);


        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('flashMessage', [
                'title' => __('custom::site.on_project_domain'),
                'message' => __('custom::site.send_message_error'),
                'state' => 'danger'
            ]);
        }
    }

    protected function revalidateCountryCodes()
    {
        $this->countryCodes = settingsDataCategory('code_country') ?? [];
        $this->countryCode = $this->countryCodes[0] ?? '';
    }

    protected function refreshForm()
    {
        $this->reset();
        $this->revalidateCountryCodes();
        $this->dispatchBrowserEvent('clearJobApplicationForm');
    }

}
