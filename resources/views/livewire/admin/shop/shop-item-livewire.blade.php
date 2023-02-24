<div>
    {{-- Livewire Item show --}}
    <div class="container-float">
        @include('livewire.admin.includes.head_button',['button'=>'wire:click=createDataItem','lang'=>'admin.Jobs create'])
    </div>
    <div class="container">
        @include('livewire.admin.includes.search')
    </div>
    <div class="container-float">
    @switch($swith_show)
        @case('show')
            @include('livewire.admin.shop.includes.show-item',['action_type'=>'showData'])
            @break
        @case('create')
            @include('livewire.admin.shop.includes.add-edit',['action_type'=>'createData'])
            @break
        @case('edit')
            @include('livewire.admin.shop.includes.add-edit',['action_type'=>'updateData','item_id'=>''])
            @break
        @default

    @endswitch

    </div>
</div>
