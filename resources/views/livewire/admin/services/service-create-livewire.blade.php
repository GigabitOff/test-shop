<div>

    @include('livewire.admin.includes.head_button',['type'=>'return','title_lang'=>__('custom::admin.Services'), 'route'=>'admin.services.index'])
    <h4>@lang('custom::admin.Services') / @if(isset($data[session('lang')]['title'])){{$data[session('lang')]['title']}}@else{{ __('custom::admin.service_new')}}@endif</h4>
    <div wire:ignore>
        @livewire('admin.partials.header-livewire')
    </div>

    @include('livewire.admin.services.includes.add-edit')

</div>
