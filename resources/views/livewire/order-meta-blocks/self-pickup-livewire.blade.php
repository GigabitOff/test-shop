<div>
    @include('livewire.includes.dropdown-server-filterable', [
        'name' => 'filterableWarehouse',
        'model' => $filterableWarehouse,
        'mode' => $filterableMode,
        'autocomplete' => 'off',
        'class' => 'custome-dropdown--arrow --empty',
        'placeholder' => __('custom::site.select_storage'),
    ])

    @error('data.warehouse_id')
    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
    @enderror

</div>
