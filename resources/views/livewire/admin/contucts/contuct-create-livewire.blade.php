<div>
    {{-- contucts edit livewire -- Акціїї редагування --}}
@include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.contucts.index'])
     <h4>@lang('custom::admin.Units') / {{ isset($data[session('lang')]['title']) ? $data[session('lang')]['title'] : ''}}</h4>

     @include('livewire.admin.contucts.includes.add-edit')

</div>
