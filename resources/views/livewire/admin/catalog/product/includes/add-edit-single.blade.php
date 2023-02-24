<div wire:ignore>
    @livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
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
            @include("livewire.admin.catalog.product.includes.tablist.{$tab['target']}-tab")
        </x-admin.tab-container>
    @endforeach


    <div class="mt-4">
            @if(isset($error_show))
                <script>
                    @this.emit('showAlert', 'error', '{!! str_replace("&#039;","\'",$error_show) !!}');
                </script>
            @endif

            @if(isset($item_id))
                {{--<button class="button" wire:click="saveData()" type="button">@lang('custom::admin.Save changes')</button>--}}
                @include('livewire.admin.includes.save-data-include',[
                    'wire_click'=>'saveData',
                    'title_button'=>__('custom::admin.Save'),
                    'include_button_status' => true,
                    'include_button_delete' => true,
                    ])
            @else
                {{--<button class="button" wire:click="saveData()" type="button">@lang('custom::admin.Add product')</button>--}}
                @include('livewire.admin.includes.save-data-include',[
                    'wire_click'=>'saveData',
                    'title_button'=>__('custom::admin.Add product'),
                    'include_button_status' => true,
                    ])

            @endif
    </div>
</div>
