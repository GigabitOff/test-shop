<div class="order">
    <div class="row">
        <div class="col-md-5">
            <div class="info-item">
                <div class="info-item__label">Дата отправки</div>
                    <div class="info-item__data">{{ formatDate($dataPage->date_registration,'d.m.Y H:i') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-item__label">Дата доставки</div>
                    <div class="info-item__data">{{ formatDate($dataPage->date_delivery,'d.m.Y H:i') }}</div>
                </div>
                @if($dataPage->deliveryAddress)
                      <div class="info-item">
                        <div class="info-item__label">Служба доставки</div>
                        <div class="info-item__data">
                            {{ isset($dataPage->deliveryAddress->deliveryType) ?$dataPage->deliveryAddress->deliveryType->name : ''}}
                        </div>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">Адрес доставки</div>
                        <div class="info-item__data">{{ $dataPage->deliveryAddress->additional_data}}{{--, ул. Машиностороительная 69, кв. 36--}}</div>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">Контактное лицо</div>
                        <div class="info-item__data">
                            {{ $dataPage->fio }} {{ $dataPage->phone }}</div>
                      </div>
                @endif
                    </div>
                    <div class="col-md-7">
                      <div class="info-item">
                        <div class="info-item__label">Доставщик</div><button class="select-rules" data-bs-target="#m-select-delivery-man" data-bs-toggle="modal">Фамилия И.О.</button>
                      </div>
                      <div class="info-item">
                        <div class="info-item__label">Номер ТТН </div>
                        <div class="info-item__data">
                          <div class="row g-3">
                            <div class="col-lg-8"><input class="form-control" type="text" placeholder="ТТН"></div>
                            <div class="col-lg-4"> <button class="button w-100" type="text">Подтвердить</button></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
