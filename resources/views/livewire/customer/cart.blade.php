<x-app-layout body-classes="lk-cart">
    <div class="lk-page lk-cart">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    @livewire('widgets.cabinet.menu-widget', ['page_title' => 'Кошик'])
                </div>
                <div class="lk-page__main">
                    <div class="lk-page-cart">
                        <div class="lk-page-header">
                            <div class="lk-page-title">Кошик</div>
                        </div>
                        <div class="lk-table">
                            <div class="lk-table-header">
                                <div class="js-select-all custom-control custom-checkbox"><input
                                        class="custom-control-input select-all" id="select-all" type="checkbox"><label
                                        class="custom-control-label" for="select-all">Вибрати все</label></div>
                                <button class="js-clear-list-products button button-secondary" type="button">Очистити
                                    список
                                </button>
                            </div>
                            <div class="lk-table-body">
                                <table class="js-table lk-table-cart" data-show-toggle="true" data-toggle-column="last">
                                    <thead>
                                    <tr>
                                        <th>Товар</th>
                                        <th data-breakpoints="xs">Артикул</th>
                                        <th data-breakpoints="xs">Ціна</th>
                                        <th data-breakpoints="xs">Кількість</th>
                                        <th data-breakpoints="xs">Загальна сума</th>
                                        <th data-breakpoints="xs">Вага</th>
                                        <th data-breakpoints="xs"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="js-clear-box">
                                    <tr class="table-line">
                                        <td class="cell-product-td">
                                            <div class="cell-product">
                                                <div class="cell-checkbox">
                                                    <div class="custom-control custom-checkbox"><input
                                                            class="custom-control-input" type="checkbox"/><label
                                                            class="custom-control-label"></label></div>
                                                </div>
                                                <div class="cell-img"><img src="/assets/img/img-product.jpg"
                                                                           alt="product"/></div>
                                                <div class="cell-title"><a href="page-product.html">Єврошурупи з
                                                        потайною головкою для гіпсокортона</a></div>
                                            </div>
                                        </td>
                                        <td><span>5226654</span></td>
                                        <td><span class="cell-price">455 грн.</span></td>
                                        <td>
                                            <div class="jq-number input-col">
                                                <div class="jq-number__spin minus"></div>
                                                <div class="jq-number__field"><input class="input-col" type="number"
                                                                                     value="1" min="1"
                                                                                     onclick="this.select();"/></div>
                                                <div class="jq-number__spin plus"></div>
                                            </div>
                                        </td>
                                        <td><span class="cell-price">455 грн.</span></td>
                                        <td><span class="cell-weight">45 кг</span><span
                                                class="cell-size">0,3 к.м.</span></td>
                                        <td>
                                            <button class="js-remove-row cell-btn" type="button"><span
                                                    class="ico_trash"></span></button>
                                        </td>
                                    </tr>
                                    <tr class="table-line">
                                        <td class="cell-product-td">
                                            <div class="cell-product">
                                                <div class="cell-checkbox">
                                                    <div class="custom-control custom-checkbox"><input
                                                            class="custom-control-input" type="checkbox"/><label
                                                            class="custom-control-label"></label></div>
                                                </div>
                                                <div class="cell-img"><img src="/assets/img/img-product.jpg"
                                                                           alt="product"/></div>
                                                <div class="cell-title"><a href="page-product.html">Єврошурупи з
                                                        потайною головкою для гіпсокортона</a></div>
                                            </div>
                                        </td>
                                        <td><span>5226654</span></td>
                                        <td><span class="cell-price">455 грн.</span></td>
                                        <td>
                                            <div class="jq-number input-col">
                                                <div class="jq-number__spin minus"></div>
                                                <div class="jq-number__field"><input class="input-col" type="number"
                                                                                     value="1" min="1"
                                                                                     onclick="this.select();"/></div>
                                                <div class="jq-number__spin plus"></div>
                                            </div>
                                        </td>
                                        <td><span class="cell-price">455 грн.</span></td>
                                        <td><span class="cell-weight">45 кг</span><span
                                                class="cell-size">0,3 к.м.</span></td>
                                        <td>
                                            <button class="js-remove-row cell-btn" type="button"><span
                                                    class="ico_trash"></span></button>
                                        </td>
                                    </tr>
                                    <tr class="table-line">
                                        <td class="cell-product-td">
                                            <div class="cell-product">
                                                <div class="cell-checkbox">
                                                    <div class="custom-control custom-checkbox"><input
                                                            class="custom-control-input" type="checkbox"/><label
                                                            class="custom-control-label"></label></div>
                                                </div>
                                                <div class="cell-img"><img src="/assets/img/img-product.jpg"
                                                                           alt="product"/></div>
                                                <div class="cell-title"><a href="page-product.html">Єврошурупи з
                                                        потайною головкою для гіпсокортона</a></div>
                                            </div>
                                        </td>
                                        <td><span>5226654</span></td>
                                        <td><span class="cell-price">455 грн.</span></td>
                                        <td>
                                            <div class="jq-number input-col">
                                                <div class="jq-number__spin minus"></div>
                                                <div class="jq-number__field"><input class="input-col" type="number"
                                                                                     value="1" min="1"
                                                                                     onclick="this.select();"/></div>
                                                <div class="jq-number__spin plus"></div>
                                            </div>
                                        </td>
                                        <td><span class="cell-price">455 грн.</span></td>
                                        <td><span class="cell-weight">45 кг</span><span
                                                class="cell-size">0,3 к.м.</span></td>
                                        <td>
                                            <button class="js-remove-row cell-btn" type="button"><span
                                                    class="ico_trash"></span></button>
                                        </td>
                                    </tr>
                                    <tr class="table-line">
                                        <td class="cell-product-td">
                                            <div class="cell-product">
                                                <div class="cell-checkbox">
                                                    <div class="custom-control custom-checkbox"><input
                                                            class="custom-control-input" type="checkbox"/><label
                                                            class="custom-control-label"></label></div>
                                                </div>
                                                <div class="cell-img"><img src="/assets/img/img-product.jpg"
                                                                           alt="product"/></div>
                                                <div class="cell-title"><a href="page-product.html">Єврошурупи з
                                                        потайною головкою для гіпсокортона</a></div>
                                            </div>
                                        </td>
                                        <td><span>5226654</span></td>
                                        <td><span class="cell-price">455 грн.</span></td>
                                        <td>
                                            <div class="jq-number input-col">
                                                <div class="jq-number__spin minus"></div>
                                                <div class="jq-number__field"><input class="input-col" type="number"
                                                                                     value="1" min="1"
                                                                                     onclick="this.select();"/></div>
                                                <div class="jq-number__spin plus"></div>
                                            </div>
                                        </td>
                                        <td><span class="cell-price">455 грн.</span></td>
                                        <td><span class="cell-weight">45 кг</span><span
                                                class="cell-size">0,3 к.м.</span></td>
                                        <td>
                                            <button class="js-remove-row cell-btn" type="button"><span
                                                    class="ico_trash"></span></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="lk-table-bottom">
                                <div class="custom-control custom-checkbox"><input class="custom-control-input"
                                                                                   id="no-callback" type="checkbox"
                                                                                   checked><label
                                        class="custom-control-label" for="no-callback">Не передзвонюйте мені, я
                                        впевнений в замовленні</label></div>
                                <a class="button button-secondary" href="#modal-found-cheaper" data-toggle="modal">Знайшли
                                    дешевше?</a>
                            </div>
                            <div class="lk-table-footer">
                                <div class="lk-table-footer-left-row">
                                    <div class="lk-table-total">
                                        <div class="lk-table-total__item">
                                            <div class="lk-table-total__title">Загальна сума</div>
                                            <div class="lk-table-total__value"><span class="lk-table-total__sum">3 586 грн.</span>
                                            </div>
                                        </div>
                                        <div class="lk-table-total__item">
                                            <div class="lk-table-total__title"></div>
                                            <div class="lk-table-total__value"><span class="lk-table-total__col">42 товари</span><span
                                                    class="lk-table-total__weight">45 кг / 0,3 к.м.</span></div>
                                        </div>
                                        <div class="lk-table-total__item">
                                            <div class="lk-table-total__title">Орієнтовна дата доставки</div>
                                            <div class="lk-table-total__value"><span class="lk-table-total__date">08.12.2020</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lk-table-bonus">
                                        <div class="lk-table-bonus__title">Мої бонуси</div>
                                        <div class="lk-table-bonus__form">
                                            <form class="form-inline" action="#">
                                                <div class="form-group"><input class="form-control" type="number"
                                                                               value="2586"></div>
                                                <div class="form-group"><input class="button button-secondary"
                                                                               type="submit" value="Списати"></div>
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
                                                        <div class="select-custome-current"><span>Спосіб оплати</span>
                                                        </div>
                                                        <div class="select-custome-box">
                                                            <ul>
                                                                <li>Картой</li>
                                                                <li>Наложеный платеж</li>
                                                                <li>При получении</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-6 mb-4">
                                                    <div class="select-custome js-select-delivery">
                                                        <div class="select-custome-current"><span>Спосіб доставки</span>
                                                        </div>
                                                        <div class="select-custome-box">
                                                            <ul>
                                                                <li class="js-delivery-1">Самовывоз</li>
                                                                <li class="js-delivery-2">Доставка по городу</li>
                                                                <li class="js-delivery-3">Деливери</li>
                                                                <li class="js-delivery-4">САТ</li>
                                                                <li class="js-delivery-5">Новая почта</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-6 mb-4">
                                                    <div class="select-custome js-select-customer">
                                                        <div class="select-custome-current"><span>Конрагент</span></div>
                                                        <div class="select-custome-box">
                                                            <ul>
                                                                <li class="js-customer-1">Юр. лицо</li>
                                                                <li class="js-customer-2">Физ. лицо 1</li>
                                                                <li class="js-customer-3">Физ. лицо 2</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-6 mb-4">
                                                    <button class="js-add-comment button button-primary button-block"
                                                            type="button">Коментар
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 text-right">
                                            <button class="button button-secondary button-block" type="button">
                                                Підтвердити
                                            </button>
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
                                                                        <input class="form-control" type="text"
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
                                                                        <input class="form-control" type="text"
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
                                                                        <input class="form-control" type="text"
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
                                                                <div class="form-group"><textarea class="form-control"
                                                                                                  placeholder="Комментарий"></textarea>
                                                                </div>
                                                                <div class="form-group"><input
                                                                        class="js-datepicker form-control" type="text"
                                                                        placeholder="Дата отправки"></div>
                                                                <div class="form-group"><span>@lang('custom::site.delivery_amount')</span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="delivery-content js-delivery-content-3">
                                                            <form action="#">
                                                                <div class="form-group">
                                                                    <div
                                                                        class="custome-dropdown custome-dropdown--arrow --empty">
                                                                        <input class="form-control" type="text"
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
                                                                            class="form-control" type="text"
                                                                            placeholder="Ввведите адрес"></div>
                                                                    <div class="js-option2 group-option-item">
                                                                        <div
                                                                            class="custome-dropdown custome-dropdown--arrow">
                                                                            <input class="form-control" type="text"
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
                                                                                type="text" placeholder="Дата отправки">
                                                                        </div>
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
                                                                                type="text" placeholder="Дата отправки">
                                                                        </div>
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
                                                                                    value="option1" checked><span>Курьером</span></label>
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
                                                                                <input class="form-control" type="text"
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
                                                                                <input class="form-control" type="text"
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
                                                                                <input class="form-control" type="text"
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
                                                                                <input class="form-control" type="text"
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
                                                                                <input class="form-control" type="text"
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
                                                                                               placeholder="ФИО"></div>
                                                                <div class="form-group"><input class="form-control"
                                                                                               type="text"
                                                                                               placeholder="ИНН"></div>
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
                                                    type="button">Скасувати
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
