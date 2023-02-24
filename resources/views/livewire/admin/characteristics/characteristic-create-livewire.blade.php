<div>

    @include('livewire.admin.includes.head_button',['type'=>'return','title_lang'=>__('custom::admin.Characteristics'), 'route'=>'admin.characteristics.index'])
    <h4>@lang('custom::admin.Characteristics') / {{ $data[session('lang')]['name'] ?? __('custom::admin.characteristic_new') }}</h4>
    <div wire:ignore>
        @livewire('admin.partials.header-livewire')
    </div>

    @include('livewire.admin.characteristics.includes.add-edit')

</div>
