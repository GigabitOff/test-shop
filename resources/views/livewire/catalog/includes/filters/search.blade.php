<x-filter.item
    :title="$title"
    :collapsed="$collapsed"
    :key="$key"
>
    <div class="filter-search">
        <div class="search__control search-cont">
            <input class="filter-search__input" type="text"
                   wire:model.debounce.750ms="{{$model}}"
                   placeholder="@lang('custom::site.Find the product')">
            <span class="filter-search__clear @if($$model) is-show @endif"
                  onclick="@this.set('{{$model}}', '')"
                  wire:ignore></span>
        </div>
    </div>
</x-filter.item>
