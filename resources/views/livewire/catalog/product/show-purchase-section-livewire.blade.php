@php
    /** @var \App\Models\Product $product */
@endphp
<div class="product-full-box --info">
    <div class="product-full__labels">
        {{--        <span class="product-full-label {{$product->availabilityCss}}">--}}
        {{$product->availabilityText}}
        </span>
        @if($product->new)
            <span class="product-full-label new">
                <i class="ico_star"></i>
                @lang('custom::site.novel')
            </span>
        @endif
        @if($product->markdown)
            <span class="product-full-label sale">
                <i class="ico_discount"></i>
                @lang('custom::site.markdown')
            </span>
        @endif
    </div>
    <h1 class="product-full__title">{{$product->name}}</h1>
    <ul class="product-full__info">
        @if($product->articul)
            <li><span>@lang('custom::site.Article')</span>№&nbsp; <strong
                    class="copy-text">{{$product->articul}}</strong>
            </li>
        @endif
        @if($product->brand)
            <li><span>@lang('custom::site.Producer')</span>
                <a href="{{ route('brands.show', [$product->brand->slug])}}">
                    <strong>{{$product->brand->title}}</strong>
                </a>
            </li>
        @endif

        @if($product->colorVariations->isNotEmpty())
            <li>
                <span>@lang('custom::site.color')</span>
                <ul class="colors">
                    @foreach($product->colorVariations as $variation)
                        <li class="@if($product->is($variation)) pe-none @endif">
                            <a href="{{ route('products.show', [$variation->slug])}}">
                                <span style="background-color:{{$variation->color ?? ''}}"></span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
    </ul>
    <div class="product-full__info-btns">
        <div class="product-full__info-actions">
            <div class="product-full__info-actions-top">
                <div class="product-full__price">

                    @php( $productPriceField = App\Models\Product:: getPriceFieldWithParams(null, $product->price_sale,  $product->price_wholesale, $product->price_sale_show))
                    <div>

                        <span>@lang('custom::site.price product')</span>
                        <strong>{!! formatNbsp(formatMoney($product->$productPriceField) . ' ₴') !!}</strong>
                        @if ( $product->price_wholesale != 0 and $product->price_sale_show == 0 or $product->price_sale != 0 and $product->price_sale_show != 0)
                            <span>
                                @if (Auth::check())
                                    <?php $user = $user ?? auth()->user(); ?>
                                    @if ($user->is_customer_legal and $product->price_sale_show != 0)
                                        <span style="color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </span>
                                    @else
                                        <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>
                                    @endif
                                @else
                                    @if ($product->price_sale_show != 0)
                                    <s style="text-decoration: line-through; color: grey; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>

                                    @endif
                                @endif
                            </span>
                        @endif
                    </div>
                    <div>
                        <a href="#m-question2" data-bs-toggle="modal">@lang('custom::site.ask_a_question')?</a>
                        <a href="#m-price" data-bs-toggle="modal">@lang('custom::site.watch_price')</a>
                    </div>
                </div>
                <div class="product-full__btns-group">
                    <div class="product-full__counter @if(!$product->can_be_sold) d-none @endif">
                        <div class="counter">
                            <div class="counter__btn minus"></div>
                            <div class="counter__field">
                                <input class="input-col js-numeric" type="number"
                                       min="{{$product->multiplicity}}"
                                       @if($product->maxStock)
                                           max="{{$product->maxStock}}"
                                       @endif
                                       value="{{$product->multiplicity}}"/>
                            </div>
                            <div class="counter__btn plus"></div>
                        </div>
                        <span>@lang('custom::site.The multiplicity of the sale of goods') {{$product->multiplicity}}</span>
                    </div>
                    <div class="product-full__bay">
                        @if($product->can_be_sold)
                            <button class="button-accent" type="button"
                                    onclick="Livewire.emit('eventCartAddProduct', {'product_id' : {{$product->id}}, 'show_notification':1, 'price_added':  {{$product->price}}, 'quantity': $(this).closest('.product-full__btns-group').find('.counter input').get(0).value})"
                                    href="javascript:void(0);">
                                @lang('custom::site.Buy')
                            </button>
                        @else
                            @auth()
                                <button class="button-accent" type="button"
                                        onclick="Livewire.emit('eventAddFavouriteItem', {'product_id' : {{$product->id}}, 'show_notification':1})"
                                        href="javascript:void(0);">
                                    @lang('custom::site.add to waiting list')
                                </button>
                            @endauth
                            {{--                        /* hide for guest */ --}}
                            {{--                            @guest()--}}
                            {{--                                <span class="button-small">--}}
                            {{--                                @lang('custom::site.availability_absent')--}}
                            {{--                            </span>--}}
                            {{--                            @endguest()--}}
                        @endif
                    </div>
                </div>
            </div>
            <div class="product-full__info-actions-bottom">
                @if($product->can_be_sold)
                    <a class="button-outline" href="#m-quick-purchase"
                       data-bs-toggle="modal">@lang('custom::site.quick_purchase')</a>
                    @if($product->cut_out)
                        <a class="button-break" href="http://www.google.com" target="_blank">
                            <img src="/assets/img/button-break.svg"
                                 alt="button-break">@lang('custom::site.do_cut_pattern')
                        </a>
                    @endif
                @endif
            </div>
        </div>
        <div class="product-full__info-dependence" data-da=".--info-dependence, 1023">
            @foreach($selectorAttributes as $selectorAttribute)
                <div class="info-dependence__row">
                    <div class="info-dependence__label">{{$selectorAttribute['title']}}</div>
                    <div class="drop --arrow --select">
                        <spav class="drop-clear"></spav>
                        <input class="form-control drop-input drop-input-hide" type="text"
                               value="{{$selectorAttribute['value']}}"
                               autocomplete="off"/>
                        <button class="form-control drop-button" type="button">{{$selectorAttribute['value']}}</button>
                        <div class="drop-box">
                            <div class="drop-overflow">
                                <ul class="drop-list">
                                    @foreach($selectorAttribute['options'] as $option)
                                        <a href="{{ route('products.show', $option['slug'])}}">
                                            <li class="drop-list-item @if($option['disable']) opacity-50 @endif"
                                            >{{$option['value']}}</li>
                                        </a>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            $('body').on('click', '.btn-close, .button-accent.w-100', function (event) {
                var modal = $(this).closest('.modal-content'),
                    popupInput = modal.find('input'),
                    popupTextarea = modal.find('textarea')[0];
                if (popupTextarea) {
                    popupTextarea.value = '';
                }
                popupInput.each(function (input) {
                    popupInput[input].value = '';
                });
            });
        });

        //# sourceURL=show-purchase-section-livewire.js
    </script>
@endpush

