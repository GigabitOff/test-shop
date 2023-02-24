<?php

namespace App\Http\Livewire\Manager\Widget;

use App\Models\SiteReferrer;
use Livewire\Component;

class StatReferrerSourcesWidget extends Component
{
    public function render()
    {
        $referrers = $this->revalidateReferrers();
        return view('livewire.manager.widget.stat-referrer-sources-widget', [
            'referrers' => $referrers,
        ]);
    }

    protected function revalidateReferrers()
    {
        return SiteReferrer::query()
            ->take(6)
            ->get();
    }
}
