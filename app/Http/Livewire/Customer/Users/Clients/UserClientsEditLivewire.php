<?php

namespace App\Http\Livewire\Customer\Users\Clients;

use App\Http\Livewire\Customer\Users\Clients\UserClientsComponentLivewire;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Counterparty;
use App\Models\City;
use App\Models\User;
use Livewire\WithPagination;

class UserClientsEditLivewire extends UserClientsComponentLivewire
{
    use WithFileUploads;
    use WithPagination;

    public $phone;
    protected $rules = [
        "phone" => "required|min:4|unique:users",
    ];

    protected $listeners = [
        'resetLang' => 'resetData',
        'changesStart' => 'changesStart',
        'addDataForSaveUser' => 'addDataForSaveUser',

    ];

    public function mount()
    {
        $this->languages = $this->getLang(true);

        $this->swith_show = 'redirect';

        $this->getData();

        $this->shop_cities = City::limit(20)->get()->keyBy('id');
        // dd($this->dataItem);
        if (isset($this->data['city_id']) and $this->data_collect->getCity) {
            $this->select_data['city']['id'] = $this->data['city_id'];
            $city = City::find($this->select_data['city']['id']);
            $this->select_data['city']['input'] = $city->name_uk;
        } elseif (isset($this->select_data['city']['id'])) {
            //dd($this->select_data['city']['id']);
            $city = City::find($this->select_data['city']['id']);
            //$this->select_data['city_id']['id'] = $this->data['city_id'];
            //$this->select_data['city_id']['input'] = $city->translate(session('lang'))->title;
            $this->select_data['city']['input'] = $city->name_uk;
        }
        //$select_cities = $this->updatedCity('', true);

        //dd($select_cities);
        //$this->select_cities = $this->searchSelectDatatoArray($select_cities, 'name_uk', 'district_uk');

    }

    public function render()
    {
        return view('livewire.customer.users.clients.user-clients-edit-livewire');
    }

    public function updated($field)
    {
        if ($field == 'select_data.city.input') {
            $this->reset(['select_cities']);
            $select_cities = $this->updatedCityOld($this->select_data['city']['input'], true);

            $this->select_array['city'] = $this->searchSelectDatatoArray($select_cities, 'name_uk', 'district_uk');
            // $this->validateDataUser();
        }

        if ($field == 'select_data.counterparty_id.input') {
            $this->reset(['counterparties_select']);
            // dd($this->select_data['counterparty_id']['input']);
            $res = Counterparty::where('name', 'like', "%{$this->select_data['counterparty_id']['input']}%")->orwhere('okpo', 'like', "%{$this->select_data['counterparty_id']['input']}%")->get();

            $this->counterparties_select = $this->searchSelectDatatoArray($res);
        }

        if ($field == 'select_data.change_manager.input') {
            $this->reset(['change_manager_select']);
            // dd($this->select_data['counterparty_id']['input']);
            $res = User::where('id', 'LIKE', "%{$this->select_data['change_manager']['input']}%")->role('manager')->get();

            if (count($res) == 0)
                $res = User::whereTranslationLike('name', "%{$this->select_data['change_manager']['input']}%", session('lang'))->role('manager')->get();


            $this->data['date_to'] = \Carbon\Carbon::now()->format('d.m.Y');
            $this->change_manager_select = $this->searchSelectDatatoArray($res);
            //dd($this->change_manager_select);
        }

        if ($field == 'select_data.manager_id.input') {
            unset($this->select_array['manager_id']);
            // dd($this->select_data['counterparty_id']['input']);
            $res = User::where('id', 'LIKE', "%{$this->select_data['manager_id']['input']}%")->role('manager')->get();

            if (count($res) == 0)
                $res = User::whereTranslationLike('name', "%{$this->select_data['manager_id']['input']}%", session('lang'))->role('manager')->get();


            $this->select_array['manager_id'] = $this->searchSelectDatatoArray($res);
            //dd($this->change_manager_select);
        }

        $this->validateDataUser();
    }

    public function saveData()
    {
        $this->updateData();

        return redirect()->route('customer.users.index');
    }
}
