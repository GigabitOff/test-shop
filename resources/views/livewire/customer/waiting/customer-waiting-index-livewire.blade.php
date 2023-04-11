
<div class="lk-page__content">
<h1 class="lk-page__title">Лист очікування</h1>

<div class="lk-page__filters">
                <div class=" --search"><span class="drop-clear"></span>
                    <input class="form-control drop-input" type="text" wire:model="search" autocomplete="off" placeholder="Пошук">

                </div>
              </div>
<div class="lk-page__table">
        <table class="ftable" id="dererreds-list" data-empty="@lang('custom::site.data_is_absent')" style="width: 100%">
            <thead>
            <tr class="footable-header">
                <th>
                    <div class="d-flex align-items-center">
                        <label class="check">
                            <input class="check__input" type="checkbox"
                            @if(isset($selectedData['all'])) checked @endif  onclick="@this.selectDataItem('all',true)"><span class="check__box"></span><span class="check__txt"></span>
                        </label>
                            <span>@lang('custom::site.products')</span>
                    </div>
                </th>
                <th data-breakpoints="xs">@lang('custom::site.availability')</th>
                <th data-breakpoints="xs">@lang('custom::site.Price')</th>
                <th data-breakpoints="xs sm md">@lang('custom::site.Number')</th>
                <th data-breakpoints="xs sm md">@lang('custom::site.sum')</th>
                <th data-breakpoints="xs sm md" style="display: table-cell;"></th>
                <th data-breakpoints="xs sm md">
                    {{--<button class="button-delete ico_trash hide-mobile" type="button"></button>--}}
                </th>
            </tr>
            </thead>
            <tbody>
                @php
                    $price_sum_count = 0;
                    $price_sum = 0;
                    $count_sum = 0;
                @endphp
            @foreach($deferredsProducts as $product)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <label class="check">
                            <input class="check__input" type="checkbox"
                            @if(isset($selectedData[$product->id])) checked="checked" @endif onclick="@this.selectDataItem({{ $product->id }})">
                            <span class="check__box"></span><span class="check__txt"></span></label>
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
                                @if ($product->price_sale_show == 0 and $product->price_wholesale != 0)
                                    <span style="color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </span>
                                @else
                                    <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>
                                @endif
                            @else
                                @if (!is_object($user) and $product->price_sale_show != 0 and $product->price_sale != 0)
                                    <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>
                                @else
                                    <s style="text-decoration: line-through; color: grey; font-size: 17px;"></s>
                                @endif
                                @if (is_object($user) and $product->price_sale_show != 0)
                                    <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>
                                @endif
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
                            <input type="number" value="{{$product->quantity}}" min="0"
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
                            @if (is_object($user) && $user->is_founder != 0)
                                @if ($product->price_sale_show == 0 and $product->price_wholesale != 0)
                                    <span style="color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc * $product->quantity) . ' ₴') !!} </span>
                                @else
                                    <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc * $product->quantity) . ' ₴') !!} </s>
                                @endif
                            @else
                                @if (!is_object($user) and $product->price_sale_show != 0 and $product->price_sale != 0)
                                    <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc * $product->quantity) . ' ₴') !!} </s>
                                @else
                                    <s style="text-decoration: line-through; color: grey; font-size: 17px;"></s>
                                @endif
                                @if (is_object($user) and $product->price_sale_show != 0)
                                    <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc * $product->quantity) . ' ₴') !!} </s>
                                @endif
                            @endif
                        </span>
                    @elseif($product->price_wholesale == 0 and $product->price_sale_show == 0 )
                        <span style="color: grey; font-size: 17px;"></span>
                    @endif
                </td>
                <td class="w-1 text-xl-end">
                    <button class="button-accent button-xsmall nowrap" type="button"
                            onclick="@this.addBusket({{$product->id}},
                        {{$product->quantity}})">@lang('custom::site.add to busket')
                    </button>
                </td>
                <td class="text-end footable-last-visible">
                    <button class="button-delete ico_trash"
                            onclick="@this.deleteDeferredsGoods(
                        {{$product->id}})" type="button">
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="lk-page__table-after">
        <div>
            @if($this->price_count>0)

            <dl class="table-total">
                    <dt>@lang('custom::site.total_sum') ( {{ $this->price_count}} @lang('custom::site.products') )</dt>
                    <dd class="big">{!! formatNbsp(formatMoney($this->price_sum))!!} @lang('custom::site.UAH')</dd>
                    <dd>{!! formatNbsp(formatMoney($this->price_sum_count))!!} @lang('custom::site.UAH')</dd>
            </dl>
            <div class="lk-page__table-after-btns"><a class="button-accent" href="#!" onclick="@this.addSelectedBusket();">@lang('custom::site.add to busket')</a></div>
            @endif
        </div>
        <div>
            @include('livewire.includes.per-page-table-duble', ['data_paginate' => $deferredsProducts])
        </div>
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
