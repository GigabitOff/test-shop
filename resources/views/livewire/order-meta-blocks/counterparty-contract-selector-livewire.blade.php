<div>
    <div class="form-group">
        @include('livewire.includes.dropdown-front-filterable', [
            'name' => 'filterableCounterparty',
            'model' => $filterableCounterparty,
            'autocomplete' => 'off',
            'placeholder' => __('custom::site.choice_of_counterparty'),
        ])
        @error('filterableCounterparty.id')
        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group">
        @include('livewire.includes.dropdown-front-filterable', [
            'name' => 'filterableContract',
            'model' => $filterableContract,
            'autocomplete' => 'off',
            'placeholder' => __('custom::site.choice_contract'),
        ])
        @error('filterableContract.id')
        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
        @enderror
    </div>
</div>

@push('custom-scripts')
    <script>
        document.addEventListener('clearContractSelector', function(){

        })
    </script>
@endpush
