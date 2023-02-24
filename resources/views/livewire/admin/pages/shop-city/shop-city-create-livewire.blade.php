<div>
    {{-- banners edit livewire -- Акціїї редагування --}}
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])
    <h4>@lang('custom::admin.City name')</h4>
    @include('livewire.admin.pages.shop-city.includes.add-edit-single')

</div>
