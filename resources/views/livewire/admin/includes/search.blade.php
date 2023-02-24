<div class="row mt-2 mb-2">
    {{--<label for="search{{$lang}}" class="col-lg-2 d-none d-sm-block" style="padding-top:7px; ">
        @lang('custom::admin.Search')
    </label>--}}
    <input type="text" class="form-control col-lg-11 float-right" id="search{{$lang}}" placeholder="@lang('custom::admin.Search')" wire:model.debounce.700ms="search">
</div>
