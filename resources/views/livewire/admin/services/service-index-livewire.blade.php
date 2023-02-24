<div>
    @include('livewire.admin.includes.head_button',['type'=>'return','title_lang'=>__('custom::admin.pages'), 'route'=>'admin.pages.index'])
    <h4>@if(isset($data[session('lang')]['title'])){{$data[session('lang')]['title']}}@else{{ __('custom::admin.Services')}}@endif</h4>
    <div wire:ignore>
        @livewire('admin.partials.header-livewire')
    </div>

    @include('livewire.admin.services.includes.show-item')
</div>
