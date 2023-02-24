<div class="page-header__center">
    <div class="page-header__search search">
        <form class="search__control" autocomplete="off" action="javascript:void(0);">
            <input class="search__input" type="text" name="search"
                   wire:model.debounce.750ms="searchText"
                   onkeyup="document.mainSearch.keyUp(event, this)"
                   placeholder="@lang('custom::site.Search')">
            <span class="search__icon ico_search is-show" wire:ignore.self></span>
            <span class="search__clear" wire:click="clearSearch" wire:ignore.self></span>
        </form>
        <div class="search-dropdown" wire:ignore.self>
            @if($categories->isNotEmpty())
                <div class="search-left">
                    <ul class="search-menu">
                        @foreach($categories as $category)
                            <li class="search-menu__item @if($this->isActiveCategory($category)) is-active @endif"
                                data-id="{{$category->id}}"
                            >
                                <div class="search-menu__link">
                                    <div class="search-menu__link-img">
                                        <img src="{{$category->imageSrc}}" alt="category image">
                                    </div>
                                    <div class="search-menu__link-name">{{$category->name}}</div>
                                </div>
                                <div class="search-sub-menu search-sub-menu--mobile">
                                    <div class="search-sub-menu__title">{{$category->name}}</div>
                                    <div class="search-sub-menu__body">
                                        @if($category->productsExact->isNotEmpty())
                                            <div class="search-sub-menu__col">
                                                <ul class="search-list">
                                                    @foreach($category->productsExact as $product)
                                                        <li class="search-list__item">
                                                            <a class="search-list__link"
                                                               href="{{route('products.show', $product->slug)}}">{{$product->name}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                @if($category->showExactMoreBtn)
                                                    <a class="button-outline"
                                                       href="{{$category->urlExactShowAll}}">@lang('custom::site.full_list')</a>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="search-sub-menu__col">
                                            @if($category->productsMatch->isNotEmpty())

                                                <ul class="search-list">
                                                    @foreach($category->productsMatch as $product)
                                                        @break($loop->iteration > 10)
                                                        <li class="search-list__item">
                                                            <a class="search-list__link"
                                                               href="{{route('products.show', $product->slug)}}">{{$product->name}}</a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                                @if($category->showMatchMoreBtn)
                                                    <a class="button-outline"
                                                       href="{{$category->urlMatchShowAll}}">@lang('custom::site.full_list')</a>
                                                @endif
                                            @endif

                                        </div>
                                        <div class="search-sub-menu__col">
                                            @if($category->productsMatch->count() > 10)
                                                <ul class="search-list">
                                                    @foreach($category->productsMatch as $product)
                                                        @continue($loop->iteration <= 10)

                                                        <li class="search-list__item">
                                                            <a class="search-list__link"
                                                               href="{{route('products.show', $product->slug)}}">{{$product->name}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                        <div class="search-sub-menu__col">
                                            @if($category->productsMatch->count() > 20)
                                                <ul class="search-list">
                                                    @foreach($category->productsMatch as $product)
                                                        @continue($loop->iteration <= 20)

                                                        <li class="search-list__item">
                                                            <a class="search-list__link"
                                                               href="{{route('products.show', $product->slug)}}">{{$product->name}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="search-right">
                    <ul class="search-category-list">
                        @foreach($categories as $category)
                            <li class="search-sub-menu ssm-id{{$category->id}}
                            @if($this->isActiveCategory($category)) is-active @endif"
                            >
                                <div class="search-sub-menu__title">{{$category->name}}</div>
                                <div class="search-sub-menu__body">
                                    @if($category->productsExact->isNotEmpty())
                                        <div class="search-sub-menu__col">
                                            <ul class="search-list">
                                                @foreach($category->productsExact as $product)
                                                    <li class="search-list__item">
                                                        <a class="search-list__link"
                                                           href="{{route('products.show', $product->slug)}}">{{$product->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @if($category->showExactMoreBtn)
                                                <a class="button-outline"
                                                   href="{{$category->urlExactShowAll}}">@lang('custom::site.full_list')</a>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="search-sub-menu__col">
                                        @if($category->productsMatch->isNotEmpty())
                                            <ul class="search-list">
                                                @foreach($category->productsMatch as $product)
                                                    @break($loop->iteration > 10)
                                                    <li class="search-list__item">
                                                        <a class="search-list__link"
                                                           href="{{route('products.show', $product->slug)}}">{{$product->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @if($category->showMatchMoreBtn)
                                                <a class="button-outline"
                                                   href="{{$category->urlMatchShowAll}}">@lang('custom::site.full_list')</a>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="search-sub-menu__col">
                                        @if($category->productsMatch->count() > 10)
                                            <ul class="search-list">
                                                @foreach($category->productsMatch as $product)
                                                    @continue($loop->iteration <= 10)

                                                    <li class="search-list__item">
                                                        <a class="search-list__link"
                                                           href="{{route('products.show', $product->slug)}}">{{$product->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="search-sub-menu__col">
                                        @if($category->productsMatch->count() > 20)
                                            <ul class="search-list">
                                                @foreach($category->productsMatch as $product)
                                                    @continue($loop->iteration <= 20)

                                                    <li class="search-list__item">
                                                        <a class="search-list__link"
                                                           href="{{route('products.show', $product->slug)}}">{{$product->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @elseif($this->isSearchTextUpdated())
                <div class="search-empty">
                    <div class="search-sub-menu__title">@lang('custom::site.search_results_empty')</div>
                </div>
            @else
                <div class="search-empty">
                    <div class="search-sub-menu__title">@lang('custom::site.searching')</div>
                </div>
            @endif

        </div>
    </div>
    <div class="page-header__search-btn js-show-search">
        <i class="ico_search"></i>
    </div>

</div>

@push('custom-scripts')
    <script>
        document.mainSearch = {
            keyUp: function (e, target) {
                const text = target.value.trim()
                e = e || window.event;
                switch (e.key) {
                    case 'Enter':
                        if (text) {
                            @this.
                            set('searchText', text);
                        }
                        break;
                    case 'Escape':
                        // Clear search field by Escape
                        $(target).parent().find('.search__clear').trigger('click');
                }
            }
        }

        //# sourceURL=header-search-widget.js
    </script>
@endpush
