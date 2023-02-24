<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;
use App\Models\Menu;
use App\Models\MenuCategory;

class PageHeaderMenuLivewire extends Component
{
    public $data,$catalog;


    public function mount()
    {

        /** Вибірка для меню з Сторінок де позначено що Головне меню */
        $this->data = MenuCategory::query()
            ->withTranslation()
            ->with('page.translations')
            ->where('page_id','!=', null)->where('category_id', null)->orderBy('order','ASC')->get();
        $this->catalog = MenuCategory::query()
            ->withTranslation()
            ->with('category.translations')
            ->where('page_id', null)->where('category_id','!=', null)->orderBy('order','ASC')->get();

        if(count($this->data) == 0)
        $this->reset(['data']);
        //dd(Menu::where('parent_id','<>',0)->get());

    }

    public function render()
    {

        return view('livewire.menu.page-header-menu-livewire');
    }
}
