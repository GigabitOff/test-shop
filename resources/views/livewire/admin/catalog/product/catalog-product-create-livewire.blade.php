<div>
    {{-- Catalog Category Create Livewire. --}}
    {{-- Catalog Category Edit Livewire. --}}
    <div class="container-large">
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])
    <h4>@lang('custom::admin.Product')</h4>
    @include('livewire.admin.catalog.product.includes.add-edit-single')
    </div>

</div>
