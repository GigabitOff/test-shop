<div class="col-12">
    @if(isset($item_id))
    <div class="form-group product-info">
        <p class="mb-3 text-small">@lang('custom::admin.Analogues of goods')</p>
    <div wire:ignore wire:key="search-category-analog1">
        @livewire('admin.catalog.catalog-search-category-livewire', ['from_category'=>'hide','category_id'=>$item_id,'table_name'=>'category_analog_categories'], key(time().'-catalog-search-analog-category'))

    </div>
    </div>
    <div class="form-group product-info">
        <p class="mb-3 text-small">
            @lang('custom::admin.Related products')
        </p>

    <div wire:ignore wire:key="search-category-analog1">
        @livewire('admin.catalog.catalog-search-category-livewire', ['from_category'=>'hide','category_id'=>$item_id,'table_name'=>'category_related_categories'], key(time().'-catalog-search-related-category'))
    </div>
    </div>
    @endif
</div>

