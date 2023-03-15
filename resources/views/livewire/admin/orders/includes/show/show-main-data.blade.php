<div class="order">
                  <div class="row">
                    <div class="col-md-3">
                      {{--<div class="info-item">
                        <div class="info-item__label">Событие</div>
                        <div class="info-item__data">Название</div>
                      </div>--}}
                      <div class="info-item">
                        <div class="info-item__label">id</div>
                        <div class="info-item__data"><a href="#">{{ $dataPage->id }}</a></div>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">Дата и время</div>
                        <div class="info-item__data">{{ formatDate($dataPage->created_at,'d.m.Y H:i') }}</div>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">Клиент</div>
                        <div class="info-item__data">{{ $dataPage->fio }}</div>
                      </div>
                      @if($dataPage->phone)
                      <div class="info-item">
                        <div class="info-item__label">Номер телефону</div>
                        <div class="info-item__data">{{ $dataPage->phone }}</div>
                      </div>
                      @endif
                      {{--<div class="info-item">
                        <div class="info-item__label">Номер стола</div>
                        <div class="info-item__data">534, 87</div>
                      </div>--}}
                      @if($dataPage->manager)
                      <div class="info-item">
                        <div class="info-item__label">Менеджер</div>
                        <div class="info-item__data">{{ $dataPage->manager->name }}</div>
                      </div>
                      @endif
                      {{--<div class="info-item">
                        <div class="info-item__label">Кол-во гостей</div>
                        <div class="info-item__data">9</div>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">Кол-во детей</div>
                        <div class="info-item__data">3</div>
                      </div>--}}
                    </div>
                    <div class="col-md-3">
                      {{--<div class="info-item">
                        <div class="info-item__label">Клиент</div>
                        <div class="info-item__data">Фамилия Имя</div>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">Остаток</div>
                        <div class="info-item__data">600 грн</div>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">Чеки</div>
                        <div class="info-item__data"> <a href="#">648</a><a href="#">545</a></div>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">Связанные чеки</div>
                        <div class="info-item__data"> <a href="#">126</a><a href="#">127</a><a href="#">128</a></div>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">Рейтинг заказа (0-100)</div>
                        <div class="info-item__data">
                          <div class="order-rating">
                            <div class="order-rating__count">50</div>
                            <ul class="order-rating__list">
                              <li class="_active --red"></li>
                              <li class="_active --yellow"></li>
                              <li class="_active"></li>
                              <li class="_active"></li>
                              <li class="_active"></li>
                              <li></li>
                              <li></li>
                              <li></li>
                              <li></li>
                              <li></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">Чеки</div>
                        <div class="info-item__data"> <a href="#">648</a><a href="#">545</a></div>
                      </div>--}}
                    </div>
                    <div class="col-md-6">
                      <div class="review-cont">
                        @if($dataPage->comment)
                        <div class="info-item__label">@lang('custom::admin.Comment to the order')</div>
                        <div class="info-item__data">
                          <p>
                            {!! $dataPage->comment !!}
                          </p>
                        </div>
                        @endif
                        <div class="action-group">
                          <div class="action-group-btn button-accent"><span class="ico_submenu"></span></div>
                          <div class="action-group-drop">
                            <ul class="action-group-list">
                              <li><button class="ico_message" type="button"></button></li>
                              <li><button class="ico_dialog" type="button"></button></li>
                              <li><button class="ico_print" type="button"></button></li>
                              <li><button class="js-hide-drop ico_close" type="button"></button></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
