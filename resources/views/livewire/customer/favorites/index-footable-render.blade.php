<table data-paging-size="4">
    <thead>
        <tr>
          <th>
            <div class="d-flex align-items-center"><label class="check js-select-all">
                       <input class="check__input" id="select-all"
                       wire:model.defer="selectAll"
                       onclick="document.checkAllFavouriteItems(this, this.checked)"
                       type="checkbox"><span class="check__box"></span><span class="check__txt"></span></label><span>@lang('custom::site.product')</span></div>
          </th>
          <th data-breakpoints="xs">@lang('custom::site.category')</th>
          <th data-breakpoints="xs">@lang('custom::site.price')</th>
          <th class="text-center" data-breakpoints="xs sm md">@lang('custom::site.quantity')</th>
          <th data-breakpoints="xs sm md">@lang('custom::site.sum')</th>
          <th data-breakpoints="xs sm md"></th>
          <th class="text-end" data-breakpoints="xs sm md"><button class="button-delete ico_trash hide-mobile" type="button"></button></th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
          <td>
            <div class="d-flex align-items-center"><label class="check"><input class="check__input" onchange="document.checkFavouriteItem(this, {{$product->id}})"
                               @if($selected[$product->id]['checked']) checked @endif
                               type="checkbox" /><span class="check__box"></span><span class="check__txt"></span></label>
              <div class="table-product-card">
                <div class="table-product-card__img">
                    @php([$url, $image] = $product->compactUrlImage())
                    <img src="{{$image}}" alt="image">
                </div>
                <div class="table-product-card__desc"><span class="table-product-card__art">№ {{$product->articul}}</span><a class="table-product-card__title" href="{{$url}}">{{$product->name}}</a></div>
              </div>
            </div>
          </td>
          <td><span>М'які меблі</span></td>
          <td><span class="big">1 324 @lang('custom::site.uah')</span><span class="small">2 648 @lang('custom::site.uah')</span></td>
          <td class="text-xl-center">
            <div class="counter">
              <div class="counter__btn minus"></div>
              <div class="counter__field"><input type="number"
                                   value="{{$selected[$product->id]['quantity']}}" min="1"
                                   onchange="document.changeFavouriteItemQuantity(this, {{$product->id}}, this.value)"
                                   onclick="this.select();" /></div>
              <div class="counter__btn plus"></div>
            </div>
          </td>
          <td><span class="big">1 324 @lang('custom::site.uah')</span><span class="small">2 648 @lang('custom::site.uah')</span></td>
          <td class="text-end"><button class="button-accent" type="button" onclick="@this.addToCart()">@lang('custom::site.Buy')</button></td>
          <td class="text-end"><button class="button-delete ico_trash" onclick="document.deleteFavouriteItem(this, {{$product->id}})" type="button"></button></td>
        </tr>
    @endforeach
    </tbody>
</table>
