
<div>
    @include('livewire.includes.dropdown-server-filterable', [
'name' => 'filterableCity',
'model' => $filterableCity,
'mode' => $filterableMode,
'class' => 'custome-dropdown--arrow --empty',
'placeholder' => __('custom::site.choice_city'),
])
    @error('data.city_id')
    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
    @enderror
<p>
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
</p>
</div>
