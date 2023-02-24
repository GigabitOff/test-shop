<div class="container-large">
@include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.pages.index'])
<h4>
    @if(isset($data[session('lang')]['title'])){{$data[session('lang')]['title']}}@else{{ __('custom::admin.Main')}}@endif
    </h4>
<div wire:ignore wire:key="lang_key">
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
        <button class="nav-link @if(isset($collapse_show) AND $collapse_show==='seo-data')active @endif"  type="button" role="tab"  onclick="@this.selectTab('seo-data')" >
            @lang('custom::admin.SEO data')
        </button>
    </li>
</ul>
<div class="product-info tab-content mt-4">
    <div class="tab-pane fade @if(isset($collapse_show) AND $collapse_show==='all-info')show active @endif" id="all-info" role="tabpanel">
    <div class="container-medium">
        @include('livewire.admin.pages.main.includes.tablist.general-tab')
    </div>
    </div>
    
    <div class="tab-pane fade @if(isset($collapse_show)  AND $collapse_show==='seo-data')show active @endif" id="seo-data" role="tabpanel"  >
        @include('livewire.admin.pages.main.includes.tablist.seo-data')
    </div>

</div>

    <div class="page-save text-end text-xl-start">
        @include('livewire.admin.includes.save-data-include',['wire_click'=>'saveData','on_click_many'=>["emit('saveDataMenuCategory')", "emit('saveDataBannerSingle')", "emit('saveSettingSingle')"],'title_button'=>__('custom::admin.Save')])

       {{-- <button class="button" onclick="@this.emit('saveData',['saveSettingSingle']);" type="button">@lang('custom::admin.Save changes')</button>--}}
    </div>
</div>


