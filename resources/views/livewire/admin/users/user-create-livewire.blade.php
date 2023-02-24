<div  class="container-medium">
    {{-- users edit livewire -- Акціїї редагування --}}
     @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])
    <h4>@lang('custom::admin.Users') </h4>
@include('livewire.admin.users.includes.add-edit-single')

</div>
