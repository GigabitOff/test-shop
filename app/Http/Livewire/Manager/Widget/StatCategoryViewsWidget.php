<?php

namespace App\Http\Livewire\Manager\Widget;

use App\Models\CategoryVisit;
use App\Models\Setting;
use Livewire\Component;

class StatCategoryViewsWidget extends Component
{
    const KEY = 'category_views_rating';

    public array $views = [];
    public array $forwards = [];

    public function mount()
    {
        $this->evaluateViews();
        $this->evaluateForwards();
    }

    public function render()
    {
        return view('livewire.manager.widget.stat-category-views-widget', []);
    }

    public function clearForwards()
    {
        $newest = array_column($this->views, 'id');

        Setting::query()->updateOrInsert(
            ['key' => self::KEY],
            ['value' => implode(',', $newest)]
        );

        $this->reset('forwards');
    }

    protected function evaluateViews()
    {
        $this->views = CategoryVisit::query()
            ->with('category', function ($q){
                $q->withTranslation()
                    ->select('id', 'slug');
            })
            ->orderBy('quantity', 'desc')
            ->take(100)->get()
            ->each(function ($el) {
                $el->categoryId = $el->category->id;
                $el->categorySlug = $el->category->slug;
                $el->categoryName = $el->category->name;
            })
            ->toArray();
    }

    protected function evaluateForwards()
    {
        $last = Setting::query()->where('key', self::KEY)->first();
        $oldest = explode(',', $last->value ?? '');

        $newest = array_column($this->views, 'id');
        $this->forwards = array_diff($newest, $oldest);
    }

}
