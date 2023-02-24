    <h6 class="mb-3">@lang('custom::admin.products.warehouses_stock_control')</h6>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-text">
                <span>@lang('custom::admin.products.Barcode')</span>
            </div>
            <input class="form-control" type="text"
                   wire:model.lazy="data.barcode"
                   placeholder="@lang('custom::admin.products.Barcode')">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-text">
                <span>@lang('custom::admin.products.stock')</span>
            </div>
            <input class="form-control" type="text"
                   wire:model.lazy="data.stock"
                   placeholder="@lang('custom::admin.products.stock')">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-text">
                <span>@lang('custom::admin.products.in_reserve_product_quantity')</span>
            </div>
            <input class="form-control" type="text"
                   wire:model.lazy="data.reserve"
                   placeholder="@lang('custom::admin.products.in_reserve_product_quantity')">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-text">
                <span>@lang('custom::admin.products.reserve_time'), {{mb_strtolower(__('custom::admin.minutes'))}}</span>
            </div>
            <input class="form-control" type="number"
                   wire:model.lazy="data.reserve_minutes"
                   placeholder="@lang('custom::admin.products.reserve_time')">
        </div>
    </div>
    <fieldset class="form-group">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="check --radio">
                    <input class="check__input"
                           name="on_backorder"
                           wire:model.lazy="data.on_backorder"
                           value="1"
                           type="radio" />
                    <span class="check__box"></span>
                    <span class="check__txt">@lang('custom::admin.products.on_backorder')</span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="check --radio">
                    <input class="check__input"
                           name="on_backorder"
                           wire:model.lazy="data.on_backorder"
                           value="0"
                           type="radio" />
                    <span class="check__box"></span>
                    <span class="check__txt">@lang('custom::admin.products.on_stock')</span>
                </label>
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="check --radio">
                    <input class="check__input"
                           name="show_stock"
                           wire:model.lazy="data.show_stock"
                           value="1"
                           @if($data['on_backorder']) disabled @endif
                           type="radio" />
                    <span class="check__box"></span>
                    <span class="check__txt">@lang('custom::admin.products.show_stock')</span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="check --radio check-drop">
                    <input class="check__input"
                           name="show_stock"
                           wire:model.lazy="data.show_stock"
                           value="0"
                           @if($data['on_backorder']) disabled @endif
                           type="radio" />
                    <span class="check__box"></span>
                    <span class="check__txt">@lang('custom::admin.products.show_availability')</span>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-text">@lang('custom::admin.products.Product availability')</span>
            @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['availability']) ? $select_data['availability']: null),
                        'select_data_array'=>\App\Models\Product::AVAILABILITY_TYPES, 'placeholder'=>__('custom::admin.products.Product availability'),
                        'index'=>'availability',
                        'hide_clear' =>true,
                        'index_leng_admin_key' =>'admin',
                        ])

        </div>
    </div>

{{--    <h6 class="mb-3">Информация по складам</h6>--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm-3">--}}
{{--            <div class="form-group">--}}
{{--                <div class="drop --arrow"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Сортировка" />--}}
{{--                    <div class="drop-box">--}}
{{--                        <div class="drop-overflow">--}}
{{--                            <ul class="drop-list">--}}
{{--                                <li class="drop-list-item">Сортировка 1</li>--}}
{{--                                <li class="drop-list-item">Сортировка 2</li>--}}
{{--                                <li class="drop-list-item">Сортировка 3</li>--}}
{{--                                <li class="drop-list-item">Сортировка 4</li>--}}
{{--                                <li class="drop-list-item">Сортировка 5</li>--}}
{{--                                <li class="drop-list-item">Сортировка 6</li>--}}
{{--                                <li class="drop-list-item">Сортировка 7</li>--}}
{{--                                <li class="drop-list-item">Сортировка 8</li>--}}
{{--                                <li class="drop-list-item">Сортировка 9</li>--}}
{{--                                <li class="drop-list-item">Сортировка 10</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="table-before-btn --small --characteristics">--}}
{{--        <div>--}}
{{--            <div class="action-group">--}}
{{--                <div class="action-group-btn"><span class="ico_submenu"></span></div>--}}
{{--                <div class="action-group-drop">--}}
{{--                    <ul class="action-group-list">--}}
{{--                        <li><a class="ico_plus" href="#m-add-storage" data-bs-toggle="modal"></a></li>--}}
{{--                        <li><button class="ico_trash" type="button"></button></li>--}}
{{--                        <li><button class="js-hide-drop ico_close" type="button"></button></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <table class="js-table table-td-small" data-paging-size="5" data-paging-container="#table-nav-4">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th class="w-50">--}}
{{--                <div class="d-flex align-items-center"><label class="check js-select-all"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Склад</span></div>--}}
{{--            </th>--}}
{{--            <th class="w-1" data-breakpoints="xs">Филиал</th>--}}
{{--            <th class="w-1" data-breakpoints="xs">Кол-во</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название Склада. Киев, ул. Евгения Коновальца, 36</span></div>--}}
{{--            </td>--}}
{{--            <td>Название филиала</td>--}}
{{--            <td class="text-center"><input class="form-control form-md" type="number" placeholder="Кол-во" value="69" onclick="this.select();"></td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <div class="page-bottom-group">--}}
{{--        <div></div>--}}
{{--        <div>--}}
{{--            <div class="table-nav">--}}
{{--                <div class="drop --arrow js-page-size"><button class="form-control drop-button" type="button">10</button>--}}
{{--                    <div class="drop-box">--}}
{{--                        <div class="drop-overflow">--}}
{{--                            <ul class="drop-list">--}}
{{--                                <li class="drop-list-item" data-page-size="10">10</li>--}}
{{--                                <li class="drop-list-item" data-page-size="20">20</li>--}}
{{--                                <li class="drop-list-item" data-page-size="30">30</li>--}}
{{--                                <li class="drop-list-item" data-page-size="40">40</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div id="table-nav-4"></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
