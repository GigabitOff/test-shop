<div class="form-group">
    <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.products.price_rrp'), @lang('custom::admin.products.UAH')</span>
        </div>
        <input type="text"
               class="form-control @error('data.price_rrc') is-invalid @enderror"
               onclick="this.select();"
               placeholder="@lang('custom::admin.products.price_rrp')"
               wire:model.lazy="data.price_rrc" >
    </div>
    @error('data.price_rrc')
        <div class="is-invalid d-block">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.products.price_wholesale'), @lang('custom::admin.products.UAH')</span>
        </div>
        <input type="text"
               class="form-control @error('data.price_wholesale') is-invalid @enderror"
               onclick="this.select();"
               placeholder="@lang('custom::admin.products.price_wholesale')"
               wire:model.lazy="data.price_wholesale">
    </div>
    @error('data.price_wholesale')
        <div class="is-invalid d-block">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.products.Purchase price'), @lang('custom::admin.products.UAH')</span>
        </div>
        <input type="text"
               class="form-control @error('data.price_purchase') is-invalid @enderror"
               onclick="this.select();"
               placeholder="@lang('custom::admin.products.Purchase price')"
               wire:model.lazy="data.price_purchase">
    </div>
    @error('data.price_purchase')
        <div class="is-invalid d-block">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.products.price_margin'), %;
                @lang('custom::admin.products.price_min'), @lang('custom::admin.products.UAH')</span>
        </div>
        <input type="number" class="form-control"
               onclick="this.select();"
               placeholder="@lang('custom::admin.products.price_margin')"
               wire:model.lazy="data.price_min_margin">
        <input class="form-control" type="text"
               disabled
               value="{{$data['price_min_margin_value']}} @lang('custom::admin.products.UAH')">
    </div>
</div>

<div class="form-group">
    <x-admin.check-labeled
        :caption="__('custom::admin.products.price_sale')"
        wire:model="data.price_sale_show" />
</div>
<div class="form-group @if(!$data['price_sale_show']) d-none @endif">
    <div class="input-group">
        <span class="input-group-text">@lang('custom::admin.products.price_sale')</span>
        <input type="number" class="form-control @error('data.price_sale') is-invalid @enderror"
               placeholder="@lang('custom::admin.products.price_sale')"
               wire:model.lazy="data.price_sale">
    </div>
    @error('data.price_sale')
    <div class="is-invalid d-block">{{ $message }}</div>
    @enderror
</div>

