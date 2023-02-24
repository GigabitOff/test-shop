<div class="col-12">
    <h5>@lang('custom::admin.Products select')</h5>
    <div wire:ignore>
        @livewire('admin.actions.action-search-product-livewire', ['item_id'=>$item_id,'action_data'=>(isset($action_data) ? $action_data : null )], key(time().'-action-search-product'))

    </div>


</div>
