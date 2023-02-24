<?php

namespace App\Http\Livewire\Forms;

use App\Models\SiteReferrer;
use Illuminate\Support\Collection;
use Livewire\Component;

class StatReferrerSourcesLivewire extends Component
{
//    const KEY = 'product_sales_rating';

    public bool $isUploadLazyContent = false;

    public function render()
    {
        $referrers = $this->revalidateReferrers();
//        $forwards = $this->forwards($products->pluck('id')->toArray());

        return view('livewire.forms.stat-referrer-sources-livewire',[
            'referrers' => $referrers,
//            'forwards' => $forwards,
        ]);
    }

    public function uploadLazyContent($payload = null)
    {
        $this->isUploadLazyContent = true;
    }

    protected function revalidateReferrers(): Collection
    {
        return $this->isUploadLazyContent
            ? SiteReferrer::take(100)->get()
            : collect([]);
    }

}
