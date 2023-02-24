<div class="lk-page__content">
  <h1 class="lk-page__title">@lang('custom::site.favorites')</h1>
  <div class="lk-page__filters">
  	@livewire('customer.favorites.index-search-livewire')
  </div>
  <div class="lk-page__table">
  	<div id="footable-content" class="footable-content" style="display: none" data-table="{{ $table }}"></div>
            <table class="ftable"  id="footable-holder"  data-empty="@lang('custom::site.data_is_absent')"
                    data-show-toggle="true" data-toggle-column="last" wire:ignore></table>
  </div>
  <div class="lk-page__table-after">
    <div class="align-items-start">
      <dl class="table-total">
        <dt>@lang('custom::site.total_sum') ( {{$totals['quantity']}} @lang('custom::site.products') )</dt>
        <dd class="big">{{$totals['opt']}} @lang('custom::site.uah')</dd>
        <dt>{{$totals['rrc']}} @lang('custom::site.uah')</dt>
        <dd>{{formatMoney($totals['sum'])}} @lang('custom::site.uah')</dd>
      </dl>
      <div class="lk-page__table-after-btns"><a class="button-accent" href="javascript:void(0);" onclick="@this.addToCart()">@lang('custom::site.to_order')</a></div>
    </div>
    <div>
    @include('livewire.includes.per-page-table', ['data_paginate' => $products])
    </div>
  </div>
</div>
@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            // document.FooTableEx.init('#footable-content', '#footable-holder');
            window.addEventListener('updateFooData', ()=>{
                document.FooTableEx.redraw('#footable-content');
            });

            document.deleteFavouriteItem = function (el, id) {
                Livewire.emit('eventRemoveFavouriteItem', {product_id:id})
            }
            document.deleteAllFavouriteItems = function (el) {
                Livewire.emit('eventClearFavourites');
            }
            document.checkAllFavouriteItems = function (el, checked) {
                $(el).closest('table').find('tbody input[type="checkbox"]').prop('checked', checked);
                @this.setAllProductsChecked(checked);
            }
            document.checkFavouriteItem = function (el, id) {
                @this.setProductChecked(id, el.checked);
            }
            document.changeFavouriteItemQuantity = function (el, id, qty) {
                @this.setProductQuantity(id, qty);
            }
        })
        //# sourceURL=favourites.index-content.js
    </script>
@endpush
