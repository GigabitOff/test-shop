<div class="catalog-header">
    <div class="catalog-header__filter-left">

        <div class="catalog-header__filter-btn">
            <button class="js-show-filter button" type="button"><span class="ico_filter"></span><span
                    class="text">@lang('custom::site.Filters')</span></button>
        </div>

        <div class="drop --select"><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off"
                                          placeholder="@lang('custom::site.to hign price')">
            <button class="form-control drop-button" wire:ignore
                    type="button">@lang('custom::site.to hign price')</button>
            <div class="drop-box">
                <div class="drop-overflow">
                    <ul class="drop-list">
                        <li class="drop-list-item" wire:click="setOrderCheap">@lang('custom::site.to hign price')</li>
                        <li class="drop-list-item"
                            wire:click="setOrderExpensive">@lang('custom::site.to low price')</li>
                        <li class="drop-list-item" wire:click="setOrderPopular">@lang('custom::site.Popular')</li>
                        <li class="drop-list-item" wire:click="setOrderActions">@lang('custom::site.Actions')</li>
                        <li class="drop-list-item" wire:click="setOrderRating">@lang('custom::site.Rating')</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="drop --select"><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off"
                                          placeholder="@lang('custom::site.product sale filter')">
            <button class="form-control drop-button" type="button">
                @switch($order)
                    @case('sale')
                        @lang('custom::site.products on sale')
                        @break
                    @case('markdown')
                        @lang('custom::site.markdown')
                        @break
                    @case('novelties')
                        @lang('custom::site.Novelty')
                        @break
                    @default
                        @lang('custom::site.product sale filter')
                @endswitch
            </button>
            <div class="drop-box">
                <div class="drop-overflow">
                    <ul class="drop-list">
                        <li class="drop-list-item" wire:click="setOrderCheap">@lang('custom::site.reset filter')</li>
                        <li class="drop-list-item"
                            wire:click="setOrderSale">@lang('custom::site.products on sale') </li>
                        <li class="drop-list-item" wire:click="setOrderMarkdown">@lang('custom::site.markdown')</li>
                        <li class="drop-list-item" wire:click="setOrderNovelty">@lang('custom::site.Novelty')</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="catalog-header__filter-right">

        <div class="drop --select"><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off"
                                          placeholder="15">
            <button class="form-control drop-button" type="button">{{session()->get('perPage', 15)}}</button>
            <div class="drop-box">
                <div class="drop-overflow">
                    <ul class="drop-list">
                        @for ($i = 15; $i <= 60; $i+=15)
                            <li class="drop-list-item" onclick="@this.setPerPage({{$i}})">{{$i}}</li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
        <div class="change-view">
            <div class="change-view-item --grid @if(empty($_COOKIE['catalogView'])) is-active @endif"><i
                    class="ico_view-list"></i></div>
            <div class="change-view-item --list @if(isset($_COOKIE['catalogView'])) is-active @endif"><i
                    class="ico_view-grid"></i></div>
        </div>
    </div>
</div>
