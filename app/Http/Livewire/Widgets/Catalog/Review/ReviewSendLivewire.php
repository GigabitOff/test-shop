<?php

namespace App\Http\Livewire\Widgets\Catalog\Review;

use Livewire\Component;
use App\Models\Review;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewSendLivewire extends Component
{
    public $item_id, $category_id,
    $data, $all_products,
    $data_tovar,$success=false;
    public string $phoneRaw = '';
    protected $rules = [
        "data.rating" => "required",
        "data.name" => "required|min:4",
        "data.text" => "required|min:4",
        "data.phone" => "required|min:12",
        ];
    public function mount()
    {
        $this->user = Auth::user();

        $this->data['product_id'] = $this->item_id;

        if(isset(Auth::user()->id)){
        $this->data['user_id'] = $this->user->id;
        //$this->data['name'] = Auth::user()->name;
        //$this->data['phone'] = Auth::user()->phone;
        if(Auth::user()->email)
        $this->data['email'] = $this->user->email;
        }

    }
    public function render()
    {

        if ($this->success){
            return view('livewire.widgets.catalog.review.review-success-livewire');
        }

        return view('livewire.widgets.catalog.review.review-send-livewire');
    }
    public function updatedPhoneRaw($value){
        $this->data['phone'] = preg_replace('/\D/', '',$value);
    }

    public function selectProduct($id)
    {
        $data = Product::find($id);
        if($data){
            $this->data['product_id'] = $data->id;
        }
    }


    public function sendData()
    {
        $this->validate();

        $this->data[app()->currentLocale()]['fio'] = $this->data['name'];

        $res = Review::create($this->data);
        if($res)
        $this->success = true;
    }
}
