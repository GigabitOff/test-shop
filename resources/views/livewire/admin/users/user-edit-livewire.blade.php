<div  class="container-medium">
    {{-- users edit livewire -- Акціїї редагування --}}
     @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])
    <h4>@lang('custom::admin.Users') / {{ isset($data[session('lang')]['name']) ? $data[session('lang')]['name'] : ''}}</h4>

    @include('livewire.admin.users.includes.add-edit-single')

</div>
