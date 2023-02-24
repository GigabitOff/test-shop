<div>
    {{-- Livewire Item show
    <div class="container-float">
        @include('livewire.admin.includes.head_button',['button'=>'wire:click=createBanner','lang'=>'admin.Banners create'])
    </div>
    <div class="container">
        @include('livewire.admin.includes.search')
    </div>--}}

    @switch($swith_show)
        @case('show')
            @include('livewire.admin.pages.shop_city.includes.show-item',['action_type'=>'showData'])
            @break
        @case('create')
            @include('livewire.admin.pages.shop_city.includes.add-edit',['action_type'=>'createData'])
            @break
        @case('edit')
            @include('livewire.admin.pages.shop_city.includes.add-edit',['action_type'=>'updateData','item_id'=>''])
            @break
        @default

    @endswitch

</div>
