<div>
    <div class="form-group">
        @include('livewire.includes.dropdown-front-filterable', [
            'name' => 'filterableContract',
            'model' => $filterableContract,
            'placeholder' => __('custom::site.choice_contract'),
        ])
        @error('filterableContract.id')
        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
        @enderror
    </div>
</div>
