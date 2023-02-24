<div>
    <div class="lk-page__table">
        <table class="ftable" id="dererreds-list" data-paging-size="2" data-paging-container="#table-nav-2">
            <thead>
            <tr class="footable-header">
                <th>
                    <div class="d-flex align-items-center">
                        {{--<label class="check js-select-all">--}}
                            {{--<input class="check__input" onclick="Livewire.emit('eventCheckAllChangedCheckbox',--}}
                            {{--{{!$checkAll ? 'this.checked' : 0}})" @if($checkAll) checked @endif type="checkbox"/>--}}
                            {{--<span class="check__box"></span>--}}
                            {{--<span class="check__txt"></span>--}}
                        {{--</label>--}}
                            <span>@lang('custom::site.products')</span>
                    </div>
                </th>
                <th data-breakpoints="xs">@lang('custom::site.availability')</th>
                <th data-breakpoints="xs">@lang('custom::site.Price')</th>
                <th data-breakpoints="xs sm md">@lang('custom::site.Number')</th>
                <th data-breakpoints="xs sm md">@lang('custom::site.sum')</th>
                <th data-breakpoints="xs sm md" style="display: table-cell;"></th>
                <th data-breakpoints="xs sm md"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($deferredsProducts as $product)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        {{--<label class="check"><input class="check__input" @if($checkAll)--}}
                        {{--checked @endif type="checkbox"/>--}}
                            {{--<span class="check__box"></span>--}}
                            {{--<span class="check__txt"></span>--}}
                        {{--</label>--}}

                        <div class="table-product-card">
                            <div class="table-product-card__img">
                                @if($product->imagefullUrl)
                                    <img src="{{fallbackProductImageUrl($product->imagefullUrl)}}"
                                    alt="{{$product->name}}">
                                @elseif($product->images->isNotEmpty())
                                    @foreach($product->images as $key_image => $image)
                                        @if($key_image == 0 )
                                            <img src="{{\Storage::disk('public')->url($image->url)}}"
                                            alt="{{$product->name}}">
                                        @endif
                                    @endforeach
                                @else
                                    <img src="{{fallbackProductImageUrl('')}}" alt="">
                                @endif
                            </div>
                            <div class="table-product-card__desc">
                                <span class="table-product-card__art">№{{$product->articul}}</span>
                                <a class="table-product-card__title" href="{{route('products.show', $product->slug)}}">
                                {{$product->name}}</a>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="status {{$product->availabilityCss}}">
                        <span class="circle"></span>
                        <span>{{$product->availabilityText}}</span>
                    </div>
                </td>
                <td>
                    <span class="big">{!! formatNbsp(formatMoney($product->price_init - $cashbackUsed) . ' ' . __('custom::site.UAH')) !!}</span>
                    <span class="small">{!! formatNbsp(formatMoney($product->price_retail) . ' ' . __('custom::site.UAH')) !!}</span>
                </td>
                <td class="text-center">
                    <div class="counter">
                        <div class="counter__btn minus"></div>
                        <div class="counter__field">
                            <input type="number" value="{{$product->quantity}}" min="1"
                            onchange="document.deferredsProduct.setChangeQuantity(this, '{{$product->id}}')"/>
                        </div>
                        <div class="counter__btn plus"></div>
                    </div>
                </td>
                <td>
                    <span class="big">{!! formatNbsp(formatMoney($product->cartCost - $cashbackUsed) . ' ' . __('custom::site.UAH')) !!}</span>
                    <span class="small">{!! formatNbsp(formatMoney($product->quantity * $product->price_retail) . ' ' . __('custom::site.UAH')) !!}</span>
                </td>
                <td class="w-1 text-xl-end">
                    <button class="button-accent button-xsmall nowrap" type="button"
                        onclick="Livewire.emit('eventAddBusket', {{$product->id}},
                        {{$product->quantity}})">@lang('custom::site.add to busket')
                    </button>
                </td>
                <td class="text-end footable-last-visible">
                    <button class="button-delete ico_trash"
                        onclick="Livewire.emit('eventDeleteGoods',
                        {{$product->id}})" type="button">
                    </button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="lk-page__table-after">
        <div></div>
        @include('livewire.includes.per-page-table', ['data_paginate' => $deferredsProducts])
    </div>
</div>
@push('custom-scripts')
<script>

    window.addEventListener('refreshDerredsGoodsList', (event) => {
        $('#dererreds-list').footable();
    });

    document.deferredsProduct = {
        setChangeQuantity: function (input, productId) {
            const $input = $(input);
            const max = $input.attr('data-max');
            const value = $input.val();

            if (max !== undefined && value > max) {
                $input.val(max);
            }

            @this.changeQuantity(productId, value);
        }
    }

    //# sourceURL=customer.documents.index-page-main-livewire.js
</script>
@endpush