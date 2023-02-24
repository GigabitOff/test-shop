<div>
    {{-- banners edit livewire -- Акціїї редагування --}}
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.options.index'])
    <h4>@lang('custom::admin.Option name')</h4>
    @include('livewire.admin.options.includes.add-edit-single')

</div>
