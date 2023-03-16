<div class="lk-page__table">
        <table class="ftable" id="dererreds-list" data-paging-size="2" data-paging-container="#table-nav-2" style="width: 100%">
            <thead>

            <tr class="footable-header">
                <th>
                    <div class="d-flex align-items-center">
                        <label class="check js-select-all"></label>
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
                        <label class="check"></label>

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
                {{-- Block for determining the type and type of prices in accordance with the type of user.--}}
                @php($productPriceField = App\Models\Product:: getPriceFieldWithParams(null, $product->price_sale,  $product->price_wholesale,$product->price_sale_show))
                <td>
                    <span class="big">  {!! formatNbsp(formatMoney($product->$productPriceField) . ' ₴') !!}</span>
                    @if ($product->price_sale_show != 0 and $product->price_wholesale == 0 or $product->price_sale_show == 0 and $product->price_wholesale != 0 or $product->price_sale_show != 0 and $product->price_wholesale != 0)
                        <span>
                                <?php $user = $user ?? auth()->user(); ?>
                                @if (is_object($user) && $user->is_founder != 0)
                                    <span style="color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </span>
                                    @else
                                    <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>
                                @endif
                        </span>
                    @elseif($product->price_wholesale == 0 and $product->price_sale_show == 0 )
                        <span style="color: grey; font-size: 17px;"></span>
                    @endif
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
                {{-- Block for determining the type and type of prices in accordance with the type of user.--}}
                @php($productPriceField = App\Models\Product:: getPriceFieldWithParams(null, $product->price_sale,  $product->price_wholesale,$product->price_sale_show))
                <td>
                    <span class="big">  {!! formatNbsp(formatMoney($product->$productPriceField * $product->quantity) . ' ₴') !!}</span>
                    @if ($product->price_wholesale != 0 and $product->price_sale_show == 0 or $product->price_sale != 0 and $product->price_sale_show != 0)
                        <span>
                            <?php $user = $user ?? auth()->user(); ?>
                            @if ($user->is_founder != 0)
                                <span style="color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc * $product->quantity) . ' ₴') !!} </span>
                            @else
                                <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc * $product->quantity) . ' ₴') !!} </s>
                            @endif
                        </span>
                    @elseif($product->price_wholesale == 0 and $product->price_sale_show == 0 )
                        <span style="color: grey; font-size: 17px;"></span>
                    @endif

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
    <div class="lk-page__table-after">
        <div></div>
        <div>
            @include('livewire.includes.per-page-table-duble', ['data_paginate' => $deferredsProducts])
        </div>
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
