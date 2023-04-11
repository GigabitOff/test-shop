<table>
<div class="col-xxl-5 col-md-6">
  <div class="product-gallery">
    <div class="product-gallery-box">
      <div class="product-gallery__compare"><button class="js-add-compare ico_compare @if(comparisons()->isExistProduct($data->id)) is-active @endif" onclick="Livewire.emit('eventToggleComparisons', {'product_id' : {{$data->id}} })"></button></div>
        @foreach($data->brands as $brand)
            <div class="product-gallery__brand"><img src="{{\Storage::disk('public')->url($brand->image_small)}}" alt="logo-brand"></div>
        @endforeach
    @if($images)
        <div class="js-product-full product-full-slider">
            <div class="swiper">
              <div class="swiper-wrapper">
                @foreach($images as $key=>$image)
                <div class="swiper-slide">
                    <a href="{{\Storage::disk('public')->url($image->url)}}" data-fancybox="product-fancybox">
                        <img src="{{\Storage::disk('public')->url($image->url)}}" alt="product-full">
                    </a></div>
                @endforeach
              </div>
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
            </div>
        </div>
    @else
        <img src="{{fallbackBaseImageUrl('')}}" alt=""/>
    @endif
    </div>
  @if($images)
    <div class="product-gallery-thumb">
      <div class="js-product-thumb product-thumb-slider">
        <div class="swiper">
          <div class="swiper-wrapper">
          @foreach($images as $imgs)
            <div class="swiper-slide"><img src="{{\Storage::disk('public')->url($imgs->url)}}" alt="product-thumb"></div>
          @endforeach
          </div>
        </div>
      </div>
    </div>
  @endif
  </div>
</div>
<div class="col-xxl-7 col-md-6">
  <div class="product-full-box --info">
    <div class="product-full__labels"><span class="product-full-label --instock">
    @if($data->availability) @lang('custom::site.availability_exist') @else @lang('custom::site.availability_waiting') @endif
    </span><span class="product-full-label --utd"><i class="ico_discount"></i>Уцінка</span></div>
    <h1 class="product-full__title">{{$data->name}}</h1>
    <ul class="product-full__info">
      <li><span>@lang('custom::site.Article')</span><strong>№ {{$data->articul ?? ''}}</strong></li>
    @if($data->brand)
      <li><span>@lang('custom::site.Producer')</span><strong>{{$data->brand->title}}</strong></li>
    @endif
      <li><span>@lang('custom::site.color')</span>
        <ul class="colors">
          <li><span style="background-color:#fff"></span></li>
          <li><span style="background-color:#C5855E"></span></li>
          <li><span style="background-color:#878C98"></span></li>
          <li><span style="background-color:#C3C8D5"></span></li>
        </ul>
      </li>
    </ul>
    <div class="product-full__info-btns">
      <div class="product-full__info-actions">
        <div class="product-full__info-actions-top">
          <div class="product-full__price">
            <div><span>@lang('custom::site.price product')</span><strong>{{$data->price_init}}<small>грн</small></strong></div>
            <div><a href="#m-question2" data-bs-toggle="modal">Задати питання?</a><a href="#m-price" data-bs-toggle="modal">Стежити за ціной</a></div>
          </div>
          <div class="product-full__btns-group">
            <div class="product-full__counter">
              <div class="counter">
                <div class="counter__btn minus"></div>
                <div class="counter__field"><input class="input-col" type="number" value="{{$data->multiplicity}}" min="{{$data->multiplicity}}"  step="{{$data->multiplicity}}" onclick="this.select();" /></div>
                <div class="counter__btn plus"></div>
              </div><span>@lang('custom::site.The multiplicity of the sale of goods') {{$data->multiplicity}}</span>
            </div>
            <div class="product-full__bay">
            {{--@if(auth()->check() && auth()->user()->isRegistrationCompleted())--}}
                <a class="button-accent" href="#m-flash-info" data-bs-toggle="modal" onclick="@this.addToCart({{$data->id}}, $('.counter__field input')[0].value)" >@lang('custom::site.To the basket')</a>
            {{--@else--}}
                {{--<a class="button-accent" href="#m-flash-info" data-bs-toggle="modal">@lang('custom::site.To the basket')</a>--}}
            {{--@endif--}}
            </div>
          </div>
        </div>
        <div class="product-full__info-actions-bottom"><a class="button-outline" href="#m-quick-purchase" data-bs-toggle="modal">Швидка покупка</a><a class="button-break" href="http://www.google.com" target="_blank"><img src="/assets/img/button-break.svg" alt="button-break">Розкроїти</a></div>
      </div>
      <!--<div class="product-full__info-dependence" data-da=".--info-dependence, 1023">
        <div class="drop --arrow">
          <spav class="drop-clear"></spav><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Залежності товару" />
          <div class="drop-box">
            <div class="drop-overflow">
              <ul class="drop-list">
                <li class="drop-list-item">Залежності товару 1</li>
                <li class="drop-list-item">Залежності товару 2</li>
                <li class="drop-list-item">Залежності товару 3</li>
                <li class="drop-list-item">Залежності товару 4</li>
                <li class="drop-list-item">Залежності товару 5</li>
                <li class="drop-list-item">Залежності товару 6</li>
                <li class="drop-list-item">Залежності товару 7</li>
                <li class="drop-list-item">Залежності товару 8</li>
                <li class="drop-list-item">Залежності товару 9</li>
                <li class="drop-list-item">Залежності товару 10</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="drop --arrow">
          <spav class="drop-clear"></spav><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Залежності товару" />
          <div class="drop-box">
            <div class="drop-overflow">
              <ul class="drop-list">
                <li class="drop-list-item">Залежності товару 1</li>
                <li class="drop-list-item">Залежності товару 2</li>
                <li class="drop-list-item">Залежності товару 3</li>
                <li class="drop-list-item">Залежності товару 4</li>
                <li class="drop-list-item">Залежності товару 5</li>
                <li class="drop-list-item">Залежності товару 6</li>
                <li class="drop-list-item">Залежності товару 7</li>
                <li class="drop-list-item">Залежності товару 8</li>
                <li class="drop-list-item">Залежності товару 9</li>
                <li class="drop-list-item">Залежності товару 10</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="drop --arrow">
          <spav class="drop-clear"></spav><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Залежності товару" />
          <div class="drop-box">
            <div class="drop-overflow">
              <ul class="drop-list">
                <li class="drop-list-item">Залежності товару 1</li>
                <li class="drop-list-item">Залежності товару 2</li>
                <li class="drop-list-item">Залежності товару 3</li>
                <li class="drop-list-item">Залежності товару 4</li>
                <li class="drop-list-item">Залежності товару 5</li>
                <li class="drop-list-item">Залежності товару 6</li>
                <li class="drop-list-item">Залежності товару 7</li>
                <li class="drop-list-item">Залежності товару 8</li>
                <li class="drop-list-item">Залежності товару 9</li>
                <li class="drop-list-item">Залежності товару 10</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="drop --arrow">
          <spav class="drop-clear"></spav><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Залежності товару" />
          <div class="drop-box">
            <div class="drop-overflow">
              <ul class="drop-list">
                <li class="drop-list-item">Залежності товару 1</li>
                <li class="drop-list-item">Залежності товару 2</li>
                <li class="drop-list-item">Залежності товару 3</li>
                <li class="drop-list-item">Залежності товару 4</li>
                <li class="drop-list-item">Залежності товару 5</li>
                <li class="drop-list-item">Залежності товару 6</li>
                <li class="drop-list-item">Залежності товару 7</li>
                <li class="drop-list-item">Залежності товару 8</li>
                <li class="drop-list-item">Залежності товару 9</li>
                <li class="drop-list-item">Залежності товару 10</li>
              </ul>
            </div>
          </div>
        </div>
      </div>-->
    </div>
  </div>
</div>
@push('custom-scripts')
<script>
    jQuery(document).ready(function ($) {
        $('body').on('change', '.product-full__counter input.input-col', function (event) {
            var minimum = parseInt($(this).attr("min") ? $(this).attr("min") : 1);
            var count = parseInt($(this).val());
            if (count < minimum) {
                $(this).val(minimum);

            } else if (count % minimum) { // РЅРµ РєСЂР°С‚РЅРѕ
                var qauntity = Math.ceil(count / minimum);
                $(this).val(minimum * qauntity);
            }
            //console.log('change number ' + minimum * qauntity);
        });
        $('body').on('click', '.product-full__counter .minus', function (event) {
            var $input = $(this).parent().find('input');
            var minimum = parseInt($input.attr("min") ? $input.attr("min") : 1);
            var count = parseInt($input.val()) - minimum;
            count = count < minimum ? minimum : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('body').on('click', '.product-full__counter .plus', function (event) {
            var $input = $(this).parent().find('input');
            var minimum = parseInt($input.attr("min") ? $input.attr("min") : 1);
            $input.val(parseInt($input.val()) + minimum);
            $input.change();
            return false;
        });
    });

   /* document.cartProduct = {
        changeQuantity: function (input, productId) {
            const $input = $(input);
            const max = $input.attr('data-max');
            const value = $input.val();

            if (max !== undefined && value > max) {
                $input.val(max);
            }

            // @this.
            // changeProductQuantity(productId, value);
        },
    }*/
</script>
@endpush

</table>
