<div class="lk-page__content">
    <h1 class="lk-page__title">@lang('custom::site.cart')</h1>
@if($countChangedPrice)
    <div class="cart-info">
        <div class="cart-info__ico"><i class="ico_discount"></i></div>
        <div class="cart-info__box">
            <h6 class="cart-info__title">@lang('custom::site.message_in_cart')</h6>
            <p class="cart-info__subtitle">{{$countChangedPrice}} @lang('custom::site.products_changed_price')</p>
            <p class="cart-info__text-info">@lang('custom::site.message_price_cart')</p>
            <ul class="cart-info__list">
                @foreach ($productPriceUpdated as $productUpdated)
                <li>@lang('custom::site.product') <a href="{{route('products.show', $productUpdated['slug'])}}">
                    {{$productUpdated['name']}}</a>
                    @lang('custom::site.changed_cost_from')
                    <span>{{$productUpdated['oldPrice']}} @lang('custom::site.uah')</span>
                    @lang('custom::site.on')
                    <span>{{$productUpdated['price']}} @lang('custom::site.uah')</span></li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
    <div class="lk-page__action">
        <div class="lk-page__action-btns">
            <div class="button-outline ico_trash"
                @if($checkAll) onclick="@this.clearList()" @endif>
            </div>
        </div>
        <?php $user = $user ?? auth()->user(); ?>
        @if (is_object($user) && $user->is_founder != 0)
        <div class="lk-page__action-btns">
            <a class="button-circle ico_print" href="#m-print-cart-order"
            data-bs-toggle="modal">
            </a>
        </div>
        @endif
    </div>
    <div class="lk-page__table">
        <div id="footable-content" class="footable-content" style="display: none;" data-table="{{ $table }}"></div>
        <table wire:ignore id="footable-holder" class="ftable"
               data-empty="@lang('custom::site.data_is_absent')"
               data-show-toggle="true" data-toggle-column="last">
        </table>
    <div class="lk-page__table-after">
        <div></div>
        <div>
            @include('livewire.includes.per-page-table', ['data_paginate' => $products])
        </div>
    </div>
    </div>
    <h5>@lang('custom::site.deferred_goods')</h5>
    @livewire('customer.cart.deferreds-goods',['cashbackUsed' => $cashbackUsed])
    <div class="lk-page__table-after">
        <div class="ms-0">
            <label class="check fz12">
                <input class="check__input" wire:model="callback_off" type="checkbox"/>
                <span class="check__box"></span>
                <span class="check__txt">
                    @lang('custom::site.Don call me back, Im sure of the order')
                </span>
            </label>
        </div>
    </div>
    <div class="lk-page__table-total">
        <ul class="table-total --row">
            <li class="table-total__item">
                @lang('custom::site.total')
                ({{ cart()->totalCartCheckedQuantityCount()}}
                @lang('custom::site.products') )
                <span class="table-total__value">
                    <?php
                    $totalSum = 0;
                    foreach ($products as $product) {
                        $totalSum += $product->cartChecked ?
                            ($user->is_founder != 0 ? $product->cartQuantity * $product->cartCost : $product->cartCost) : 0;
                    }
                    ?>
                    {{$totalSum}}
                    @lang('custom::site.UAH')
                </span>
                <?php $user = $user ?? auth()->user(); ?>
                @if (is_object($user) && $user->is_founder != 0)
                <span class="table-total__value-sm">
                    {{formatMoney($sumPriceRetail - $cashbackUsed)}}
                    @lang('custom::site.UAH')
                </span>
                @endif
            </li>
            <li class="table-total__item">
                <div class="form-bonus">
                    <div class="form-bonus__input">
                        <input class="form-control" type="number" value="{{formatMoney( $cashbackUsed)}}">
                        <span class="form-bonus__input-curency">
                            @lang('custom::site.UAH')
                        </span>
                    </div>
                    <button class="form-bonus__btn">
                        @lang('custom::site.write off bonuses')
                    </button>
                </div>
            </li>
            <li class="table-total__item">
                <span class="table-total__label">
                    @lang('custom::site.final amount')
                </span>
                <span class="table-total__value">
                    {{$totalSum}}
                    @lang('custom::site.UAH')
                </span>
            </li>
        </ul>
        @php($totalWeight = cart()->products()->filter(fn($p) => $p->cartChecked)->map(fn($p) => $p->cartQuantity * $p->weight)->sum())
        <?php $checkedProducts = cart()->products()->filter(function ($product) {
            return $product->cartChecked;
        });
        $totalSize = 0;
        $hideSize = false;
        if ($checkedProducts->count() > 0) {
            foreach ($checkedProducts as $product) {
                if (!$product->depth || !$product->width || !$product->height) {
                    $hideSize = true;
                    break;
                }
                $totalSize += $product->depth * $product->width * $product->height / 1000000000;
            }
            $totalSize *= cart()->totalCartCheckedQuantity();
        }
        ?>
        <ul class="table-total-list">
            <li class="table-total-list__item">
              {{--  <div class="table-total-list__label">
                    @lang('custom::site.delivery date')
                </div>
                <div class="table-total-list__content">
                    <span>23.02.22</span>
                </div>--}}
            </li>
            @if(cart()->totalCartCheckedQuantityWeight() > 0 && $totalWeight > 0)
                <li class="table-total-list__item">
                    <div class="table-total-list__label">
                        @lang('custom::site.Weight')
                    </div>
                    <div class="table-total-list__content">
                        <span>{{formatMoney($totalWeight)}} @lang('custom::site.kg')</span>
                    </div>
                </li>
            @endif
            @if(cart()->totalCartCheckedQuantity() > 0 && $totalSize && !$hideSize)
                <li class="table-total-list__item">
                    <div class="table-total-list__label">
                        @lang('custom::site.Size')
                    </div>
                    <div class="table-total-list__content">
                        <span>{{number_format($totalSize, 5)}} м³</span>
                    </div>
                </li>
            @endif
        </ul>
    </div>
    @livewire('customer.cart.meta-block-livewire')
@push('custom-scripts')
<script>
    window.addEventListener('updateFooData', () => {
        document.FooTableEx.redraw('#footable-content');
    });

    function changeQuantity(input, productId) {
        var $input = $(input);
            var max = $input.attr('data-max');
            var value = $input.val();

       // setTimeout(() => {

        //    if ($(input).val() > max) {
       //         $input.val(max);
        //        value = max;

        //    }

            @this.changeProductQuantity(productId, value,max);
      // }, 700);



    }
    document.cartProduct = {
        changeQuantity: function (input, productId) {

        },
        remove: function (productId) {
            @this.
            removeProduct(productId);
        },
        setCheck: function (productId, checked) {
            @this.
            setCheckProduct(productId, checked);
        }

    }

</script>

<div class="modal fade" id="m-print-cart-order">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <livewire:forms.print-cart-order-livewire/>
    </div>
</div>

@endpush
</div>




















