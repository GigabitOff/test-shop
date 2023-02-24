<div>
    {{-- Livewire Item show --}}
    <div class="container-float">
    @switch($swith_show)
        @case('show')
            @include('livewire.admin.catalog.services.includes.show-item',['action_type'=>'showData'])
            @break
        @case('create')
            @include('livewire.admin.catalog.services.includes.add-edit',['action_type'=>'createData'])
            @break
        @case('edit')
            @include('livewire.admin.catalog.services.includes.add-edit',['action_type'=>'updateData','item_id'=>''])
            @break
        @default

    @endswitch
    </div>
</div>
