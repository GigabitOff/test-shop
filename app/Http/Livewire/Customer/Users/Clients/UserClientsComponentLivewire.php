<?php

namespace App\Http\Livewire\Customer\Users\Clients;

use App\Http\Livewire\BaseComponentLivewire;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Counterparty;
use App\Models\UserGroup;
use App\Models\BlockIp;
use App\Models\Order;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserClientsComponentLivewire extends BaseComponentLivewire
{
    public $languages = [],

        $collapse = [], //відображення вкладок
        $show_lang='main',
        $nameLive = 'users',
        $data_collect,
        $tableClass = User::class,
        $tableSearchClass = City::class,
        $status_delete=0,
        $counterparties,
        $show_pass,
        $counterparties_data_user,
        $counterparties_select,
        $counterparty_ids,
        $change_manager_select,
        $show_counterparty,
        $user_groups,
        $password,
        $BlockIps,
        $roles_select,
        $user_filters=[
            'all' => 'all',
            'new' => 'new',
            'changes' => 'changes',
          //  'moderation' => 'moderation',
            'delated' => 'delated',
        ],
        $entrances,
        $tmpImage;

    public function getData()
    {

        $data = User::withTrashed()->find($this->item_id);

        $this->data_collect = $data;
        $this->dataItem = $data;
        //dd($data);
        $this->status_delete = ($data->deleted_at ? 1 : 0);

       // dd($this->counterparties_select);
        $this->user_groups = UserGroup::get();
        $this->data = $data->toArray();
        $res_user_prox =  DB::table('user_proxies')
        ->where('from_id', $this->item_id)->where('date_to','>=',now())
            ->first();
        //dd($res_user_prox);
        if($res_user_prox){
            $this->change_user = $user_to_id = User::find($res_user_prox->to_id);
            $this->select_data['change_manager']['input'] = $user_to_id->name;
            $this->select_data['change_manager']['id'] = $user_to_id->id;
            $this->data['date_to'] = \Carbon\Carbon::parse($res_user_prox->date_to)->format('d.m.Y');
            $this->data['date_from'] = \Carbon\Carbon::parse($res_user_prox->date_from)->format('d.m.Y');
        }
        //dd($this->data['date_to']);
        /* if($this->data_collect->city_id){
            $this->select_data['city']['input'] = $this->data_collect->city->name_uk;
            $this->select_data['city']['id'] = $this->data_collect->city->id;
        }
        */

        if (isset($this->data['city_id'])) {
            $city = City::find($this->data['city_id']);

            $this->select_data['city']['id'] = $this->data['city_id'];
            $this->select_data['city']['input'] = $city->name_uk;
        }


        $this->status = $data['is_active'];
        $this->phone = $this->data['phone'];

        $counterparties_data_user = $this->data_collect->counterparties;


        foreach ($counterparties_data_user as $key_cu => $value_cu) {
            # code...
            //dd($value_cu);
            $this->counterparty_ids[] = $value_cu->id;
            $this->counterparties_data_user[$value_cu->okpo] = $value_cu->id;
            $this->data['counterpaties_name'][$value_cu->okpo] = $value_cu;

        }
        //dd($this->data['counterpaties_name']);
        //$this->data['counterpaties_okpo'] = $this->data_collect->counterparties->pluck('okpo');
       // $counterpaties_names = $this->data_collect->counterparties->keyBy('okpo')->toArray();//->join(',')
        //dd($this->data_collect->counterparties->keyBy('okpo')->toArray());

        $this->counterparties = Counterparty::whereIn('id',$this->counterparty_ids)->limit(10)->get();
        $this->counterparties_select = $this->searchSelectDatatoArray($this->counterparties);


        if ($data->counterparty) {
            $this->select_data['counterparty_id']['input'] = $data->counterparty->name;
            $this->select_data['counterparty_id']['id'] = $data->counterparty->id;
        }

        //dd($data->manager_id);
        if ($data->manager_id) {
            $this->select_data['manager_id']['input'] = $data->manager->name;
            $this->select_data['manager_id']['id'] = $data->manager->id;
        }
        foreach ($this->languages as $key => $value) {
            if($data->translate($value->lang)){
                $this->data[$value->lang] = $data->translate($value->lang);
            }
        }

         $this->roles_select = Role::all();

        $this->data['user_role'] = $this->data_collect->getRoleNames()->first();


        foreach ($this->data_collect->getRoleNames() as  $value_role) {

            if($value_role != $this->data_collect->getRoleNames()->first())
            $this->data_collect->removeRole($value_role);
            # code...
        }

        //$this->select_array['managers'];

       // dd($this->roles_select);
        /** Проверка заблокированих айпи */


    }

    public function setUserRole($role)
    {
        $this->data['user_role'] = $role;
       // $this->resetPage();
    }

    public function validateDataUser()
    {
        $this->validate([
           // 'data.customer_type' => 'required',
            'data.user_role' => 'required',
            'data.' . session('lang') . '.name' => 'required',
           // 'data.password' => 'required',
            //'data.email' => 'required',
            //'data.city_id' => 'required',
        ]);
        //$this->reset(['error_data']);
        //$this->emit('changesStart');
        $this->resetPage();

    }

    public function updateData()
    {
        //dd($this->data);
        $this->validateDataUser();
        if ($this->data['phone'] != $this->phone)
        $this->data['phone'] = $this->phone;
       // dd($this->data);

       /*if($this->data['password']){
            $this->validate(
                [
                    'password' => 'required| min:4| confirmed',
                    'password_confirmation' => 'required| min:4'
            ]);
        }*/

        $save = User::withTrashed()->find($this->item_id);

        if(isset($this->data['counterparty_id'])){
          //  dd($save->counterparties);
          // $save->counterparties()->SyncWithoutDetaching([$this->data['counterparty_id']]);
          //  unset($this->data['counterparty_id']);
        }
        $this->SaveAllImageData();

        //dd($this->data['user_role']);
        if (isset($this->data['user_role']) AND $this->data['user_role'] !=  $this->data_collect->getRoleNames()->first()){
            if($this->data_collect->getRoleNames()->first())
            $save->removeRole($this->data_collect->getRoleNames()->first());

            $save->assignRole($this->data['user_role']);
        }

        if (isset($this->select_data['manager_id']['id'])){
            $this->data['manager_id'] = $this->select_data['manager_id']['id'];
        }
        if (!isset($this->data['manager_id'])) {
            $this->data['manager_id'] = null;
        }
    if(isset($this->select_data['change_manager']['id']) AND isset($this->data['date_to']))
        {
            //$this->select_data['change_manager']['id']
            // dd($this->select_data['change_manager']['id']);
            if (isset($this->change_user) and !isset($this->select_data['change_manager'])) {
                DB::table('user_proxies')
                    ->where('from_id', $this->item_id)
                    ->delete();
            }else{
                $res_user_prox =  DB::table('user_proxies')
                ->where('from_id', $this->item_id)
                ->first();
            }



            $this->data['date_to'] = str_replace('/','.', $this->data['date_to']);
            $change_manager_save['from_id'] = $this->item_id;
            $change_manager_save['to_id'] = $this->select_data['change_manager']['id'];
            $change_manager_save['date_to'] = \Carbon\Carbon::parse($this->data['date_to'])->format('Y-m-d');

            if (isset($this->data['change_manager_all']) AND $this->data['change_manager_all'] != 0) {
                //dd('');
                //$change_user = User::find($change_manager_save['to_id']);
                //dd($change_user);
                //if (isset($change_user))
                //$change_user->fill(['change_user_id' => $change_manager_save['to_id']])->save();
                $change_manager_save['date_to'] = \Carbon\Carbon::parse($this->data['date_to'])->addYear(100)->format('Y-m-d');

                $orders = Order::where('manager_id', $this->item_id)->update(['manager_id', $this->select_data['change_manager']['id']]);
                $orders = Counterparty::where('manager_id', $this->item_id)->update(['manager_id', $this->select_data['change_manager']['id']]);
                $orders = Counterparty::where('region_manager_id', $this->item_id)->update(['region_manager_id', $this->select_data['change_manager']['id']]);
            }else{


            if(!$res_user_prox){
                DB::table('user_proxies')
                ->insert($change_manager_save);
            }else{

                    DB::table('user_proxies')
                    ->where('from_id', $this->item_id)
                    ->update($change_manager_save);
            }
            }

        }

        if (isset($this->counterparties_data_user[0]) and $this->counterparties_data_user[0] == '')
        unset($this->counterparties_data_user[0]);

        //dd($this->counterparties_data_user);
        if (isset($this->counterparties_data_user)) {
            //  dd($save->counterparties);
            //$resData->counterparties()->SyncWithoutDetaching([$this->data['counterparty_id']]);
            $save->counterparties()->sync($this->counterparties_data_user);
            // unset($this->data['counterparty_id']);
        }elseif($this->counterparties_data_user === null){
            $save->counterparties()->sync($this->counterparties_data_user);

        }
        //dd($this->select_data['change_manager']);

        if(isset($this->data['phone']))
        $this->data['phone'] = clearPhoneNumber($this->data['phone']);


        $save->fill($this->data)->save();

        if(!isset($this->swith_show))
        return redirect()->route('admin.'.$this->nameLive.'.index');

        //
        $this->swith_show = 'show';
        $this->resetPage();
    }

    public function createData()
    {
        //$this->data[0]['status']=$this->status;

        $this->validateDataUser();

        $this->data['slug'] = $this->slug;

        if(isset($this->password) AND $this->password !='')
        $this->data['password'] = Hash::make($this->password);

        $this->SaveAllImageData();

        $resData = User::create($this->data);

        if(isset($this->data['phone']))
        $this->data['phone'] = clearPhoneNumber($this->data['phone']);

        if(isset($this->data['user_role']))
        $resData->assignRole($this->data['user_role']);

        if(isset($this->counterparties_data_user[0]) AND $this->counterparties_data_user[0] != '')
        unset($this->counterparties_data_user[0]);

        if (isset($this->counterparties_data_user)) {
            //  dd($save->counterparties);
            //$resData->counterparties()->SyncWithoutDetaching([$this->data['counterparty_id']]);
            $resData->counterparties()->Sync($this->counterparties_data_user);
           // unset($this->data['counterparty_id']);
        }
        if(!isset($this->swith_show))
        return redirect()->route('admin.'.$this->nameLive.'.index');

       $this->swith_show = 'show';
       $this->resetPage();

    }

    public function SaveAllImageData()
    {
        /** Збереження зображення локальної версії */
        foreach ($this->languages as $key => $value) {
            if(isset($this->data[$value->lang]['img']))
            $this->data[$value->lang]['img'] = $this->SaveFileData($this->data[$value->lang]['img'], $this->nameLive);
        }

        /** Збереження зображення локальної версії */
        if(isset($this->data['image']))
        $this->data['image'] = $this->SaveFileData($this->data['image'], $this->nameLive);
    }
    /**custom change tubs */
    public function changeLangTab($item)
    {
        $this->show_lang=$item;

    }

    public function destroyData($id)
    {
        $data = User::find($id);
       // dd($data);
        if($data){

            $this->deletePageIcon($data, $data->image, 'image');
            $this->deletePageIcon($data, $data->img, 'img');

        $status = $data->delete();

        }

        $this->resetPage();

        return $status;
    }
    public function getEntrances($limit=null){

        if($limit !== null)
        {
            $entrances = $this->data_collect->entrances()->limit($limit)->orderBy('login_at', 'DESC')->get()->keyBy('created_at');

        }else{
            $entrances = $this->data_collect->entrances->keyBy('created_at');

        }
        $BlockIp = BlockIp::where('phone_input', $this->phone)->get()->keyBy('created_at');

        $this->BlockIp = $BlockIp;
        $entrances_tmp = array_merge($entrances->toArray(), $BlockIp->toArray());
        krsort($entrances_tmp, SORT_STRING);
        $this->entrances = $entrances_tmp;
    }
    public function unblockUserIp($id){

            $BlockIp_res = BlockIp::find($id);

           // dd($BlockIp_res);
            if($BlockIp_res){
                $BlockIp_res->fill(['end_time'=> Carbon::parse($BlockIp_res['created_at'])->subHour(1)->format('Y-m-d H:i:s')])->save();
            }
        //$this->getEntrances();
        $this->mount();

    }

    public function blockUser($id)
    {
        $this->data['blocked_ip_id'] = 1;

        $this->emit('addDataForSaveUser', 'blocked_ip_id', 1);
        $this->emit('changesStart');

    }

    public function unblockUser($id)
    {
        //$data = User::find($id);
        $BlockIp = BlockIp::where('phone_input', $this->phone)->get()->keyBy('created_at');
        if(count($BlockIp)>0)
        {
            foreach ($BlockIp  as $key => $value) {
               // $this->unblockUserIp($value->id);
            }
        }

        $this->data['blocked_ip_id'] = 0;
        $this->emit('addDataForSaveUser', 'blocked_ip_id', 0);
        $this->emit('changesStart');


    }

    public function blockUserIp($id)
    {

        $BlockIp_res = BlockIp::find($id);
        if ($BlockIp_res) {
            $BlockIp_res->fill(['end_time' => Carbon::parse(now())->addHour(1000)->format('Y-m-d H:i:s')])->save();
        }

        $this->mount();

        //$this->getEntrances();
    }
    public function removeUser($id=null){

        if($id !== Auth::guard('admin')->user()->id){
        if($id === null)
        $id = $this->item_id;
        $data = User::find($id);
        //$users = User::find($id);
        if($data)
        {
            $res = $data->delete();
            //$this->data_collect = User::withTrashed()->find($id);
        } else {
            $restore = User::withTrashed()->find($id);
            //dd($this->item_id);
            $restore->restore();

             //$this->data_collect = User::find($id);
        }


        if(isset($this->data_collect)){
        $data = User::withTrashed()->find($id);
       // dd($data);
        $this->data_collect = $data;
        }
    }
    }

    public function sellectDataDropdown($value,$index,$key){

        $this->reset(['search']);
        //$this->reset(['select_data', 'search']);
        unset($this->select_data[$key]);
        $this->select_data[$key]['id'] = $value;
        $this->select_data[$key]['input'] = $index;
        $this->select_data[$key]['name'] = $index;

        switch ($key) {
            case 'city':
                $this->data['city_id']=$value;

               // $this->resetPage();
                $this->validateDataUser();

                break;
            case 'counterparty_id':
                $this->data['counterparty_id']=$value;
                break;
            case 'filter':
                $this->resetPage();

                break;
            case 'manager':
               // dd($value);

                break;
            default:
                # code...
                break;
        }

        $this->changesStart();

       // dd($this->select_data);
    }

    public function deleteDataList($value=null,$index='',$key='')
    {

        unset($this->select_data[$key]);
        unset($this->data[$key]);
       // dd($this->select_data);

        if($key == 'city')
            unset($this->data['city_id']);

        if($index != ''){
            unset($this->select_data[$index.$key]);
            $key = $index;
        }

        switch ($key) {
            case 'city':
                $this->data['city_id']=null;
                $select_cities = $this->updatedCity('', true);

                $this->select_cities = $this->searchSelectDatatoArray($select_cities, 'name_uk', 'district_uk');

                break;
            case 'counterparty_id':
                $this->data['counterparty_id']=null;
                $this->reset(['counterparties_data_user', 'show_counterparty']);
                $this->counterparties_data_user = null;
                unset($this->data['counterpaties_name']);
                //dd($this->data['counterparty_id']);
                 break;
            case 'filter':
                $this->setFilterData();
                break;

            case 'set_menager_':
                $this->reset(['search']);
                $this->dataManagers = User::query()->where('id', $this->search)->orwhereTranslationLike('name', "%$this->search%")->role('manager')->orderBy('id', 'DESC')->get()->keyBy('id');

                break;


            default:
                # code...
                break;
        }

       // dd($this->select_data[$key]);
        $this->resetPage();

        $this->changesStart();

    }

    public function startAddCounterpaties()
    {
        $this->counterparties_data_user = [0=>''];
        $this->show_counterparty = true;
       // dd($this->counterparties_data_user);
    }

    public function dellAllData()
    {
        if ($this->selectedData) {
            foreach ($this->selectedData as $key => $value) {
                $statusDel = $this->removeUser($value);
            }
            //dd($statusDel);
        }


        $this->changesStart();

       // dd($statusDel);
        return redirect()->route('admin.users.index');

        //  $this->dispatchBrowserEvent('updatedOrder');
    }


    public function addDataForSaveUser($key, $value)
    {
        if($key)
        $this->data[$key] = $value;
    }


    public function setDataOKPO($okpo_str)
    {
        $okpo_arr = explode(',', $okpo_str);

        foreach ($okpo_arr as $key => $value) {
            $okpo = trim($value);
            $res_okpo = Counterparty::where('okpo','LIKE', "$okpo")->orWhere('name', 'LIKE', "$okpo")->first();
            //$res_okpo = Counterparty::get();
            //dd($res_okpo);
            if ($res_okpo) {
                if(in_array($res_okpo->id,$this->counterparty_ids)) {
                    $this->data['counterpaties_name'][$res_okpo->okpo] = $res_okpo->toArray();
                    $this->counterparties_data_user[$res_okpo->okpo] = $res_okpo->id;
                }
            } else {
                if ($okpo != "")
                $this->data['no_counterpaties_name'][$okpo] = $okpo;
            }
        }

    }

    public function unSetDataOKPO($okpo)
    {
        if(isset($this->data['counterpaties_name'][$okpo]))
        unset($this->counterparties_data_user[$okpo]);

        if (isset($this->data['counterpaties_name'][$okpo]))
        unset($this->data['counterpaties_name'][$okpo]);

        if (isset($this->data['no_counterpaties_name'][$okpo]))
        unset($this->data['no_counterpaties_name'][$okpo]);
    }
}
