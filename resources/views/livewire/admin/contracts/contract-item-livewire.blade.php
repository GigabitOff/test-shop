<div>

   @switch($swith_show)
        @case('show')
            @include('livewire.admin.contracts.includes.show-item',['action_type'=>'showData'])
            @break
        @case('create')
            @include('livewire.admin.contracts.includes.add-edit',['action_type'=>'createData'])
            @break
        @case('edit')
            @include('livewire.admin.contracts.includes.add-edit',['action_type'=>'updateData','item_id'=>''])
            @break
        @default

    @endswitch

 
</div>
