<div class="product-content__filter product-filter">
    <div class="product-filter__title">@lang('custom::site.IMPORTANT PARAMETER selected in the filter')</div>
    <div class="product-filter__table">
        <table class="js-table" data-show-toggle="true" data-toggle-column="last" wire:ignore>
            <thead>
            <tr>
                <th>@lang('custom::site.Name')<br> @lang('custom::site.Article tovr')</th>
                <th data-breakpoints="xs"><span>@lang('custom::site.Diameter')</span>
                    <input class="form-control" type="number"  name="diameter" value="0">
                </th>
                <th data-breakpoints="xs"><span>@lang('custom::site.Length')</span>
                    <input class="form-control" type="number" name="width" value="0">
                </th>
                <th>@lang('custom::site.Price')</th>
                <th>@lang('custom::site.Quantity, items')</th>
                <th data-breakpoints="xs sm">
                    @lang('custom::site.Status')
                </th>
                <th data-breakpoints="xs sm">
                    @lang('custom::site.In packing / piece')
                    <br> @lang('custom::site.Weight')
                </th>
                <th data-breakpoints="xs">@lang('custom::site.Price together')</th>
                <th data-breakpoints="xs"></th>
            </tr>
            </thead>
            <tbody>
            @if(isset($products) AND count($products)>0)
                @foreach ($products as $item)
                    @php
                        // Если товар принадлежит персональному предложению
                        $personalOffer = array_key_exists($item->id, $offers)
                            ? $offers[$item->id]
                            : null;
                    @endphp
                    <tr class="product-item product-{{$item->id}} @if($personalOffer) discont-active-tr @endif">
                        <td>
                            <div class="d-flex align-items-center position-relative">
                                @if($personalOffer)
                                    <div class="discont-tooltip">
                                        <div class="discont-tooltip__ico"><span class="ico_discount"></span></div>
                                        <div class="discont-tooltip__drop">
                                            <div class="discont-tooltip__title">@lang('custom::site.you_can_buy'):</div>
                                            @php($text = numericCasesLang($personalOffer['quantity'], 'custom::site.product'))
                                            <div class="discont-tooltip__desc text-lowercase">
                                                <strong>{{$personalOffer['quantity']}}</strong>
                                                {{$text}} @lang('custom::site.at_cost')
                                                <strong class="">{{$personalOffer['productPrice']}} @lang('custom::site.uah').</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="product-filter__table-img">
                                    @if(\Storage::disk('public')->exists($item->mainImage))

                                        <a href="{{\Storage::disk('public')->url($item->mainImage)}}"
                                           data-fancybox="single">
                                            <img class="mr-3"
                                                 src="{{\Storage::disk('public')->url($item->mainImage)}}"
                                                 alt="" width="37" height="28"/></a>
                                    @else

                                    @if($data->mainImage AND \Storage::disk('public')->exists($data->mainImage->url))
                                    <img class="mr-3" src="{{\Storage::disk('public')->url($data->mainImage->url)}}" alt="" width="37"
                                             height="28"/>
                                    @else
                                <img src="/assets/img/Foto.png" alt="{{ $data->name }}" />

                                    @endif
                                    @endif

                                </div>
                                <div><span class="product-filter__table-nane">{{ $item->name }}</span><span
                                        class="product-filter__table-article">№{{ $item->articul }}</span></div>
                            </div>
                        </td>
                        <td class="text-md-center"><span>{{ $item->depth}}</span></td>
                        <td class="text-md-center"><span>{{ $item->height}}</span></td>
                        <td><span class="product-filter__table-price" data-price="{{$item->price}}">{{formatMoney($item->price)}}</span></td>
                        <td>
                            <div class="jq-number input-col">
                                <div class="jq-number__spin minus"></div>
                                <div class="jq-number__field">
                                    <input class="input-col" type="number" value="1" min="1"
                                           onchange="
                                           const $tr = $(this).closest('.product-item');
                                           const price = $tr.find('.product-filter__table-price').attr('data-price');
                                           const cost = (price * this.value).toFixed(2);
                                            $tr.find('.button.add-to-cart').attr('data-qty', this.value);
                                            $tr.find('.product-filter__table-total-price').text(cost);
                                            "
                                           onclick="this.select();"/>
                                </div>
                                <div class="jq-number__spin plus"></div>
                            </div>
                        </td>
                        <td><span
                                class="product-filter__table-status in-stock">@lang('custom::site.availability.'.$item->availability)</span>
                        </td>
                        <td>{{--<span class="product-filter__table-col">{{ $item->quantity}}</span>--}}<span
                                class="product-filter__table-weight">{{$item->unit}} {{ $item->measure}}</span></td>
                        <td><span class="product-filter__table-total-price">{{formatMoney($item->price)}}</span></td>
                        <td>
                            <span class="product-filter__table-action">
                                @php($hasComparisons = comparisons()->isExistProduct($item->id))
                                <button
                                    class="button-action js-add-compare ico_compare @if($hasComparisons) is-active @endif"
                                    onclick="Livewire.emit('eventToggleComparisons', {'product_id':{{$item->id}}})"
                                    type="button"></button>
                                @php($hasFavorites = favourites()->isExistProduct($item->id))
                                <button
                                    class="button-action js-add-favorites ico_favorites @if($hasFavorites) is-active @endif"
                                    onclick="Livewire.emit('eventToggleFavourite', {'product_id':{{$item->id}}})"
                                    type="button"></button>
                                <button class="button button-secondary add-to-cart"
                                        data-qty="1"
                                        onclick="Livewire.emit('eventAddProductToCart',{{$item->id}}, $(this).attr('data-qty'))"
                                        type="button">
                                    <span class="ico_cart"></span>
                                    <span class="text">@lang('custom::site.To the basket')</span>
                                </button>
                            </span>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
