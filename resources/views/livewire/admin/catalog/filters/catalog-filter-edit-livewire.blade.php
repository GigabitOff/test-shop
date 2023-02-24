<div>
    {{-- Catalog Filter Edit Livewire. --}}
    <div class="container-large">
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])
    <h4>@lang('custom::admin.Filters') / {{ isset($data['name']) ? $data['name'] : ''}}</h4>
        @include('livewire.admin.catalog.filters.includes.add-edit-single')
    </div>
</div>
