<x-app-layout body-classes="lk-receivables">
    <div class="lk-page lk-page-manager-receivables">
        <div class="container container-xl">
            <div class="lk-page__box">
                <div class="lk-page__sidebar">
                    <!-- Виджет меню -->
                    <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.receivables')"/>
                </div>
                <div class="lk-page__main">
                    <div class="lk-page-header">
                        <div class="lk-page-title">Дебіторська заборгованність</div>
                    </div>
                    <div class="lk-table">
                        <div class="lk-table-filter row row-small">
                            <div class="col-xl-2 col-md-4 mb-2">
                                <div class="custome-dropdown custome-dropdown--arrow"><input class="form-control"
                                                                                             type="text"
                                                                                             placeholder="Заказчик"/>
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
                            <div class="col-xl-2 col-md-4 mb-2"><select name="sort">
                                    <option value="Сортировка 1">Сортировка 1</option>
                                    <option value="Сортировка 2">Сортировка 2</option>
                                    <option value="Сортировка 3">Сортировка 3</option>
                                </select></div>
                            <div class="col-xl-2 col-md-4 mb-2">
                                <div class="custome-dropdown custome-dropdown-search"><input class="form-control"
                                                                                             type="text"
                                                                                             placeholder="Пошук"/>
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
                        <div class="lk-table-body">
                            <table class="js-table" data-paging="true" data-paging-container="#table-paging"
                                   data-paging-size="5" data-paging-position="right" data-show-toggle="true"
                                   data-toggle-column="last">
                                <thead>
                                <tr>
                                    <th>Начало просрочки</th>
                                    <th data-breakpoints="xs">Клиент</th>
                                    <th>Состояние баланса</th>
                                    <th>Сума</th>
                                    <th data-breakpoints="xs">В резерве</th>
                                    <th data-breakpoints="xs sm md">Ожидается</th>
                                    <th data-breakpoints="xs sm md">Итого</th>
                                    <th data-breakpoints="xs sm md">Новые заказы</th>
                                    <th data-breakpoints="xs"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="table-row">
                                    <td><span>от 05.11.2020</span></td>
                                    <td><strong class="cell-company">ТОВ Синергия</strong><span class="cell-phone">+38 (096) 000 0000</span>
                                    </td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><strong>1 959,10 грн.</strong></td>
                                    <td><a class="cell-btn" href="lk-customer-orders.html"><span
                                                class="ico_arrow-right"></span></a></td>
                                    <td>
                                        <div class="action-group">
                                            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                            <div class="action-group-drop">
                                                <ul class="action-group-list">
                                                    <li><a href="lk-customer-order.html"><span class="ico_edit"></span></a>
                                                    </li>
                                                    <li>
                                                        <button class="js-del" type="button" title="Видалити"><span
                                                                class="ico_delete"></span></button>
                                                    </li>
                                                    <li>
                                                        <button class="js-hide-drop" type="button"><span
                                                                class="ico_close"></span></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td><span>от 05.11.2020</span></td>
                                    <td><strong class="cell-company">ТОВ Синергия</strong><span class="cell-phone">+38 (096) 000 0000</span>
                                    </td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><strong>1 959,10 грн.</strong></td>
                                    <td><a class="cell-btn" href="lk-customer-orders.html"><span
                                                class="ico_arrow-right"></span></a></td>
                                    <td>
                                        <div class="action-group">
                                            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                            <div class="action-group-drop">
                                                <ul class="action-group-list">
                                                    <li><a href="lk-customer-order.html"><span class="ico_edit"></span></a>
                                                    </li>
                                                    <li>
                                                        <button class="js-del" type="button" title="Видалити"><span
                                                                class="ico_delete"></span></button>
                                                    </li>
                                                    <li>
                                                        <button class="js-hide-drop" type="button"><span
                                                                class="ico_close"></span></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td><span>от 05.11.2020</span></td>
                                    <td><strong class="cell-company">ТОВ Синергия</strong><span class="cell-phone">+38 (096) 000 0000</span>
                                    </td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><strong>1 959,10 грн.</strong></td>
                                    <td><a class="cell-btn" href="lk-customer-orders.html"><span
                                                class="ico_arrow-right"></span></a></td>
                                    <td>
                                        <div class="action-group">
                                            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                            <div class="action-group-drop">
                                                <ul class="action-group-list">
                                                    <li><a href="lk-customer-order.html"><span class="ico_edit"></span></a>
                                                    </li>
                                                    <li>
                                                        <button class="js-del" type="button" title="Видалити"><span
                                                                class="ico_delete"></span></button>
                                                    </li>
                                                    <li>
                                                        <button class="js-hide-drop" type="button"><span
                                                                class="ico_close"></span></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td><span>от 05.11.2020</span></td>
                                    <td><strong class="cell-company">ТОВ Синергия</strong><span class="cell-phone">+38 (096) 000 0000</span>
                                    </td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><strong class="cell-price accent">1 959,10 грн.</strong></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><strong>1 959,10 грн.</strong></td>
                                    <td><a class="cell-btn" href="lk-customer-orders.html"><span
                                                class="ico_arrow-right"></span></a></td>
                                    <td>
                                        <div class="action-group">
                                            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                            <div class="action-group-drop">
                                                <ul class="action-group-list">
                                                    <li><a href="lk-customer-order.html"><span class="ico_edit"></span></a>
                                                    </li>
                                                    <li>
                                                        <button class="js-del" type="button" title="Видалити"><span
                                                                class="ico_delete"></span></button>
                                                    </li>
                                                    <li>
                                                        <button class="js-hide-drop" type="button"><span
                                                                class="ico_close"></span></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td><span>от 05.11.2020</span></td>
                                    <td><strong class="cell-company">ТОВ Синергия</strong><span class="cell-phone">+38 (096) 000 0000</span>
                                    </td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><strong>1 959,10 грн.</strong></td>
                                    <td><a class="cell-btn" href="lk-customer-orders.html"><span
                                                class="ico_arrow-right"></span></a></td>
                                    <td>
                                        <div class="action-group">
                                            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                            <div class="action-group-drop">
                                                <ul class="action-group-list">
                                                    <li><a href="lk-customer-order.html"><span class="ico_edit"></span></a>
                                                    </li>
                                                    <li>
                                                        <button class="js-del" type="button" title="Видалити"><span
                                                                class="ico_delete"></span></button>
                                                    </li>
                                                    <li>
                                                        <button class="js-hide-drop" type="button"><span
                                                                class="ico_close"></span></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td><span>от 05.11.2020</span></td>
                                    <td><strong class="cell-company">ТОВ Синергия</strong><span class="cell-phone">+38 (096) 000 0000</span>
                                    </td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><strong>1 959,10 грн.</strong></td>
                                    <td><a class="cell-btn" href="lk-customer-orders.html"><span
                                                class="ico_arrow-right"></span></a></td>
                                    <td>
                                        <div class="action-group">
                                            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                            <div class="action-group-drop">
                                                <ul class="action-group-list">
                                                    <li><a href="lk-customer-order.html"><span class="ico_edit"></span></a>
                                                    </li>
                                                    <li>
                                                        <button class="js-del" type="button" title="Видалити"><span
                                                                class="ico_delete"></span></button>
                                                    </li>
                                                    <li>
                                                        <button class="js-hide-drop" type="button"><span
                                                                class="ico_close"></span></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td><span>от 05.11.2020</span></td>
                                    <td><strong class="cell-company">ТОВ Синергия</strong><span class="cell-phone">+38 (096) 000 0000</span>
                                    </td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><strong>1 959,10 грн.</strong></td>
                                    <td><a class="cell-btn" href="lk-customer-orders.html"><span
                                                class="ico_arrow-right"></span></a></td>
                                    <td>
                                        <div class="action-group">
                                            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                            <div class="action-group-drop">
                                                <ul class="action-group-list">
                                                    <li><a href="lk-customer-order.html"><span class="ico_edit"></span></a>
                                                    </li>
                                                    <li>
                                                        <button class="js-del" type="button" title="Видалити"><span
                                                                class="ico_delete"></span></button>
                                                    </li>
                                                    <li>
                                                        <button class="js-hide-drop" type="button"><span
                                                                class="ico_close"></span></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td><span>от 05.11.2020</span></td>
                                    <td><strong class="cell-company">ТОВ Синергия</strong><span class="cell-phone">+38 (096) 000 0000</span>
                                    </td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><strong>1 959,10 грн.</strong></td>
                                    <td><a class="cell-btn" href="lk-customer-orders.html"><span
                                                class="ico_arrow-right"></span></a></td>
                                    <td>
                                        <div class="action-group">
                                            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                            <div class="action-group-drop">
                                                <ul class="action-group-list">
                                                    <li><a href="lk-customer-order.html"><span class="ico_edit"></span></a>
                                                    </li>
                                                    <li>
                                                        <button class="js-del" type="button" title="Видалити"><span
                                                                class="ico_delete"></span></button>
                                                    </li>
                                                    <li>
                                                        <button class="js-hide-drop" type="button"><span
                                                                class="ico_close"></span></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td><span>от 05.11.2020</span></td>
                                    <td><strong class="cell-company">ТОВ Синергия</strong><span class="cell-phone">+38 (096) 000 0000</span>
                                    </td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><strong>1 959,10 грн.</strong></td>
                                    <td><a class="cell-btn" href="lk-customer-orders.html"><span
                                                class="ico_arrow-right"></span></a></td>
                                    <td>
                                        <div class="action-group">
                                            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                            <div class="action-group-drop">
                                                <ul class="action-group-list">
                                                    <li><a href="lk-customer-order.html"><span class="ico_edit"></span></a>
                                                    </li>
                                                    <li>
                                                        <button class="js-del" type="button" title="Видалити"><span
                                                                class="ico_delete"></span></button>
                                                    </li>
                                                    <li>
                                                        <button class="js-hide-drop" type="button"><span
                                                                class="ico_close"></span></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-row">
                                    <td><span>от 05.11.2020</span></td>
                                    <td><strong class="cell-company">ТОВ Синергия</strong><span class="cell-phone">+38 (096) 000 0000</span>
                                    </td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><strong class="cell-price">1 959,10 грн.</strong></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><span>1 959,10 грн.</span></td>
                                    <td><strong>1 959,10 грн.</strong></td>
                                    <td><a class="cell-btn" href="lk-customer-orders.html"><span
                                                class="ico_arrow-right"></span></a></td>
                                    <td>
                                        <div class="action-group">
                                            <div class="action-group-btn"><span class="ico_submenu"></span></div>
                                            <div class="action-group-drop">
                                                <ul class="action-group-list">
                                                    <li><a href="lk-customer-order.html"><span class="ico_edit"></span></a>
                                                    </li>
                                                    <li>
                                                        <button class="js-del" type="button" title="Видалити"><span
                                                                class="ico_delete"></span></button>
                                                    </li>
                                                    <li>
                                                        <button class="js-hide-drop" type="button"><span
                                                                class="ico_close"></span></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="lk-table-footer">
                            <div>
                                <div class="custome-dropdown lk-table-select custome-dropdown--arrow"><input
                                        class="form-control" type="text" placeholder="Фільтр замовник"/>
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
                            <div class="lk-table-navigation"><span>Показати на сторінці:</span>
                                <div class="select-custome js-page-size">
                                    <div class="select-custome-current"><span>10</span></div>
                                    <div class="select-custome-box">
                                        <ul>
                                            <li data-page-size="10">10</li>
                                            <li data-page-size="20">20</li>
                                            <li data-page-size="30">30</li>
                                            <li data-page-size="40">40</li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="table-paging"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
