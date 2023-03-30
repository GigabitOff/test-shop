<div class="dropify-group">
    <div>
        <h6>@lang('custom::admin.Catalog')</h6>
        <div class="--square">
            @include('livewire.admin.includes.add-file-data',['index'=>'catalog_footer','type'=>'file','lang_img'=>session('lang')])
        </div>
    </div>
    {{--<div>
        <h6>@lang('custom::admin.catalog_barcode_footer')</h6>
        <div class="--square">
            @include('livewire.admin.includes.add-file-data',['index'=>'catalog_footer_barcode','type'=>'file','lang_img'=>session('lang')])
        </div>
    </div>--}}
</div>
