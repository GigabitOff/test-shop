<?php

namespace App\Http\Livewire\Forms\Jobs;

use App\Mail\SendFormsJobsJobIndexMail;
use App\Models\Chat;
use App\Models\Contuct;
use App\Models\Popup;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Livewire\WithFileUploads;
use App\Http\Livewire\BaseSiteComponentLivewire;

class FormsJobsJobIndexLivewire extends BaseSiteComponentLivewire
{
    use WithFileUploads;

    public $data,
        $popup_id=5,
        $emailSend,
        $chat_id,
        $subject = 'Повідомлення з попап',
        $product_data,
        $popup;

    public ?int $departmentId = null;
    public array $departmentList = [];

    protected array $rules = [
        'data.fio' => 'required',
        'data.email' => 'required|email',
        'data.phone' => 'required',
        'data.message' => 'required',

    ];

    public function mount()
    {
        $this->data['popup_id'] = $this->popup_id;

        $this->popupData = Popup::find($this->popup_id);

        if (!$this->emailSend)
        $this->emailSend = settingsData('main_email_for_send', true);
    }

    public function updated($field)
    {
        if ($field == 'data.phone') {

            $this->data['phone'] = preg_replace('/[^\d]/', '', $this->data['phone']);

        }

        $this->validateOnly($field);

    }

    public function render()
    {
        return view('livewire.forms.jobs.forms-jobs-job-index-livewire');
    }



    public function updatedDataPhone($value)
    {
        $this->data['phone'] = preg_replace('/[^\d]/', '', $value);
    }

    public function submit()
    {

        $this->validate();

        $managers = $this->getManagers($this->popup_id);
        $popup = $this->popupData;
        //dd($this->popup);
        $customer_id = null;

        $customer = $this->getCustomers();

        if ($customer)
        $customer_id = $customer->id;

        if (!$popup) {
            $this->popup_id = null;
        } else {
            if(isset($this->data['job'])){
                $this->subject = $popup->name .' №'. $this->data['job']->id;
            }else{
                $this->subject = $popup->name;

            }
        }

        if(isset(auth()->user()->id))
        $customer_id = auth()->user()->id;

        try {

            DB::beginTransaction();

            $chat = Chat::create([
                'customer_id' => $customer_id,
                'fio' => $this->data['fio'],
                'subtitle' => $this->subject,
                'popup_id' => $this->popup_id,
                'email' => $this->data['email'],
                'phone' => $this->data['phone'],
            ]);

            if (isset($chat['id']))
            $this->data['userId'] = $chat['id'];

            //dd($chat['id']);
            $chat->messages()->create([
                'owner_id' => $customer_id,
                'message' => $this->data['message'],
            ]);



            $this->sendAllEmails($managers);

            DB::commit();

            $this->resetForm();

            session()->flash('chat_message_success', __('custom::site.send_message_success'));
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
            'departmentId.required' => __('custom::site.choice_value_from_list'),
        ];
    }

    public function getManagers($id)
    {
        $managers = null;
        $popup = Popup::find($id);
        $this->popup = $popup;
        if($popup){
            $contucts = $popup->contucts;
            if(count($contucts)>0){
                foreach ($contucts as $key_c => $value_c) {
                    if(count($value_c->users)>0){
                        foreach ($value_c->users as $key_c => $value_c) {
                            if($value_c->pivot->send_mail == 1){
                            $managers[$value_c->id] = $value_c;
                                //$managers[$value_c->id]['contuct'] = $value_c->id;
                            }
                        }
                    }
                    # code...
                }
            }
        }
        return $managers;
    }

    public function getCustomers()
    {
        $data = User::where('email', $this->data['email'])
        ->orWhere('phone', clearPhoneNumber($this->data['phone']))
        ->first();
        return $data;
    }

    public function sendAllEmails($managers){
        if($this->data['message'])
        $data['message'] = $this->data['message'];

        if ($this->data['files'])
        $data['files'] = $this->data['files'];

        if($this->product_data)
        $data['product'] = $this->product_data->toArray();
        $data['name'] = $this->data['fio'];
        $data['subject'] = $this->subject;

    if (isset($managers) and count($managers) > 0) {
        //shopManagers

        foreach ($managers as $key => $value) {
            # code...
            $manager['email'] = $this->emailSend;


            if (isset($value)) {

                //$this->data['user_id'] = $value['id'];

               // if(isset($value['email'])){
               // $manager['email'] = 'v.makarenko@fairtech.group';//$value['email'];

                Mail::to($manager['email'])->send(new SendFormsJobsJobIndexMail($data));
                //}

                //$this->data['id_users'][$value['id']] = $value['id'];
            }
        }
    } else {
        $item = Mail::to($this->emailSend)->send(new SendFormsJobsJobIndexMail($data));
    }
    }

    protected function setDepartmentList(): array
    {
        return Contuct::query()
            ->withTranslation('')
            ->whereHas('users')
            ->get()
            ->keyBy('id')->map->title->toArray();
    }

    protected function resetForm()
    {
        $this->reset('data');

        $this->resetValidation();
        $this->dispatchBrowserEvent('resetForm');
    }
}
