<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\Page;
use App\Models\City;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BaseSiteComponentLivewire extends Component
{
    public $dataItem, $item_id,
        $perPage,
        $dataItemCount = 0,
        $data,
        $search = '',
        $languages,
        $item_lang,
        $search_product,
        $redirect;

    protected $paginationTheme = 'bootstrap_site';


    public function boot()
    {

        $this->perPage = (session()->has('perPage') ? session('perPage') : 20);

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
        $this->perPage = $index;
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

}
