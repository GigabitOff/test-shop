<?php

namespace App\Http\Livewire\MainPage;

use App\Models\Action;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ActionsSectionLivewire extends Component
{
    public ?Collection $action = null;

    public function mount()
    {
        $this->evaluateActions();
    }

    public function render()
    {
        return view('livewire.main-page.actions-section-livewire');
    }

    protected function evaluateActions()
    {
        $this->actions = Action::query()
            ->withTranslation()
            ->where('on_main', true)
            ->where('date_start', '<=', now()->format('Y-m-d'))
            ->where('date_end', '>=', now()->format('Y-m-d'))
            ->orderBy('order')
            ->take(1)   /** отображаем только одну акцию */
            ->get()

            ->each(function (Action $action) {
                $this->expandImage($action);
            });
    }

    protected function expandImage(Action $action)
    {
        $action->imageUrl = $action->image && Storage::disk('public')->exists($action->image)
            ? Storage::disk('public')->url($action->image)
            : fallbackBaseImageUrl('');
    }
}
