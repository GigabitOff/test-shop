<div  class="container-large">
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.actions.index'])
    <h4>@lang('custom::admin.Actions') / {{ isset($data[session('lang')]['title']) ? $data[session('lang')]['title'] : ''}}</h4>
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
    </ul>
    <div class="product-info tab-content mt-4">
        <div class="tab-pane fade @if(isset($collapse_show) AND $collapse_show==='all-info')show active @endif" id="all-info" role="tabpanel">
        <div wire:ignore.self>

            @include('livewire.admin.actions.includes.add-edit-single',['hide_seo'=>true])
        </div>
        </div>
        <div  class="tab-pane fade @if(isset($collapse_show)  AND $collapse_show==='page-data')show active @endif" id="page-data" role="tabpanel"  >
            @include('livewire.admin.includes.meta-data', ['lang'=>session('lang')])
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        @include('livewire.admin.includes.save-data-include',['wire_click'=>"saveData",'title_button'=>__('custom::admin.Save')])
</div>

</div>

