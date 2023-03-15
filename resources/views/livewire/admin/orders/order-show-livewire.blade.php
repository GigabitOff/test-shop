<div >
  @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])
    <h4>@lang('custom::admin.Brands')</h4>
    <div class="page-order-wrapper">
            <ul class="nav nav-tabs order-tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">
                    @lang('custom::admin.Main data order')
                </button>
            </li>
              <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab">@lang('custom::admin.Delivery')</button></li>
              {{--<li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                @lang('custom::admin.Order change history')
            </button></li>--}}
            </ul>
            <div class="tab-content order-tab-content">
              <div class="tab-pane fade show active" id="all" role="tabpanel">
                @include('livewire.admin.orders.includes.show.show-main-data')

              </div>
              <div class="tab-pane fade" id="delivery" role="tabpanel">
                @include('livewire.admin.orders.includes.show.show-delivery')
              </div>
              {{--<div class="tab-pane fade" id="history" role="tabpanel">
                <div class="order">
                  <div class="order-history">
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                    <div class="order-history__item">
                      <div class="order-history__name">Фамилия И.О.</div>
                      <div class="order-history__time">02.02.22 15:22:00</div>
                    </div>
                  </div><button class="order-history__more" type="button">
                    <div class="--close">+ 36 записей</div>
                    <div class="--active">Скрыть</div>
                  </button>
                </div>
              </div>--}}
            </div>
            <div class="order-payment">
              <div class="order-payment__item">
                <div class="order-payment__title">@lang('custom::admin.Payment state')</div>
                <div class="order-payment__status">
                  <div class="status-button status-button-{{ $dataPage->payment_status == 1 ? $dataPage->payment_status : 2}}">@lang('custom::admin.payment_state.'.(int)$dataPage->payment_status)</div>
                  @if($dataPage->payment_status == 1)
                  <div class="order-payment__date"> <span>26.09.22</span>20:30</div>
                  @endif
                </div>
              </div>
                  @if($dataPage->payment_status == 1)
              <div class="order-payment__item">
                <div class="order-payment__title">Тип оплаты</div>
                <div class="order-payment__type"> <img src="/admin/assets/img/paypal.svg" alt="payment"></div>
              </div>
              <div class="order-payment__item">
                <div class="order-payment__title">Оплачено</div>
                <div class="order-payment__text">960 грн</div>
              </div>
              <div class="order-payment__item">
                <div class="order-payment__title">№ квитанции</div>
                <div class="order-payment__text">690</div>
              </div><button class="button">Сделать возврат</button>
                  @endif
            </div>
          </div>
          {{--@if(count($this->dataPage->services)>0)
            @include('livewire.admin.orders.includes.show.show-service')
          @endif--}}

          @if(count($this->dataPage->products)>0)
            @include('livewire.admin.orders.includes.show.show-product')
          @endif


          <div class="page-bottom-group">
            <div>
              <div class="button-group page-save --btn-group"><button class="button" type="button">Подтвердить</button><button class="button button-secondary" type="button">Отменить</button></div>
            </div>
            <div>
              <div class="table-nav">
                <div class="drop --arrow js-page-size"><button class="form-control drop-button" type="button">10</button>
                  <div class="drop-box">
                    <div class="drop-overflow">
                      <ul class="drop-list">
                        <li class="drop-list-item" data-page-size="10">10</li>
                        <li class="drop-list-item" data-page-size="20">20</li>
                        <li class="drop-list-item" data-page-size="30">30</li>
                        <li class="drop-list-item" data-page-size="40">40</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div id="table-nav-7"></div>
              </div>
            </div>
          </div>

</div>
