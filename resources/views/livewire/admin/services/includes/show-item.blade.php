<ul class="nav nav-tabs" role="tablist">

    @foreach($tabs as $key => $tab)
        <x-admin.tab-label
            :key="$key"
            :active="$tab['active']"
        >
            <span class="@if($tab['error']) text-danger @endif">
                @lang("custom::admin.tabs.{$key}")
            </span>

        </x-admin.tab-label>
    @endforeach

</ul>

<div class="product-info tab-content mt-4">
    @foreach($tabs as $key => $tab)
        <x-admin.tab-container
            :key="$key"
            :active="$tab['active']"
        >
            @include("livewire.admin.services.includes.tabs.{$tab['target']}-tab")
        </x-admin.tab-container>
    @endforeach


</div>
<div class="mt-3">
@include('livewire.admin.includes.save-data-include',['wire_click'=>"saveData",'title_button'=>__('custom::admin.Save')])
</div>
