<div class="col-12">
    <h5>@lang('custom::admin.Products select')</h5>
    <div wire:ignore>
        @livewire('admin.catalog.services.service-search-product-livewire', ['item_id'=>$item_id,'action_data'=>(isset($dataPage) ? $dataPage : null )], key(time().'-action-search-product'))

    </div>


</div>
