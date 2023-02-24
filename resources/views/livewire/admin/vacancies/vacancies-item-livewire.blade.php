<div>
    {{-- Livewire Item show --}}

    @switch($swith_show)
        @case('show')
        {{--<div class="container">
            @include('livewire.admin.includes.search')
        </div>--}}
            @include('livewire.admin.vacancies.includes.show-item',['action_type'=>'showData'])
            @break
        @case('create')
            @include('livewire.admin.vacancies.includes.add-edit-single',['action_type'=>'createData'])
            @break
        @case('edit')
            @include('livewire.admin.vacancies.includes.add-edit-single',['action_type'=>'updateData','item_id'=>''])
            @break
        @default
    @endswitch
</div>
