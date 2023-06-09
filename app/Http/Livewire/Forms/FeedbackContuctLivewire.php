<?php

namespace App\Http\Livewire\Forms;

use App\Mail\SendDataMail;
use App\Models\Chat;
use App\Models\Contuct;
use App\Models\Popup;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
class FeedbackContuctLivewire extends Component
{

    public $data,
        $popup_id=3,
        $emailSend,
        $subject= 'Повідомлення з попап',
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
        return view('livewire.forms.feedback-contuct-livewire');
    }



    public function updatedPhoneRaw($value)
    {
        $this->data['phone'] = preg_replace('/[^\d]/', '', $value);
    }

    public function submit()
    {
        $this->validate();

        $managers = $this->getManagers($this->popup_id);
        $customer = $this->getCustomers();
        $popup = Popup::where('id',$this->popup)->first();
        //dd($this->popup);
        $customer_id = null;

        if($customer)
        $customer_id = $customer->id;


        if (!$popup) {
            $this->popup_id = null;
        } else {
            $this->subject = $popup->name;
            $this->popup_id = $this->popup;
        }

        if(isset(auth()->user()->id))
        $customer_id = auth()->user()->id;

        try {

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

            if (isset($chat['id']))
            $this->data['userId'] = $chat['id'];

            DB::commit();

            session()->flash('chat_message_success', __('custom::site.send_message_success'));
        } catch (\Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . $e->getMessage());
            session()->flash('chat_message_fail', __('custom::site.send_message_error'));
        }

        $this->sendAllEmails($managers);

        $this->resetForm();

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
        $data = User::where('email',$this->data['email'])
        ->first();
        return $data;
    }

    public function sendAllEmails($managers){

        $data['message'] = $this->data['message'];
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


                Mail::to($manager['email'])->send(new SendDataMail($data));
                //}

                //$this->data['id_users'][$value['id']] = $value['id'];
            }
        }
    } else {
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
}
