    {{--  // Секция "Поиск" --}}
    @include('livewire.catalog.includes.filters.search',[
        'title' => __('custom::site.Search'),
        'model' => 'search',
        'placeholder' => __('custom::site.Find the product'),
        'collapsed' => false,
        'key' => 'search',
    ])

    {{-- // Секция "Категории" --}}
    @include('livewire.catalog.includes.filters.category-checkbox',[
        'title' => __('custom::site.categories'),
        'list' => $enabledCategories,
        'collapsed' => false,
        'key' => 'category_id',
    ])

    {{-- // Секция "Фильтр по цене" --}}
    @if($filteredRangePrice)
        @include('livewire.catalog.includes.filters.range',[
            'title' => __('custom::site.price') . ', ₴',
            'list' => $filteredRangePrice,
            'collapsed' => false,
            'key' => 'price_range',
        ])
    @endif

    {{-- // Секция "Фильтры по атрибутам" --}}
    @foreach($filteredAttributes as $attrFilter)
{{--        @continue(count($attrFilter['values']) <= 1)--}}
        @include('livewire.catalog.includes.filters.attr-' . $attrFilter['type'],[
            'title' => $attrFilter['label'],
            'list' => $attrFilter['values'],
            'searchable' => $attrFilter['searchable'],
            'collapsed' => $attrFilter['collapsed'],
            'key' => "attr_{$attrFilter['key']}",
        ])
    @endforeach

    {{-- // Секция "Бренды" --}}
{{--    @if($filteredBrands && count($filteredBrands) > 1)--}}
    @if($filteredBrands)
        @include('livewire.catalog.includes.filters.brand-checkbox',[
            'title' => __('custom::site.Brand'),
            'list' => $filteredBrands,
            'collapsed' => false,
            'key' => 'brand_id',
        ])
    @endif
