<div>
    {{-- Livewire Item show --}}
    <div class="container-float">
        @include('livewire.admin.includes.head_button',['button'=>'wire:click=createDataItem','lang'=>'admin.Reviews create'])
    </div>
    <div class="container">
        @include('livewire.admin.includes.search')
    </div>
    <div class="container-float">
    @switch($swith_show)
        @case('show')
            @include('livewire.admin.review.includes.show-item',['action_type'=>'showData'])
            @break
        @case('create')
            @include('livewire.admin.review.includes.add-edit',['action_type'=>'createData'])
            @break
        @case('edit')
            @include('livewire.admin.review.includes.add-edit',['action_type'=>'updateData','item_id'=>''])
            @break
        @default

    @endswitch

    </div>
</div>
