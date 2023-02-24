<div class="container-large">

    @include('livewire.admin.includes.head_button',[
        'type'=>'return',
        'route'=>'admin.pages.index',
        'title_lang'=>__('custom::admin.Return to list page')
    ])

    <h4>@lang('custom::admin.upload_products')</h4>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link @if(isset($collapse_show)  AND $collapse_show==='all-info')active @endif"
                    type="button" role="tab" onclick="@this.selectTab('all-info')">
            <span @if($error_data_title) style=" color: red;" @endif>
            @lang('custom::admin.General information')
            </span>
            </button>
        </li>

    </ul>

    <div class="product-info tab-content mt-4">
        <div class="tab-pane fade @if(isset($collapse_show) AND $collapse_show==='all-info')show active @endif"
             id="all-info" role="tabpanel">
            <div class="container-large">
                @include('livewire.admin.catalog.product-import.includes.tablist.general-tab')
            </div>
        </div>
    </div>

</div>
