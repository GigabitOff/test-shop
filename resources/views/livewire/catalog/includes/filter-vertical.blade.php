<div class="products-filter-box">
    <form>
        <div class="products-filter-head">
            <div class="products-filter-head__title">@lang('custom::site.filter')</div>
            <div class="js-hide-filter products-filter-head__close ico_close"></div>
        </div>
        <div class="products-filter">
            <div class="products-filter-body">
                @include('livewire.catalog.includes.filter-body')
            </div>
            @if($filters)
                <div class="products-filter-footer">
                    <button class="button-outline" type="reset" onclick="@this.resetFilters()">
                        <span class="ico_close"></span>@lang('custom::site.Reset')</button>
                </div>
            @endif
        </div>
    </form>
</div>
