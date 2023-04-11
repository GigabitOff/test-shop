@php
use App\Http\Livewire\Components\ProductPriceTracker;

/** @var \App\Models\Product $product */
$followPrice = formatMoney($price);
@endphp
<div class="product-full-box --info">
    <div class="product-full__labels">
        <span class="product-full-label {{$product->availabilityCss}}">
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
                    {{--  Block for determining the type and type of prices in accordance with the type of user.--}}
                    <div>
                        <span>@lang('custom::site.price product')</span>
                        <strong>{!! formatNbsp(formatMoney($price) . ' ₴') !!}</strong>
                        @if ($product->price_sale_show != 0 and $product->price_wholesale == 0 or $product->price_sale_show == 0 and $product->price_wholesale != 0 or $product->price_sale_show != 0 and $product->price_wholesale != 0)
                        <span class="product__sub-price">
                            <?php $user = $user ?? auth()->user(); ?>
                            @if (is_object($user) && $user->is_founder != 0)
                                @if ($product->price_sale_show == 0 and $product->price_wholesale != 0)
                                    <s style="text-decoration: none; color: #9FA4B0; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>
                                @else
                                    <s style="text-decoration: line-through; color: #6c757d; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>
                                @endif
                            @else
                                @if (!is_object($user) and $product->price_sale_show != 0 and $product->price_sale != 0)
                                    <s style="text-decoration: line-through; color: #6c757d; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>
                                @else
                                    <s style="text-decoration: line-through; color: #6c757d; font-size: 17px;"></s>
                                @endif
                                @if (is_object($user) and $product->price_sale_show != 0)
                                    <s style="text-decoration: line-through; color: #6c757d; font-size: 17px;"> {!! formatNbsp(formatMoney($product->price_rrc) . ' ₴') !!} </s>
                                @endif
                            @endif
                            @elseif($product->price_wholesale == 0 and $product->price_sale_show == 0 )
                                <s style="color: grey; font-size: 17px;"></s>
                        @endif
                    </div>
                    <div>
                        <a href="#m-question2" data-bs-toggle="modal">@lang('custom::site.ask_a_question')?</a>
                        @if($product->showPriceTracking)
                        <livewire:components.product-price-tracker :product_id="$product->id" :price="$followPrice" />
                        @endif
                    </div>
                </div>
                <div class="product-full__btns-group">
                    <div class="product-full__counter @if(!$product->can_be_sold) d-none @endif">
                        <div class="counter">
                            <div class="counter__btn minus"></div>
                            <div class="counter__field">
                                <input class="input-col js-numeric" type="number" name="quantity"
                                       wire:model.defer="quantity"
                                       onchange="@this.set('quantity', this.value)"
                                       min="{{$product->multiplicity}}"
                                       step="{{$product->multiplicity}}"
                                       @if($product->maxStock)
                                           max="{{$product->maxStock}}"
                                       @endif
                                       />
                            </div>
                            <div class="counter__btn plus"></div>
                        </div>
                        <span>@lang('custom::site.The multiplicity of the sale of goods') {{$product->multiplicity}}</span>
                    </div>
                    <div class="product-full__bay">
                        @if($product->can_be_sold)
                                <?php
                                $price = $product->price ?? 0; // if $product->price is null or undefined, set $price to 0
                                ?>
                            <button class="button-accent" type="button"
                                    onclick="Livewire.emit('eventCartAddProduct', {'product_id' : {{$product->id}}, 'show_notification':1, 'price_added': {{$price}}, 'quantity': $(this).closest('.product-full__btns-group').find('.counter input').get(0).value})"
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
                    @guest
                    <button class="button-outline" href="#m-quick-purchase"
                       data-bs-toggle="modal">@lang('custom::site.quick_purchase')</button>
                    @endguest
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

    <div wire:ignore>
        <div class="modal fade" id="m-question2">
        <div class="modal-dialog modal-dialog-centered">

          @livewire('forms.products.forms-products-ask-question-livewire', ['product_data' => $product], key(time().'-'.$product->id))
        </div>
      </div>

    </div>
</div>
@push('custom-scripts')
    <script>
        var delayedAction = {{$action}};
        var login = 0;
        let isEmptyEmail = {!! empty(auth()->user()->email) ? 1 : 0 !!};
        Livewire.on('successUnsubscribedPrice', () => {
            $('#m-price-unsubscribe').modal('show');
            $('#followPriceLink').show();
        });
        Livewire.on('loginBeforeSubscribeToFollowPrice', () => {
            document.cookie = "login=0;path=/";
            $('#m-login').modal('show')
        });
        Livewire.on('showEmailForm', () => $('#m-email').modal('show'));
        Livewire.on('successToFollowPrice', (login) => {
            this.login = login;
            delayedAction = {{ProductPriceTracker::ACTION_NOTHING}};
            $('#m-price2').modal('show');
            $('#followPriceLink').remove();
        });
        Livewire.on('successUnsubscribedPrice', () => $('#m-price-unsubscribe').modal('show'));
        $('#m-login').on('hidden.bs.modal', function () {
            delayedAction = {{ProductPriceTracker::ACTION_NOTHING}};
            Livewire.emit('userIsFailedLoggedIn');
        });
        $('#m-email').on('hidden.bs.modal', function () {
            delayedAction = {{ProductPriceTracker::ACTION_NOTHING}};
            Livewire.emit('userIsFailedLoggedIn');
        });
        $('#m-dialog-message').on('hidden.bs.modal', function () {
            delayedAction = {{ProductPriceTracker::ACTION_NOTHING}};
            if (window.parent.location.href.match(/add-to-cart=/)){
                if (typeof (history.pushState) != "undefined") {
                    var obj = { Title: document.title, Url: window.parent.location.pathname };
                    history.pushState(obj, obj.Title, obj.Url);
                } else {
                    window.parent.location = window.parent.location.pathname;
                }
            }
            // just to clean session
            Livewire.emit('userIsFailedLoggedIn');
        });
        $('#m-price2').on('hidden.bs.modal', function () {
            delayedAction = {{ProductPriceTracker::ACTION_NOTHING}};
            // just to clean session too
            Livewire.emit('userIsFailedLoggedIn');
            if (login) {
                location.reload();
                document.cookie = "login=; Max-Age=0; path=/";
            }
        });
        jQuery(document).ready(function ($) {
            if ( delayedAction === {{ProductPriceTracker::ACTION_ADD_TO_CART}}) {
                delayedAction = {{ProductPriceTracker::ACTION_NOTHING}};
                Livewire.emit('eventCartAddProduct', {'product_id' : {{$product->id}}, 'show_notification':1, 'price_added': {{$price}}, 'quantity': 1 });
            } else if ( delayedAction === {{ProductPriceTracker::ACTION_SHOW_UNSUBSCRIBED_MESSAGE}}) {
                delayedAction = {{ProductPriceTracker::ACTION_NOTHING}};
                $('#followPriceLink').show();
                $('#m-price-unsubscribe').modal('show');
            } else if ( delayedAction === {{ProductPriceTracker::ACTION_REGISTER_AND_ADD_TO_CART}}) {
                delayedAction = {{ProductPriceTracker::ACTION_ADD_TO_CART}};
                $('#m-login').modal('show');
            } else if ( delayedAction === {{ProductPriceTracker::ACTION_REGISTER_AND_UNSUBSCRIBE}}) {
                delayedAction = {{ProductPriceTracker::ACTION_SHOW_UNSUBSCRIBED_MESSAGE}};
                $('#m-login').modal('show');
            } else if ( delayedAction === {{ProductPriceTracker::ACTION_REGISTER_AND_SUBSCRIBE}}) {
                delayedAction = {{ProductPriceTracker::ACTION_NOTHING}};
                if (isEmptyEmail===1) {
                    $('#m-email').modal('show');
                } else {
                    $('#m-price2').modal('show');
                    $('#followPriceLink').remove();
                }
            }
        });
    </script>
@endpush

@push('custom-scripts')
    <script>
        var delayedAction = {{$action}};
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

