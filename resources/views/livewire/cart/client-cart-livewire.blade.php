<div class="lk-page-cart">
    {{-- Client Cart Livewire--}}
    <div class="lk-page-header">
        <div class="lk-page-title">@lang('custom::site.Basket')</div>
    </div>
    <div class="lk-table">
        <div class="lk-table-header">
            <div class="js-select-all custom-control custom-checkbox"><input
                    class="custom-control-input select-all"
                    id="select-all" type="checkbox"><label
                    class="custom-control-label"
                    for="select-all">@lang('custom::site.Choose everything')</label></div>
            <button class="js-clear-list-products button button-secondary"
                    type="button">@lang('custom::site.Clear list')</button>
        </div>

        {{-- Users / Cart/ Product List --}}
        @livewire('cart.product-list-livewire', key(time().'client-product-list'))
{{--        <div wire:ignore class="lk-table-body" id="product-list-livewire">--}}
            {{-- Users / Cart/ Product List --}}
{{--            @livewire('users.cart.product-list-livewire', key(time().'client-product-list'))--}}
{{--        </div>--}}

        <div class="lk-table-bottom">
            <div class="custom-control custom-checkbox"><input class="custom-control-input"
                                                               id="no-callback"
                                                               type="checkbox" checked><label
                    class="custom-control-label"
                    for="no-callback">@lang('custom::site.Don call me back, Im sure of the order')</label>
            </div>
            <a class="button button-secondary" href="#modal-found-cheaper"
               data-toggle="modal">@lang('custom::site.Found cheaper?')</a>
        </div>
        <div class="lk-table-footer">
            <div class="lk-table-footer-left-row">
                <div class="lk-table-total">
                    <div class="lk-table-total__item">
                        <div class="lk-table-total__title">@lang('custom::site.total')</div>
                        <div class="lk-table-total__value">
                            <span class="lk-table-total__sum">
                                <span class="value">{{$cartInfo['totalCost']}}</span> @lang('custom::site.UAH').
                            </span>
                        </div>
                    </div>
                    <div class="lk-table-total__item">
                        <div class="lk-table-total__title"></div>
                        <div class="lk-table-total__value">
                            <span class="lk-table-total__col text-lowercase">
                                <span class="value">{{$cartInfo['totalQty']}}</span> @lang('custom::site.products')
                            </span>
                            <span class="lk-table-total__weight">
                                <span class="value">0</span> @lang('custom::site.kg') / <span class="value">0</span> @lang('custom::site.k.m.')</span>
                        </div>
                    </div>
                    <div class="lk-table-total__item">
                        <div
                            class="lk-table-total__title">@lang('custom::site.Estimated delivery date')</div>
                        <div class="lk-table-total__value"><span class="lk-table-total__date">08.12.2020</span>
                        </div>
                    </div>
                </div>
                <div class="lk-table-bonus">
                    <div class="lk-table-bonus__title">@lang('custom::site.My bonuses')</div>
                    <div class="lk-table-bonus__form">
                        <form class="form-inline" action="#">
                            <div class="form-group"><input class="form-control" type="number"
                                                           value="2586"></div>
                            <div class="form-group"><input class="button button-secondary"
                                                           type="button"
                                                           value="Списати"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lk-page-total">
        <div class="total-action">
            <div class="total-action__top">
                <div class="row">
                    <div class="col-xl-10">
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="select-custome js-select-pay">
                                    <div class="select-custome-current">
                                        <span>@lang('custom::site.Payment method')</span></div>
                                    <div class="select-custome-box">
                                        <ul>
                                            <li>@lang('custom::site.By card')</li>
                                            <li>@lang('custom::site.Cash on delivery')</li>
                                            <li>@lang('custom::site.Upon receipt')</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="select-custome js-select-delivery">
                                    <div class="select-custome-current">
                                        <span>@lang('custom::site.Delivery method')</span></div>
                                    <div class="select-custome-box">
                                        <ul>
                                            <li class="js-delivery-1">@lang('custom::site.Self-pickup')</li>
                                            <li class="js-delivery-2">@lang('custom::site.Delivery around the city')</li>
                                            <li class="js-delivery-3">@lang('custom::site.Delivery')</li>
                                            <li class="js-delivery-4">@lang('custom::site.CAT')</li>
                                            <li class="js-delivery-5">@lang('custom::site.New mail')</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="select-custome js-select-customer">
                                    <div class="select-custome-current">
                                        <span>@lang('custom::site.Counterparty')</span>
                                    </div>
                                    <div class="select-custome-box">
                                        <ul>
                                            <li class="js-customer-1">@lang('custom::site.Jur. face')</li>
                                            <li class="js-customer-2">@lang('custom::site.Phys. person 2')</li>
                                            <li class="js-customer-3">@lang('custom::site.Phys. person 2')</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <button
                                    class="js-add-comment button button-primary button-block"
                                    type="button">@lang('custom::site.Comment')</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 text-right">
                        <button class="button button-secondary button-block"
                                wire:click="createOrder"
                                type="button">@lang('custom::site.Confirm')</button>
                    </div>
                </div>
            </div>
            <div class="total-action__bottom" style="display: none;">
                <div class="row">
                    <div class="col-xl-10">
                        <div class="row">
                            <div class="col-xl-3">
                                <div
                                    class="total-action-value total-action-value--pay js-value-pay"></div>
                            </div>
                            <div class="col-xl-3">
                                <div class="total-action-value--delivery js-value-delivery">
                                    <div class="delivery-content js-delivery-content-1">
                                        <form action="#">
                                            <div class="form-group">
                                                <div
                                                    class="custome-dropdown custome-dropdown--arrow --empty">
                                                    <input
                                                        class="form-control" type="text"
                                                        placeholder="Выберите город"/>
                                                    <div class="custome-dropdown-box">
                                                        <div class="custome-dropdown-overflow">
                                                            <ul>
                                                                <li>Результат 1</li>
                                                                <li>Результат 2</li>
                                                                <li>Результат 3</li>
                                                                <li>Результат 4</li>
                                                                <li>Результат 5</li>
                                                                <li>Результат 6</li>
                                                                <li>Результат 7</li>
                                                                <li>Результат 8</li>
                                                                <li>Результат 9</li>
                                                                <li>Результат 10</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div
                                                    class="custome-dropdown custome-dropdown--arrow">
                                                    <input
                                                        class="form-control" type="text"
                                                        placeholder="Выберите отделение"/>
                                                    <div class="custome-dropdown-box">
                                                        <div class="custome-dropdown-overflow">
                                                            <ul>
                                                                <li>Результат 1</li>
                                                                <li>Результат 2</li>
                                                                <li>Результат 3</li>
                                                                <li>Результат 4</li>
                                                                <li>Результат 5</li>
                                                                <li>Результат 6</li>
                                                                <li>Результат 7</li>
                                                                <li>Результат 8</li>
                                                                <li>Результат 9</li>
                                                                <li>Результат 10</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="delivery-content js-delivery-content-2">
                                        <form action="#">
                                            <div class="form-group">
                                                <div
                                                    class="custome-dropdown custome-dropdown--arrow --empty">
                                                    <input
                                                        class="form-control" type="text"
                                                        placeholder="Выберите город"/>
                                                    <div class="custome-dropdown-box">
                                                        <div class="custome-dropdown-overflow">
                                                            <ul>
                                                                <li>Результат 1</li>
                                                                <li>Результат 2</li>
                                                                <li>Результат 3</li>
                                                                <li>Результат 4</li>
                                                                <li>Результат 5</li>
                                                                <li>Результат 6</li>
                                                                <li>Результат 7</li>
                                                                <li>Результат 8</li>
                                                                <li>Результат 9</li>
                                                                <li>Результат 10</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group"><input class="form-control"
                                                                           type="text"
                                                                           placeholder="Ввведите адрес">
                                            </div>
                                            <div class="form-group"><textarea
                                                    class="form-control"
                                                    placeholder="Комментарий"></textarea>
                                            </div>
                                            <div class="form-group"><input
                                                    class="js-datepicker form-control"
                                                    type="text" placeholder="Дата отправки">
                                            </div>
                                            <div class="form-group"><span>* Стоимость доставки 300 @lang('custom::site.UAH').</span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="delivery-content js-delivery-content-3">
                                        <form action="#">
                                            <div class="form-group">
                                                <div
                                                    class="custome-dropdown custome-dropdown--arrow --empty">
                                                    <input
                                                        class="form-control" type="text"
                                                        placeholder="Выберите город"/>
                                                    <div class="custome-dropdown-box">
                                                        <div class="custome-dropdown-overflow">
                                                            <ul>
                                                                <li>Результат 1</li>
                                                                <li>Результат 2</li>
                                                                <li>Результат 3</li>
                                                                <li>Результат 4</li>
                                                                <li>Результат 5</li>
                                                                <li>Результат 6</li>
                                                                <li>Результат 7</li>
                                                                <li>Результат 8</li>
                                                                <li>Результат 9</li>
                                                                <li>Результат 10</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="js-group-option group-option"><label>Тип
                                                    доставки</label>
                                                <div class="form-group">
                                                    <div class="form-check"><label
                                                            class="form-check-label"><input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="delivery--type-delivery"
                                                                value="option1"
                                                                checked><span>Адрес</span></label>
                                                    </div>
                                                    <div class="form-check"><label
                                                            class="form-check-label"><input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="delivery--type-delivery"
                                                                value="option2"><span>Склад</span></label>
                                                    </div>
                                                </div>
                                                <div class="js-option1 group-option-item"><input
                                                        class="form-control"
                                                        type="text"
                                                        placeholder="Ввведите адрес">
                                                </div>
                                                <div class="js-option2 group-option-item">
                                                    <div
                                                        class="custome-dropdown custome-dropdown--arrow">
                                                        <input
                                                            class="form-control" type="text"
                                                            placeholder="Выберите отделение"/>
                                                        <div class="custome-dropdown-box">
                                                            <div
                                                                class="custome-dropdown-overflow">
                                                                <ul>
                                                                    <li>Результат 1</li>
                                                                    <li>Результат 2</li>
                                                                    <li>Результат 3</li>
                                                                    <li>Результат 4</li>
                                                                    <li>Результат 5</li>
                                                                    <li>Результат 6</li>
                                                                    <li>Результат 7</li>
                                                                    <li>Результат 8</li>
                                                                    <li>Результат 9</li>
                                                                    <li>Результат 10</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="delivery-content js-delivery-content-4">
                                        <form action="#">
                                            <div class="js-group-option group-option"><label>Тип
                                                    доставки</label>
                                                <div class="form-group">
                                                    <div class="form-check"><label
                                                            class="form-check-label"><input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="delivery--type-delivery"
                                                                value="option1"
                                                                checked><span>Склад</span></label>
                                                    </div>
                                                    <div class="form-check"><label
                                                            class="form-check-label"><input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="delivery--type-delivery"
                                                                value="option2"><span>Двери</span></label>
                                                    </div>
                                                </div>
                                                <div class="js-option1 group-option-item">
                                                    <div class="form-group"><input
                                                            class="form-control" type="text"
                                                            placeholder="Контактное лицо"></div>
                                                    <div class="form-group"><input
                                                            class="js-phone form-control"
                                                            type="text"
                                                            placeholder="Номер телефона"></div>
                                                    <div class="form-group"><input
                                                            class="js-datepicker form-control"
                                                            type="text"
                                                            placeholder="Дата отправки"></div>
                                                </div>
                                                <div class="js-option2 group-option-item">
                                                    <div class="form-group"><input
                                                            class="form-control" type="text"
                                                            placeholder="Введите адрес"></div>
                                                    <div class="form-group"><input
                                                            class="form-control" type="text"
                                                            placeholder="Контактное лицо"></div>
                                                    <div class="form-group"><input
                                                            class="js-datepicker form-control"
                                                            type="text"
                                                            placeholder="Дата отправки"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="delivery-content js-delivery-content-5">
                                        <form action="#">
                                            <div class="js-group-option group-option"><label>Тип
                                                    доставки</label>
                                                <div class="form-group">
                                                    <div class="form-check"><label
                                                            class="form-check-label"><input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="delivery--type-delivery"
                                                                value="option1"
                                                                checked><span>Курьером</span></label>
                                                    </div>
                                                    <div class="form-check"><label
                                                            class="form-check-label"><input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="delivery--type-delivery"
                                                                value="option2"><span>В отделение</span></label>
                                                    </div>
                                                </div>
                                                <div class="js-option1 group-option-item">
                                                    <div class="form-group">
                                                        <div
                                                            class="custome-dropdown custome-dropdown--arrow">
                                                            <input
                                                                class="form-control" type="text"
                                                                placeholder="Выберите область"/>
                                                            <div class="custome-dropdown-box">
                                                                <div
                                                                    class="custome-dropdown-overflow">
                                                                    <ul>
                                                                        <li>Результат 1</li>
                                                                        <li>Результат 2</li>
                                                                        <li>Результат 3</li>
                                                                        <li>Результат 4</li>
                                                                        <li>Результат 5</li>
                                                                        <li>Результат 6</li>
                                                                        <li>Результат 7</li>
                                                                        <li>Результат 8</li>
                                                                        <li>Результат 9</li>
                                                                        <li>Результат 10</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div
                                                            class="custome-dropdown custome-dropdown--arrow --empty">
                                                            <input class="form-control"
                                                                   type="text"
                                                                   placeholder="Выберите город"/>
                                                            <div class="custome-dropdown-box">
                                                                <div
                                                                    class="custome-dropdown-overflow">
                                                                    <ul>
                                                                        <li>Результат 1</li>
                                                                        <li>Результат 2</li>
                                                                        <li>Результат 3</li>
                                                                        <li>Результат 4</li>
                                                                        <li>Результат 5</li>
                                                                        <li>Результат 6</li>
                                                                        <li>Результат 7</li>
                                                                        <li>Результат 8</li>
                                                                        <li>Результат 9</li>
                                                                        <li>Результат 10</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"><input
                                                            class="form-control" type="text"
                                                            placeholder="Введите адрес"></div>
                                                </div>
                                                <div class="js-option2 group-option-item">
                                                    <div class="form-group">
                                                        <div
                                                            class="custome-dropdown custome-dropdown--arrow">
                                                            <input
                                                                class="form-control" type="text"
                                                                placeholder="Выберите область"/>
                                                            <div class="custome-dropdown-box">
                                                                <div
                                                                    class="custome-dropdown-overflow">
                                                                    <ul>
                                                                        <li>Результат 1</li>
                                                                        <li>Результат 2</li>
                                                                        <li>Результат 3</li>
                                                                        <li>Результат 4</li>
                                                                        <li>Результат 5</li>
                                                                        <li>Результат 6</li>
                                                                        <li>Результат 7</li>
                                                                        <li>Результат 8</li>
                                                                        <li>Результат 9</li>
                                                                        <li>Результат 10</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div
                                                            class="custome-dropdown custome-dropdown--arrow --empty">
                                                            <input class="form-control"
                                                                   type="text"
                                                                   placeholder="Выберите город"/>
                                                            <div class="custome-dropdown-box">
                                                                <div
                                                                    class="custome-dropdown-overflow">
                                                                    <ul>
                                                                        <li>Результат 1</li>
                                                                        <li>Результат 2</li>
                                                                        <li>Результат 3</li>
                                                                        <li>Результат 4</li>
                                                                        <li>Результат 5</li>
                                                                        <li>Результат 6</li>
                                                                        <li>Результат 7</li>
                                                                        <li>Результат 8</li>
                                                                        <li>Результат 9</li>
                                                                        <li>Результат 10</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div
                                                            class="custome-dropdown custome-dropdown--arrow">
                                                            <input
                                                                class="form-control" type="text"
                                                                placeholder="Выберите отделение"/>
                                                            <div class="custome-dropdown-box">
                                                                <div
                                                                    class="custome-dropdown-overflow">
                                                                    <ul>
                                                                        <li>Результат 1</li>
                                                                        <li>Результат 2</li>
                                                                        <li>Результат 3</li>
                                                                        <li>Результат 4</li>
                                                                        <li>Результат 5</li>
                                                                        <li>Результат 6</li>
                                                                        <li>Результат 7</li>
                                                                        <li>Результат 8</li>
                                                                        <li>Результат 9</li>
                                                                        <li>Результат 10</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="total-action-value--customer js-value-customer">
                                    <div class="customer-content js-customer-content-1">
                                        <form action="#">
                                            <div class="form-group">
                                                <div class="select-custome">
                                                    <div class="select-custome-current"><span>Замовник</span>
                                                    </div>
                                                    <div class="select-custome-box">
                                                        <ul>
                                                            <li>Замовник 1</li>
                                                            <li>Замовник 2</li>
                                                            <li>Замовник 3</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="customer-content js-customer-content-2">
                                        <form action="#">
                                            <div class="form-group"><input class="form-control"
                                                                           type="text"
                                                                           placeholder="ФИО получателя">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="customer-content js-customer-content-3">
                                        <form action="#">
                                            <div class="form-group"><input class="form-control"
                                                                           type="text"
                                                                           placeholder="ФИО">
                                            </div>
                                            <div class="form-group"><input class="form-control"
                                                                           type="text"
                                                                           placeholder="ИНН">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3"><textarea
                                    class="total-action-value js-value-comment"
                                    placeholder="Текст Вашого коментаря"></textarea></div>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <button class="js-value-clear button button-outline-accent button-block"
                                type="button">
                            Скасувати
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
