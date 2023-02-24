<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use App\Models\Contuct;
//use App\Models\Shop;
use App\Services\ShopService;

class ContactIndexLivewire extends Component
{
    public $data,$shops, $contucts, $showData=0, $page;

    public function mount()
    {
        $this->shops = ShopService::getShopsData();

        $this->contucts = Contuct::where('parent_id',0)->get();

    }

    public function render()
    {

        return view('livewire.contact.contact-index-livewire');
    }

    public function showContuct($index, $data = null)
    {
        if($this->showData == $index):
        $this->showData = -1;
        else:
        $this->showData = $index;
        endif;




        //dd($this->show);
    }
}
