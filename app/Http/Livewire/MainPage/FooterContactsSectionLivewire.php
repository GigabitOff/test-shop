<?php

namespace App\Http\Livewire\MainPage;

use App\Models\Setting;
use Livewire\Component;
use App\Models\Shop;

class FooterContactsSectionLivewire extends Component
{
    public string $addressText = '';
    public string $addressMap = '';
    public  $settingAddresses = [];

    public function mount()
    {
        $this->evaluateSettings();
    }

    public function render()
    {
        return view('livewire.main-page.footer-contacts-section-livewire');
    }

    protected function evaluateSettings()
    {
        $settings = Setting::query()
            ->where('category', 'address_footer')
            ->first();

        if($settings)
        {
            $settingAddresses = json_decode($settings->json,true);
            if(count($settingAddresses)>0)
            {
                foreach ($settingAddresses as $key => $value) {
                    # code...
                    $resData=Shop::find($value);
                    if($resData)
                    {
                        $shop_collection[] = $resData;
                    }
                }

                $this->settingAddresses = collect($shop_collection)->flatten();
            }

        }
      //  $this->addressText = $settings
           // ->firstWhere('key', 'golovna_adresa')->value_lang ?? '';
      //  $this->addressMap = $settings
           // ->firstWhere('key', 'golovna_adresa_karta')->value_lang ?? '';
    }

//    public function contacts()
//    {
//        return ShopService::getShopsData();
//    }

}
