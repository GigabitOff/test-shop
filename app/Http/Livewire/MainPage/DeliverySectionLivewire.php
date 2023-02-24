<?php

namespace App\Http\Livewire\MainPage;

use Livewire\Component;
use App\Models\Page;

class DeliverySectionLivewire extends Component
{
    public function render()
    {
        return view('livewire.main-page.delivery-section-livewire', ['pageDelivery' => $this->delivery()]);
    }


    public function delivery()
    {
    	$this->lang = app()->currentLocale();

        $deliveryPayment = Page::translatedIn(app()->currentLocale())->where('status', 1)
                            ->where('slug', 'delivery-payment')->get()->first();

        if (!isset($deliveryPayment->title) or $deliveryPayment->title == "")
            return redirect('/' . $this->lang);

        return $deliveryPayment;

    }
}
