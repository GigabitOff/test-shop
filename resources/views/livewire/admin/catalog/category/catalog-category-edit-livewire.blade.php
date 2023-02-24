<div>
    {{-- Catalog Category Edit Livewire. --}}
    <div class="container-large">
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])
    <h4>@lang('custom::admin.Category') / {{ isset($data[session('lang')]['name']) ? $data[session('lang')]['name'] : ''}}</h4>

    <div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
    <ul class="nav nav-tabs" role="tablist">

        <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($collapse_show)  AND $collapse_show==='all-info')active @endif" type="button" role="tab"  onclick="@this.selectTab('all-info')">
            <span @if($error_data_title) style=" color: red;" @endif>
            @lang('custom::admin.General information')
            </span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($collapse_show) AND $collapse_show==='page-data')active @endif"  type="button" role="tab"  onclick="@this.selectTab('page-data')" >
            @lang('custom::admin.SEO data')
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($collapse_show) AND $collapse_show==='characteristics')active @endif"  type="button" role="tab"  onclick="@this.selectTab('characteristics')" >
            @lang('custom::admin.characteristics')
        </button>
    </li>
    </ul>
    <div class="product-info tab-content mt-4">
        <div class="tab-pane fade @if(isset($collapse_show) AND $collapse_show==='all-info')show active @endif" @if(isset($collapse_show)  AND $collapse_show!=='all-info') style="display:none" @endif id="all-info" role="tabpanel">
        <div >

            @include('livewire.admin.catalog.category.includes.add-edit-single',['hide_seo'=>true])
        </div>
        </div>
        <div  class="tab-pane fade @if(isset($collapse_show)  AND $collapse_show==='page-data')show active @endif" @if(isset($collapse_show)  AND $collapse_show!=='page-data') style="display:none" @endif id="page-data" role="tabpanel"  >
            @include('livewire.admin.includes.meta-data', ['lang'=>session('lang')])
        </div>
        <div  class="tab-pane fade @if(isset($collapse_show)  AND $collapse_show==='characteristics')show active @endif" @if(isset($collapse_show)  AND $collapse_show!=='characteristics') style="display:none" @endif id="page-data" role="tabpanel"  >
            @include('livewire.admin.catalog.category.includes.tablist.characteristics-tab')
        </div>
    </div>


    <div class="mt-4">

        @error('data.'.session('lang').'.name')

                @php($error_data = true)
                @enderror
         @include('livewire.admin.includes.save-data-include',[
            'wire_click'=>"saveData",
            'title_button'=>__('custom::admin.Save'),
            'include_button_status' => true,
            ])


</div>
    </div>

</div>
