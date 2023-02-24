<div class="product-content">
    {{-- Product show - Перегляд деталей товару --}}
<div class="container container-lg">
    <div class="product-content__head" data-aos="fade-up" data-aos-duration="500">
        <div class="product-content__btns">
            <div><a class="decor-link decor-link--left" href="javascript: window.history.back();"><span><span class="ico_arrow-l"></span>@lang('custom::site.Come back')</span></a></div>
              <div>
                {{--<div class="product-content__status">@lang('custom::site.availability.'.$data->availability)</div>--}}
              </div>
            </div>
            @php
                $forAnalogData = $data;
            @endphp
            <div class="product-content__title">{{ $data->name }}</div>
            <div class="product-content__links">
              @if(isset($category))
                <div><a class="product-content__category" href="{{ route('catalog.show', $category->id) }}">{{ $category->name }}</a></div>
                @endif
              <div><a class="product-content__question" href="#modal-ask-question" data-toggle="modal">@lang('custom::site.asc_a_question?')?</a></div>
              <div>

                  @include('livewire.catalog.includes.social_list')
              </div>
            </div>
          </div>
          <div class="row">
            <div class="order-1 order-md-2 col-xl-5 col-md-6">
              <div class="product-content__slider" data-aos="fade-left" data-aos-delay="300" data-aos-duration="500">

                @php($data_products = $data->products)
                <div class="product-content__slider-box">

                    @php($categoryImage = ($data->mainImage ? $data->mainImage->url : (isset($data->images[0]) ) ? $data->images[0]->url : '' ))
                      @if($data->brand AND \Storage::disk('public')->exists($data->brand->ImageUrl))
                  <div class="product-content__brand">
                      <img src="{{\Storage::disk('public')->url($data->brand->ImageUrl)}}" alt="{{$data->brand->title}}">
                    </div>

                      @endif
                  <div class="js-product-slider-big product-slider-big">
                    <div class="swiper-container">
                      <div class="swiper-wrapper">
                          @if(\Storage::disk('public')->exists($categoryImage))
                        <div class="swiper-slide">
                            <img src="{{\Storage::disk('public')->url($categoryImage)}}" alt="product">
                        </div>
                        @else
                        <div class="swiper-slide">
                        <img src="/assets/img/Foto.png" alt="{{ $data->name }}" />
                        </div>

                        @endif

                        @foreach ($data_products as $item)
                        @if(count($gallery = $item->images->where('status',1))>0)

                            @foreach ($gallery as $item_ph)
                                @if(isset($item_ph->url) AND \Storage::disk('public')->exists($item_ph->url))
                                <div class="swiper-slide"><img src="{{\Storage::disk('public')->url($item_ph->url)}}" alt="product"></div>
                                @else
                                <img src="/assets/img/Foto.png" alt="{{ $item_ph->name }}" />
                                @endif
                            @endforeach
                        @endif

                        @endforeach

                        {{--<div class="swiper-slide">
                          <div class="youtube">
                              <iframe width="560" height="315" src="https://www.youtube.com/embed/e7WArhq3EmY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                        </div>--}}
                      </div>
                      <div class="swiper-pagination"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="order-2 order-md-1 col-xl-7 col-md-6">
              <div class="row">
                <div class="col-xl-6 col-12" data-aos="fade-right" data-aos-delay="400" data-aos-duration="500">
                  <div class="product-content__specifications specifications">
                    <div class="specifications__box">
                      <div class="specifications__head">@lang('custom::site.Specifications')</div>
                      <div class="specifications__body">
                      <div class="specifications__overflow">
                        <ul class="specifications__list">

                        @if($data->allAttributes() !== null AND count($data->allAttributes())>0)
                        @foreach ($data->allAttributes() as $key_atr=>$data_atr)
                            <li>
                                <span>{{ \Illuminate\Support\Str::limit($key_atr, 16) }}</span>
                                <span>{{ \Illuminate\Support\Str::limit($data_atr, 26) }}</span>
                            </li>
                        @endforeach
                        @endif
                        </ul>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-12" data-aos="fade-in" data-aos-delay="700" data-aos-duration="500">
                  @livewire('widgets.catalog.review.review-show-livewire', ['category_id' => $data->id,'products'=>(isset($data_products) ?  $data_products: null)], key(time().'-review-show-'.$data->id))
                </div>
              </div>
            </div>
          </div>
          <div class="row" wire:ignore>
            <div class="col-12" data-aos="fade-up" data-aos-delay="1000" data-aos-duration="500">
                @livewire('catalog.product.catalog-product-show-livewire', ['item_id' => $data->id,'data'=>$data,'products'=>(isset($data_products) ?  $data_products: null)], key(time().'-catalog-product-show-'.$data->id))
            </div>
          </div>
        </div>
        <div class="product-content__bottom">
          <div class="container container-lg">
            <div class="row">
              <div class="col-xl-4 col-md-5">
                <div class="product-content__technical-desc technical-desc">
                  <div class="technical-desc__decor" data-aos="fade-up" data-aos-delay="1200" data-aos-duration="500"></div>
                  <div class="technical-desc__box" data-aos="fade-up" data-aos-delay="1400" data-aos-duration="500">
                    <div class="technical-desc__head">@lang('custom::site.Technical description')</div>
                    <div class="technical-desc__body">
                        {!! $data->description ? $data->description : $data->technical_description !!}
                      {{--<ul class="technical-desc__list">
                        <li><span>Стандарт</span><span>DIN 931</span></li>
                        <li><span>Матеріал</span><span>Сталь</span></li>
                        <li><span>Клас міцності</span><span>10.9</span></li>
                        <li><span>Покриття</span><span>Без покриття</span></li>
                        <li><span>Діаметр</span><span>5, 6, 8, 10, 12 ...</span></li>
                        <li><span>Довжина</span><span>30, 35, 40, 45</span></li>
                        <li><span>Головка</span><span>Шестигранна</span></li>
                        <li><span>Вид різьби</span><span>Частична</span></li>
                        <li><span>Тип різьби</span><span>Метрична</span></li>
                        <li><span>Клас міцності</span><span>DIN 931</span></li>
                        <li><span>Покриття</span><span>Сталь</span></li>
                      </ul>--}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col col-md-7 d-xl-hidden">
                <div class="product-reviews-mobile"></div>
              </div>
              <div class="col-xl-8 col-12">

                @livewire('catalog.product.catalog-product-analog-show-livewire', ['item_id' => $forAnalogData->id,'data'=>$forAnalogData], key(time().'-catalog-product-show-'.$data->id))
              </div>
            </div>
          </div>
        </div>
</div>
