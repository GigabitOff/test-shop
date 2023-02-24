<div>
    {{-- Catalog Category Edit Livewire. --}}
    <div class="container-large">
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])
    <h4>@lang('custom::admin.Product') / {{ isset($data[session('lang')]['name']) ? $data[session('lang')]['name'] : ''}}</h4>

    @include('livewire.admin.catalog.product.includes.add-edit-single')
    </div>

</div>
