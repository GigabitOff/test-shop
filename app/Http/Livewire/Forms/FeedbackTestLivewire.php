<?php

namespace App\Http\Livewire\Forms;

use App\Mail\SendDataMail;
use App\Models\Chat;
use App\Models\Contuct;
use App\Models\Popup;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Http\Livewire\BaseComponentLivewire;
use Illuminate\Support\Facades\Validator;
class FeedbackTestLivewire extends BaseComponentLivewire
{

    public $data,
        $popup_id = 1,
        $emailSend,
        $subject = 'Повідомлення з попап',
        $popup;
    public ?int $departmentId = null;
    public array $departmentList = [];

    protected array $rules = [
        'data.fio' => 'required',
        'data.email' => 'required|email',
        'data.message' => 'required',

    ];

    public function mount()
    {
        $this->data['popup_id'] = $this->popup_id;

        if (!$this->emailSend)
            $this->emailSend = settingsData('main_email_for_send', true);
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function render()
    {
        return view('livewire.forms.feedback-test-livewire');
    }



    public function updatedPhoneRaw($value)
    {
        $this->data['phone'] = preg_replace('/[^\d]/', '', $value);
    }

    public function submit()
    {
        $this->validate();

        $managers = $this->getManagers($this->popup_id);
        $popup = Popup::where('id', $this->popup_id)->first();
        $customer_id = null;

        //dd($managers);

        if (!$popup) {
            $this->popup_id = null;
        } else {
            $this->subject = $popup->name;
            //$this->popup_id = $this->popup;
        }

        if (isset(auth()->user()->id)){
            $customer_id = auth()->user()->id;
        }else{
            $customer = $this->getCustomers();
        }
        if (isset($customer))
        $customer_id = $customer->id;

        $this->sendAllEmails($managers);
        try {

            $data['message'] = $this->data['message'];
            $data['name'] = $this->data['fio'];
            $data['subject'] = $this->subject;

            DB::beginTransaction();

            $chat = Chat::create([
                'customer_id' => $customer_id,
                'fio' => $this->data['fio'],
                'answer_owner' => 1,
                'subject' => $this->subject,
                'popup_id' => $this->popup_id,
                'email' => $this->data['email'],
            ]);

            $chat->messages()->create([
                'owner_id' => $customer_id,
                'message' => $this->data['message'],
            ]);

            Mail::to($this->data['email'])->send(new SendDataMail($data));

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
        if ($popup) {
            $contucts = $popup->contucts;
            if (count($contucts) > 0) {
                foreach ($contucts as $key_c => $value_c) {
                    if (count($value_c->users) > 0) {
            //dd($value_c->users);
                        foreach ($value_c->users as $key_c => $value_c) {
                            if ($value_c->pivot->send_mail == 1) {
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

    public function sendAllEmails($managers)
    {
        $data['message'] = $this->data['message'];
        $data['name'] = $this->data['fio'];
        $data['subject'] = 'Повідомлення з попап';

        if (isset($managers) and count($managers) > 0) {
            //shopManagers

            foreach ($managers as $key => $value) {
                # code...
                if(!isset($value['email'])){
                $manager['email'] = $this->emailSend;
                }else{
                    $manager['email'] = $value['email'];

                }

                $validator = Validator::make(['email' => $manager['email']], [
                    'email' => 'required|email',
                ]);

                //dd($manager['email']);
                if (isset($value) AND !$validator->fails()) {

                    //$this->data['user_id'] = $value['id'];

                    // if(isset($value['email'])){
                    // $manager['email'] = 'v.makarenko@fairtech.group';//$value['email'];


                    Mail::to($manager['email'])->send(new SendDataMail($data));
                    //}

                    //$this->data['id_users'][$value['id']] = $value['id'];
                }
            }
        } else {
            $validator = Validator::make(['email' => $this->emailSend], [
                'email' => 'required|email',
            ]);

            $item = Mail::to($this->emailSend)->send(new SendDataMail($data));
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
        $this->reset('data', 'popup');
        $this->popup_id;

        $this->resetValidation();
        $this->dispatchBrowserEvent('reset_departmentId_toDefault');
    }

    public function getCustomers()
    {
        $data = User::where('email', $this->data['email'])
        //->orWhere('phone', clearPhoneNumber($this->data['phone']))
        ->first();
        return $data;
    }
}
