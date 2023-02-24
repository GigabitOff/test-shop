<div class="container-large">
    {{-- shop create livewire -- Контакти редагування --}}

    @include('livewire.admin.includes.head_button',['type'=>'return','title_lang'=>__('custom::admin.Filials') ,'route'=>'admin.shops.index'])
    <h4>@lang('custom::admin.Filials') / {{ isset($data[session('lang')]['title']) ? $data[session('lang')]['title'] : ''}}</h4>

    @include('livewire.admin.shop.includes.add-edit-single')


</div>
