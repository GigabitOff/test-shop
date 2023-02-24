<div class="products-filter-box">
    <div class="products-filter-head">
        <div class="products-filter-head__title">@lang('custom::site.filter')</div>
        <div class="js-hide-filter products-filter-head__close ico_close"></div>
    </div>
    <form>
        <div class="filters-box">
            <div class="filters-grid">
                @include('livewire.catalog.includes.filter-body-top')
            </div>
        </div>
    </form>
    @if($filters)
        <div class="products-filter-footer">
            <button class="button-outline" type="reset" onclick="@this.resetFilters()">
                <span class="ico_close"></span>@lang('custom::site.Reset')</button>
        </div>
    @endif
</div>
