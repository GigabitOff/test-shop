<?php

namespace App\Http\Livewire\MainPage;

use App\Models\Setting;
use Livewire\Component;
use App\Services\ShopService;

class FooterContactsSectionLivewire extends Component
{
    public string $addressText = '';
    public string $addressMap = '';

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
            ->where('category', 'address')
            ->get();

        $this->addressText = $settings
            ->firstWhere('key', 'golovna_adresa')->value_lang ?? '';
        $this->addressMap = $settings
            ->firstWhere('key', 'golovna_adresa_karta')->value_lang ?? '';
    }

//    public function contacts()
//    {
//        return ShopService::getShopsData();
//    }

}
