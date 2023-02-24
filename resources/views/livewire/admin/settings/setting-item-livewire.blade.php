<div>
    {{-- Livewire Settings Item includes. --}}
<div class="container-float">
        @include('livewire.admin.includes.head_button',['button'=>'wire:click=createSetting','lang'=>'admin.Settings create'])
    </div>

    <div class="container-float">
    @switch($swith_show)
        @case('show')
            @include('livewire.admin.settings.includes.show-item',['action_type'=>'showData'])
            @break
        @case('create')
            @livewire('admin.settings.setting-create-livewire',['page_id'=>$page_id,'prefix_key' => $slug_item.'_'])
            @break
        @case('edit')
            @include('livewire.admin.settings.includes.add-edit',['action_type'=>'updateData','item_id'=>''])
            @break
        @default

    @endswitch

    </div>
</div>
