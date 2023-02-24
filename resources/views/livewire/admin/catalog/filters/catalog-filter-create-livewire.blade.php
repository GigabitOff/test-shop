<div>
    {{-- Catalog Filter Create Livewire. --}}
    <div class="container-large">
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])
   <script>
            setTimeout(() => {
            @this.saveData();

            }, 500);
        </script>
    {{--<h4>@lang('custom::admin.Filters') / {{ isset($data[session('lang')]['name']) ? $data[session('lang')]['name'] : ''}}</h4>
    @include('livewire.admin.catalog.filters.includes.add-edit-single')--}}
    </div>
</div>
