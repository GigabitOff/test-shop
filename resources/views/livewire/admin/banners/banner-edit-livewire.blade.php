<div>
    {{-- banners edit livewire -- Акціїї редагування --}}
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])
    <h4 class="text-md-center text-lg-start">@lang('custom::admin.Banners') / {{ $data[session('lang')]['title'] ?? ''}}</h4>

    @include('livewire.admin.banners.includes.add-edit-single')

</div>
