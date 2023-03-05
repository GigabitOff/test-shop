<div>

<div class="form-group">
    <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.services_price.price_sale_sum'), @lang('custom::admin.products.UAH')</span>
        </div>
        <input disabled type="number"
               class="form-control @error('data.price_retail') is-invalid @enderror"
               onclick="this.select();"
               placeholder="@lang('custom::admin.services_price.price_sale_sum')"
               wire:model.lazy="data.price_sale_sum" >
    </div>
    @error('data.price_sale_sum')
        <div class="is-invalid d-block">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.services_price.price'), @lang('custom::admin.products.UAH')</span>
        </div>
        <input type="number"
               class="form-control @error('data.price') is-invalid @enderror"
               onclick="this.select();"
               placeholder="@lang('custom::admin.services_price.price')"
               wire:model.lazy="data.price">
    </div>
    @error('data.price')
        <div class="is-invalid d-block">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.services_price.price_products_sum'), @lang('custom::admin.products.UAH')</span>
        </div>
        <input disabled type="number"
               class="form-control @error('data.price_products_sum') is-invalid @enderror"
               onclick="this.select();"
               placeholder="@lang('custom::admin.services_price.price_products_sum')"
               wire:model.lazy="data.price_products_sum">
    </div>
    @error('data.price_products_sum')
        <div class="is-invalid d-block">{{ $message }}</div>
    @enderror
</div>


<div class="form-group">
    <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.services_price.profit'), %;
                @lang('custom::admin.services_price.price_profit_sum'), @lang('custom::admin.products.UAH')</span>
        </div>
        <input type="number" class="form-control"
               onclick="this.select();"
               placeholder="@lang('custom::admin.services_price.profit')"
               wire:model.lazy="data.profit">
        <input class="form-control" type="text"
               disabled
               value="{{isset($data['price_profit_sum']) ? $data['price_profit_sum'] : ''}} @lang('custom::admin.products.UAH')">
    </div>
</div>

</div>
