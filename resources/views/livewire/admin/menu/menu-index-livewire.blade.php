<div class="container-small">
<h4>@lang('custom::admin.Menu')</h4>

    <div class="mb-3" wire:ignore>
        <h6>@lang('custom::admin.Category list')</h6>

    @livewire('admin.menu.menu-category.menu-category-item-livewire', ['type'=>'category','menu_title'=>__('custom::admin.Category')], key(time().'-menu-category-item'))
    </div>

    <div class="mb-3"  wire:ignore>
        <h6>@lang('custom::admin.Pages list')</h6>
    @livewire('admin.menu.menu-category.menu-category-item-livewire', ['type'=>'pages','menu_title'=>__('custom::admin.Pages')], key(time().'-menu-pages-item'))
    </div>
    <div class="mb-3">

        @include('livewire.admin.includes.save-data-include',['on_click'=>'emit("saveDataMenuCategory")','wire_click'=>'saveData','title_button'=>__('custom::admin.Save')])

    {{--<button class="button" type="button" onclick="@this.emit('saveDataMenuCategory'); " wire:click="saveData">@lang('custom::admin.Save')</button>--}}
    </div>

</div>
