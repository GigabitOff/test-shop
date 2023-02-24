<div>
    <div class="container-large">
        @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.pages.index'])
        <h4>@if(isset($data[session('lang')]['title'])){{$data[session('lang')]['title']}}@else{{ __('custom::admin.Reviews')}}@endif</h4>
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
            <span @if($error_data_title) style=" color: red;" @endif>
            @lang('custom::admin.Page data')
            </span>
        </button>
    </li>
    
        </ul>
        <div class="product-info tab-content mt-4">
            <div class="tab-pane fade @if(isset($collapse_show) AND $collapse_show==='all-info')show active @endif" id="all-info" role="tabpanel">
            <div >
                @include('livewire.admin.review.includes.tablist.general-tab')
            </div>
            </div>

            <div  class="tab-pane fade @if(isset($collapse_show)  AND $collapse_show==='page-data')show active @endif" id="page-data" role="tabpanel" >
            @include('livewire.admin.review.includes.tablist.page-data')
        </div>
        <div class="tab-pane fade @if(isset($collapse_show)  AND $collapse_show==='seo-data')show active @endif" id="seo-data" role="tabpanel"  >
        @include('livewire.admin.review.includes.tablist.seo-data')
    </div>
        </div>


    </div>

    <div class="modal fade" id="m-edit-review" tabindex="-1" aria-hidden="true" wire:ignore>
            <div class="modal-dialog modal-dialog-centered">
            @livewire('admin.review.review-edit-livewire', key(time().'review-edit'))
            </div>
        </div>
</div>
