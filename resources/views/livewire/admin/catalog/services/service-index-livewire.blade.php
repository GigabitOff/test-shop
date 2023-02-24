<div class="container-large">
    {{-- services livewire -- Бренди управління admin.catalog.services.create
    @include('livewire.admin.includes.head_button',['type'=>'return','hide_popup'=>true, 'route'=>'admin.pages.index','title_lang'=>__('custom::admin.Return to list page')])--}}
    <h4>@lang('custom::admin.Services')</h4>

            @include('livewire.admin.catalog.services.includes.tablist.general-tab')



    {{-- <div class="container">
        @include('livewire.admin.includes.search')
    </div>--}}

</div>
