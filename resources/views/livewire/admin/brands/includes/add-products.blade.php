<div class="col-12">
    <h5>@lang('custom::admin.Products select')</h5>
    <div >
        @if(!isset($product_tmp))
        @php($product_tmp = null)
    @endif
    <div wire:ignore>

        @livewire('admin.brands.brand-search-product-livewire', ['item_id'=>$item_id,'action_data'=>(isset($dataPage) ? $dataPage : null )], key(time().'-brand-search-product'))
    </div>
    </div>

</div>
