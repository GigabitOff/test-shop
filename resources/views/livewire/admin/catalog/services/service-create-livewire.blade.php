<div  class="container-large">
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])

    <h4>@lang('custom::admin.Services')</h4>

    @include('livewire.admin.catalog.services.includes.add-edit-single')
</div>
