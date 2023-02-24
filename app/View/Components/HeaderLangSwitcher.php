<?php

namespace App\View\Components;

use Illuminate\Support\Facades\App;
use Illuminate\View\Component;
use App\Models\Language;

class HeaderLangSwitcher extends Component
{
    public string $current = '';
    public array $locales = [];
    public string $classes = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($classes)
    {
        $this->classes = $classes;

        $current = App::currentLocale();
        $showLanguages = Language::where('status', 1)->get();
        $this->locales = $showLanguages
            ->map(function ($locale) use ($current) {
                return [
                    'href' => route('setLocale', $locale->lang),
                    'name' => ucfirst($locale->lang),
                    'class' => ($locale->lang === $current ? 'active' : ''),
                ];
            })->toArray();


        $this->current = ucfirst($current);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header-lang-switcher');
    }
}
