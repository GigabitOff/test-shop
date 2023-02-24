<?php

namespace App\Http\Livewire\Traits;

use App\Models\OrderProductPivot;
use App\Models\PersonalOffer;
use App\Models\Product;

trait WithProductPersonalOffer
{
    public function getPersonalOfferSelfProduct(OrderProductPivot $pivot)
    {
        return $this->isProductBelongValidOffer($pivot)
            ? Product::whereRelation('personalOffer', 'id_1c', $pivot->options['personal_offer_id_1c'])->first()
            : null;

    }
    public function isProductBelongOffer(OrderProductPivot $pivot): bool
    {
        return $pivot->options
            && !empty($pivot->options['personal_offer_id_1c']);
    }

    public function isProductBelongValidOffer( OrderProductPivot $pivot): bool
    {
        return $this->isProductBelongOffer($pivot)
            && PersonalOffer::query()
                ->onlyValid()
                ->where('id_1c', $pivot->options['personal_offer_id_1c'])->exists();
    }
}
