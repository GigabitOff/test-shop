<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\Popup;
use App\Models\City;
use App\Models\Category;
use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BaseSiteComponentLivewire extends Component
{
    public $dataItem, $item_id,
        //$perPage,
        $dataItemCount = 0,
        $data,
        $select_array,
        $popupData,
        $popup_id,
        $search = '',
        $languages,
        $item_lang,
        $subject = 'Повідомлення з попап',
        $search_product,
        $selectedData = [],
        $all_data,
        $redirect;

   // protected $paginationTheme = 'bootstrap_site';


    public function boot()
    {

        //$this->perPage = (session()->has('perPage') ? session('perPage') : 20);

    }

    public function  getLang($collection = null)
    {
        if (!session()->has('perPage')) {
            session()->put('perPage', $this->perPage);
        }
        $langs = Language::where('status', 1)->get();
        if ($collection !== null) {
            return $langs;
        } else {
            foreach ($langs as $key => $value) {
                //if(app()->currentLocale() != $key)
                $lang[$value->lang] = $value->name;
                # code...
            }
            return $lang;
        }
    }



    public function changePerPage($index)
    {

        session()->put('perPage', $index);
        //$this->perPage = $index;
        $this->resetPage();
        //$this->resetData();
    }


    public function resetData()
    {
        $this->mount();
    }


    public function searchSelectDataArrow($index, $value, $search_key = 'name', $select_array_key = 'null', $with_parent_id = 'null')
    {

        if (isset($this->tableSearchClass) and $value != "") {

            if ($with_parent_id !== 'null')
                $select_array = $this->tableSearchClass::translatedIn(app()->currentLocale())->whereTranslationLike($search_key, "%$value%")->where('parent_id', $with_parent_id)->get()->keyBy('id');

            if ($select_array_key !== 'null') {
                $this->select_array[$select_array_key] = $select_array;
            } else {
                $this->select_array = $select_array;
            }
        }
        // dd($this->select_array);

    }

    public function searchSelectDatatoArray($data, $key_name = 'name', $key_description = 'description')
    {
        $tmp = [];
        foreach ($data as $key => $value) {
            $tmp[$key]['id'] = $value->id;

            if (isset($value[$key_name]))
                $tmp[$key][$key_name] = $value[$key_name];

            if (isset($value[$key_description]))
                $tmp[$key][$key_description] = $value[$key_description];
        }
        return $tmp;
    }

    public function getManagers($id)
    {
        $managers = null;

        if ($this->popupData) {
            $popup = $this->popupData;
            $contucts = $popup->contucts;
            if (count($contucts) > 0) {
                foreach ($contucts as $key_c => $value_c) {
                    if (count($value_c->users) > 0) {
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

    public function getCustomers()
    {
        $data = User::where('email', $this->data['email']);

        if (isset($this->data['phone']))
        $data = $data->orWhere('phone', clearPhoneNumber($this->data['phone']));

        $data = $data->first();

        return $data;
    }

    protected function resetForm()
    {
        $this->reset('data', 'popup');
        $this->popup_id;

        $this->resetValidation();
        $this->dispatchBrowserEvent('reset_departmentId_toDefault');
    }

    public function selectDataItem($id, $all = null)
    {
        if ($all) {
            if (!isset($this->selectedData['all'])) {

                $this->selectedData['all'] = true;

                foreach ($this->all_data as $key => $value) {
                    if (!isset($value['deleted_at']))
                    $this->selectedData[$value['id']] = $value['id'];
                }
            } else {

                $this->reset(['selectedData']);
            }
        } else {

            if (!isset($this->selectedData[$id])) {
                $this->selectedData[$id] = $id;
            } else {

                unset($this->selectedData[$id]);
                unset($this->selectedData['all']);
            }

        }
    }

    public function destroyAllData()
    {
        if (isset($this->selectedData) and count($this->selectedData) > 0) {
            foreach ($this->selectedData as $key => $value) {
                $this->destroyData($key);
                unset($this->selectedData[$key]);
            }
        }
        $this->resetPage();
    }

}
