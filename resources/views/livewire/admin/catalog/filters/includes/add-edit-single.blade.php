<div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>

<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($collapse_show)  AND $collapse_show === 'all-info') active @endif" data-bs-toggle="tab"  data-bs-target="#all-info" type="button" role="tab"  onclick="@this.selectTab('all-info')">
            <span @if($error_data_title) style=" color: red;" @endif>
            @lang('custom::admin.General information')
            </span>
        </button>
    </li>
       @if(isset($data['category_id']) AND $data['category_id'] !=0)

    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($collapse_show) AND $collapse_show === 'filter-categories') active @endif" data-bs-toggle="tab"  data-bs-target="#filter-categories" type="button" role="tab" onclick="@this.selectTab('filter-categories')">
            @lang('custom::admin.Filter categories')
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($collapse_show) AND $collapse_show === 'base-attribute') active @endif" data-bs-toggle="tab"  data-bs-target="#base-attribute" type="button" role="tab" onclick="@this.selectTab('base-attribute')">
            @lang('custom::admin.Base attributes')
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($collapse_show) AND $collapse_show === 'additional-attributes') active @endif" data-bs-toggle="tab"  data-bs-target="#additional-attributes" type="button" role="tab" onclick="@this.selectTab('additional-attributes')">
            @lang('custom::admin.Additional Attributes')
        </button>
    </li>
    @endif
</ul>
<div class="tab-content mt-4">
    <div class="tab-pane fade @if(isset($collapse_show) AND $collapse_show === 'all-info')show active @endif" @if(isset($collapse_show)  AND $collapse_show != 'all-info') style="display: none" @endif id="all-info" role="tabpanel">
       <div>
         @include('livewire.admin.catalog.filters.includes.tablist.general-tab')
       </div>
    </div>

    <div class="tab-pane fade @if(isset($collapse_show)  AND $collapse_show === 'filter-categories')show active @endif" @if(isset($collapse_show)  AND $collapse_show != 'filter-categories') style="display: none" @endif id="filter-categories" role="tabpanel">
        <div >
        @include('livewire.admin.catalog.filters.includes.tablist.filter-categories-tab')
        </div>


    </div>

    <div class="tab-pane fade @if(isset($collapse_show)  AND $collapse_show === 'base-attribute')show active @endif" @if(isset($collapse_show)  AND $collapse_show != 'base-attribute') style="display: none" @endif id="base-attribute" role="tabpanel" >
        @if(isset($item_id))
        <div wire:ignore wire:key="basic1">
         @livewire('admin.catalog.filters.catalog-filter-basic-attribute-livewire',['item_id' => $item_id,'dataItem'=>$dataItem], key(time().'-filter-attribute-basic-livewire'))
        </div>
        @endif


    </div>
    <div class="tab-pane fade @if(isset($collapse_show)  AND $collapse_show === 'additional-attributes')show active @endif" @if(isset($collapse_show)  AND $collapse_show != 'additional-attributes') style="display: none" @endif id="additional-attributes" role="tabpanel" >
        @if(isset($item_id))
        <div wire:ignore>
            @livewire('admin.catalog.filters.catalog-filter-attribute-livewire', ['item_id' => $item_id,'dataItem'=>$dataItem], key(time().'-filter-attribute-livewire'))
        </div>
        @endif

    </div>


    <div class="mt-4">
        @include('livewire.admin.includes.save-data-include',[
            'wire_click'=>'saveData',
            'title_button'=>isset($item_id) ? __('custom::admin.Save') : __('custom::admin.Add') ,
            'include_button_status' => true,
            ])
        {{--<button class="button button-change @if($data['status']==1)is-change @endif" type="button" onclick="@this.changeDataItem('status','{{$data['status']==1 ? 0 : 1}}')">@if($data['status']==0)<span class="on" >@lang('custom::admin.Show')</span>@else<span class="off">@lang('custom::admin.Hide')</span>@endif</button>--}}

       {{-- <button class="button" type="button" wire:click="saveData">@if(isset($item_id)){{__('custom::admin.Save')}}@else{{__('custom::admin.Add')}}@endif</button>--}}

    </div>


</div>


