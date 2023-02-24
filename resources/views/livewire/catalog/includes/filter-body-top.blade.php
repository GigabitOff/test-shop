    {{--  // Секция "Поиск" --}}
    <div class="search__control search-cont">
        <input class="filter-search__input" type="text"
               wire:model.debounce.750ms="search"
               placeholder="@lang('custom::site.Find the product')">
        <span class="filter-search__clear @if($search) is-show @endif"
              onclick="@this.set('search', '')"
              wire:ignore></span>
    </div>

    {{-- // Секция "Категории" --}}
    <div class="filter-drop" wire:ignore.self>
        <button class="filter-drop-btn" type="button">
            <span class="filter-drop-val">@lang('custom::site.categories')</span>
            <span class="filter-drop-arw"></span>
        </button>
        <div class="filter-drop-box">
            <div class="filter-drop-list">
                @foreach($enabledCategories as $item)
                    @php($key="category_id")
                    @if($item['label'] && $item['key'])
                        <li>
                            <label class="check">
                                <input class="check__input" id="cat-{{ $key }}-{{ $item['key'] }}"
                                       onclick="@this.setFilterItemData('{{$key}}','{{ $item['key'] }}', this.checked)"
                                       @if($item['checked']) checked @endif
                                       type="checkbox"/>
                                <span class="check__box"></span>
                                <span class="check__txt">{{$item['label']}}</span>
                            </label>
                        </li>
                    @endif
                @endforeach
            </div>
            @if($parentCategoryId != 0)
                <a class="filter-back ico_angle-left" href="{{route('catalog.index')}}">@lang('custom::site.back')</a>
            @endif
            <div class="filter-drop-footer">
                <button class="clear"
                        wire:click="resetFilters('category')"
                        type="button">@lang('custom::site.Reset')</button>
                <button class="save" type="button">Зберегти</button>
            </div>
        </div>
    </div>

{{--    @include('livewire.catalog.includes.filters.category-checkbox',[--}}
{{--        'title' => __('custom::site.categories'),--}}
{{--        'list' => $enabledCategories,--}}
{{--        'collapsed' => false,--}}
{{--        'key' => 'category_id',--}}
{{--    ])--}}

    {{-- // Секция "Фильтр по цене" --}}
    @if($filteredRangePrice)
        @php($key = 'price_range')
        <div class="filter-drop">
            <button class="filter-drop-btn" type="button">
                <span class="filter-drop-val">@lang('custom::site.price'), ₴</span>
                <span class="filter-drop-arw"></span></button>
            <div class="filter-drop-box">
                <div class="filter-drop-price">
                    <div class="range-box" wire:ignore data-range_min="{{$filteredRangePrice['min']}}">
                        <div class="range-box-inputs">
                            <input class="range-price-from" type="text"
                                   id="range_price_from_{{$key}}"
                                   value="0"
                                   placeholder="@lang('custom::site.from')">
                            <input class="range-price-to" type="text"
                                   id="range_price_to_{{$key}}"
                                   value="0"
                                   placeholder="@lang('custom::site.to')">
                        </div>
                        <input class="range-price js-range-slider" data-key="{{$key}}" type="text" name="price" value="">
                    </div>
                    <script>
                        document.rangePriceValues = @js($filteredRangePrice);
                    </script>
                </div>
                <div class="filter-drop-footer">
                    <button class="clear" type="button">Скинути</button>
                    <button class="save" type="button">Зберегти</button></div>
            </div>
        </div>


{{--        @include('livewire.catalog.includes.filters.range',[--}}
{{--            'title' => __('custom::site.price') . ', ₴',--}}
{{--            'list' => $filteredRangePrice,--}}
{{--            'collapsed' => false,--}}
{{--            'key' => 'price_range',--}}
{{--        ])--}}
    @endif

    {{-- // Секция "Фильтры по атрибутам" --}}
    @foreach($filteredAttributes as $attrFilter)
{{--        @continue(count($attrFilter['values']) <= 1)--}}
        @include('livewire.catalog.includes.filters.attr-drop-' . $attrFilter['type'],[
            'title' => $attrFilter['label'],
            'list' => $attrFilter['values'],
            'searchable' => $attrFilter['searchable'],
            'key' => "attr_{$attrFilter['key']}",
        ])
    @endforeach

    {{-- // Секция "Бренды" --}}
{{--    @if($filteredBrands && count($filteredBrands) > 1)--}}
    @if($filteredBrands)
        @include('livewire.catalog.includes.filters.brand-drop-checkbox',[
            'title' => __('custom::site.Brand'),
            'list' => $filteredBrands,
            'key' => 'brand_id',
        ])
    @endif
