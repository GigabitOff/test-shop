<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])

          <h4 class="text-center text-lg-start">Спецобувь с нескользящей подошве от Portwest</h4>
          <div class="row g-4">
            <div class="col-lg-6"><input class="form-control" type="text" placeholder="Наименование" value="Спецобувь с нескользящей подошве от Portwest"></div>
            <div class="col-lg-3 col-md-6"><input class="js-date form-control" type="text" placeholder="Дата начала"></div>
            <div class="col-lg-3 col-md-6"><input class="js-date form-control" type="text" placeholder="Дата окончания"></div>
            <div class="col-lg-6">
              <div class="drop --select"><span class="drop-clear"></span><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="Типа бонуса"><button class="form-control drop-button" type="button">Типа бонуса</button>
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">Персональное предложение</li>
                      <li class="drop-list-item">Определенный товар</li>
                      <li class="drop-list-item">Процент от суммы продажи</li>
                      <li class="drop-list-item">Бонус от конкретной суммы</li>
                      <li class="drop-list-item">Покупка опред. кол-ва товаров</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6"><input class="form-control" type="text" placeholder="Сумма для покупки"></div>
            <div class="col-lg-3 col-md-6"><input class="form-control" type="text" placeholder="Кол-во бонусов для пользователя"></div>
            <div class="col-12">
              <div class="drop --select --select"><span class="drop-clear"></span><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="Группа пользователей"><button class="form-control drop-button" type="button">Группа пользователей</button>
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">Группа пользователей 1</li>
                      <li class="drop-list-item">Группа пользователей 2</li>
                      <li class="drop-list-item">Группа пользователей 3</li>
                      <li class="drop-list-item">Группа пользователей 4</li>
                      <li class="drop-list-item">Группа пользователей 5</li>
                      <li class="drop-list-item">Группа пользователей 6</li>
                      <li class="drop-list-item">Группа пользователей 7</li>
                      <li class="drop-list-item">Группа пользователей 8</li>
                      <li class="drop-list-item">Группа пользователей 9</li>
                      <li class="drop-list-item">Группа пользователей 10</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="search --old-search mb-0 @if($search != "") is-active @endif">
                <div class="search__body">
                  <div class="search__label"><span class="ico_plus"></span></div>
                  <div class="search__controls">
                    <input type="text"  wire:model="search"  placeholder="Выбор пользователей">
                    <div class="search__result">
                      <ul class="result-list">
                        <li>
                          <div class="result-item">
                            <div class="result-item__title">2900696</div>
                            <div class="result-item__del"><span class="ico_close"></span></div>
                          </div>
                        </li>
                        <li>
                          <div class="result-item">
                            <div class="result-item__title">2900696</div>
                            <div class="result-item__del"><span class="ico_close"></span></div>
                          </div>
                        </li>
                      </ul>
                      <div class="result-clear">Отменить все</div>
                    </div>
                  </div>
                  <div class="search__drop @if($search != "")is-show @endif">
                    <div class="search__items">
                      <table class="js-table footable footable-1 footable-paging footable-paging-right breakpoint-lg" style="">
                        <thead class="d-none">
                          <tr class="footable-header">

                          <td class="footable-first-visible" style="display: table-cell;">Название</td><td data-breakpoints="xs" style="display: table-cell;">Производитель</td><td data-breakpoints="xs" style="display: table-cell;">Статус</td><td data-breakpoints="xs" style="display: table-cell;">Артикул</td><td data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Price')</td><td data-breakpoints="xs" class="footable-last-visible" style="display: table-cell;"></td></tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="button button-accent button-small button-icon ico_plus"></button></td></tr><tr>
                          <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="button button-accent button-small button-icon ico_plus"></button></td></tr><tr>
                          <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="button button-accent button-small button-icon ico_plus"></button></td></tr><tr>
                          <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="button button-accent button-small button-icon ico_plus"></button></td></tr><tr>
                          <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="button button-accent button-small button-icon ico_plus"></button></td></tr></tbody>
                      <tfoot></tfoot></table>
                    </div>
                    <div class="search__btn"><button class="button" type="button">Додати</button></div>
                  </div>
                </div>
              </div>
              <div class="search__overlay @if($search != "")is-show @endif"></div>
            </div>
            <div class="col-12">
              <div class="search --old-search mb-0">
                <div class="search__body">
                  <div class="search__label"><span class="ico_plus"></span></div>
                  <div class="search__controls"><input type="text" placeholder="Выбор товаров">
                    <div class="search__result">
                      <ul class="result-list">
                        <li>
                          <div class="result-item">
                            <div class="result-item__title">2900696</div>
                            <div class="result-item__del"><span class="ico_close"></span></div>
                          </div>
                        </li>
                        <li>
                          <div class="result-item">
                            <div class="result-item__title">2900696</div>
                            <div class="result-item__del"><span class="ico_close"></span></div>
                          </div>
                        </li>
                      </ul>
                      <div class="result-clear">Отменить все</div>
                    </div>
                  </div>
                  <div class="search__drop">
                    <div class="search__items">
                      <table class="js-table footable footable-2 footable-paging footable-paging-right breakpoint-lg" style="">
                        <thead class="d-none">
                          <tr class="footable-header">
                          <td class="footable-first-visible" style="display: table-cell;">Название</td><td data-breakpoints="xs" style="display: table-cell;">Производитель</td><td data-breakpoints="xs" style="display: table-cell;">Статус</td><td data-breakpoints="xs" style="display: table-cell;">Артикул</td><td data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Price')</td><td data-breakpoints="xs" class="footable-last-visible" style="display: table-cell;"></td></tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="button button-accent button-small button-icon ico_plus"></button></td></tr><tr>






                          <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="button button-accent button-small button-icon ico_plus"></button></td></tr><tr>






                          <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="button button-accent button-small button-icon ico_plus"></button></td></tr><tr>






                          <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="button button-accent button-small button-icon ico_plus"></button></td></tr><tr>






                          <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="button button-accent button-small button-icon ico_plus"></button></td></tr></tbody>
                      <tfoot></tfoot></table>
                    </div>
                    <div class="search__btn"><button class="button" type="button">Додати</button></div>
                  </div>
                </div>
              </div>
              <div class="search__overlay"></div>
              <div class="table-before-btn --small --no-collapse">
                <div>
                  <div class="action-group mt-3">
                    <div class="action-group-btn"><span class="ico_submenu"></span></div>
                    <div class="action-group-drop">
                      <ul class="action-group-list">
                        <li><button class="ico_menu2" type="button" data-bs-target="#m-bonus-col" data-bs-toggle="modal"></button></li>
                        <li><button class="ico_trash" type="button"></button></li>
                        <li><button class="js-hide-drop ico_close" type="button"></button></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <table class="js-table table-td-small footable footable-3 footable-paging footable-paging-right breakpoint-lg" data-paging-size="6" data-paging-container="#table-nav-3" style="">
                <thead>
                  <tr class="footable-header">





                  <th class="footable-first-visible" style="display: table-cell;">
                      <div class="d-flex align-items-center"><label class="check js-select-all"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Артикул</span></div>
                    </th><th class="w-100" data-breakpoints="xs" style="display: table-cell;">Наименование</th><th class="text-sm-center" data-breakpoints="xs" style="display: table-cell;">Код товара</th><th class="text-sm-center" data-breakpoints="xs" style="display: table-cell;">Кол-во товаров</th><th class="text-sm-center text-end w-1 footable-last-visible" data-breakpoints="xs" style="display: table-cell;"></th></tr>
                </thead>
                <tbody>












                <tr>





                  <td class="footable-first-visible" style="display: table-cell;">
                      <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a class="accent nowrap nowrap-sm" href="page-catalog-inner.html">№ 3267264-43</a></div>
                    </td><td style="display: table-cell;"><a href="page-catalog-inner.html">Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</a></td><td class="text-sm-center" style="display: table-cell;"><span>81478329</span></td><td class="text-sm-center" style="display: table-cell;"><input class="form-control text-center form-xs" type="number" placeholder="Кол-во товаров" value="3" onclick="this.select();"></td><td class="text-end text-sm-center w-1 footable-last-visible" style="display: table-cell;"><button class="button button-small button-icon ico_trash" type="button"></button></td></tr><tr>





                  <td class="footable-first-visible" style="display: table-cell;">
                      <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a class="accent nowrap nowrap-sm" href="page-catalog-inner.html">№ 3267264-43</a></div>
                    </td><td style="display: table-cell;"><a href="page-catalog-inner.html">Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</a></td><td class="text-sm-center" style="display: table-cell;"><span>81478329</span></td><td class="text-sm-center" style="display: table-cell;"><input class="form-control text-center form-xs" type="number" placeholder="Кол-во товаров" value="3" onclick="this.select();"></td><td class="text-end text-sm-center w-1 footable-last-visible" style="display: table-cell;"><button class="button button-small button-icon ico_trash" type="button"></button></td></tr><tr>





                  <td class="footable-first-visible" style="display: table-cell;">
                      <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a class="accent nowrap nowrap-sm" href="page-catalog-inner.html">№ 3267264-43</a></div>
                    </td><td style="display: table-cell;"><a href="page-catalog-inner.html">Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</a></td><td class="text-sm-center" style="display: table-cell;"><span>81478329</span></td><td class="text-sm-center" style="display: table-cell;"><input class="form-control text-center form-xs" type="number" placeholder="Кол-во товаров" value="3" onclick="this.select();"></td><td class="text-end text-sm-center w-1 footable-last-visible" style="display: table-cell;"><button class="button button-small button-icon ico_trash" type="button"></button></td></tr><tr>





                  <td class="footable-first-visible" style="display: table-cell;">
                      <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a class="accent nowrap nowrap-sm" href="page-catalog-inner.html">№ 3267264-43</a></div>
                    </td><td style="display: table-cell;"><a href="page-catalog-inner.html">Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</a></td><td class="text-sm-center" style="display: table-cell;"><span>81478329</span></td><td class="text-sm-center" style="display: table-cell;"><input class="form-control text-center form-xs" type="number" placeholder="Кол-во товаров" value="3" onclick="this.select();"></td><td class="text-end text-sm-center w-1 footable-last-visible" style="display: table-cell;"><button class="button button-small button-icon ico_trash" type="button"></button></td></tr><tr>





                  <td class="footable-first-visible" style="display: table-cell;">
                      <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a class="accent nowrap nowrap-sm" href="page-catalog-inner.html">№ 3267264-43</a></div>
                    </td><td style="display: table-cell;"><a href="page-catalog-inner.html">Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</a></td><td class="text-sm-center" style="display: table-cell;"><span>81478329</span></td><td class="text-sm-center" style="display: table-cell;"><input class="form-control text-center form-xs" type="number" placeholder="Кол-во товаров" value="3" onclick="this.select();"></td><td class="text-end text-sm-center w-1 footable-last-visible" style="display: table-cell;"><button class="button button-small button-icon ico_trash" type="button"></button></td></tr><tr>





                  <td class="footable-first-visible" style="display: table-cell;">
                      <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a class="accent nowrap nowrap-sm" href="page-catalog-inner.html">№ 3267264-43</a></div>
                    </td><td style="display: table-cell;"><a href="page-catalog-inner.html">Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</a></td><td class="text-sm-center" style="display: table-cell;"><span>81478329</span></td><td class="text-sm-center" style="display: table-cell;"><input class="form-control text-center form-xs" type="number" placeholder="Кол-во товаров" value="3" onclick="this.select();"></td><td class="text-end text-sm-center w-1 footable-last-visible" style="display: table-cell;"><button class="button button-small button-icon ico_trash" type="button"></button></td></tr></tbody>
              </table>
              <div class="page-bottom-group">
                <div>
                  <div class="form-group"><label class="check eye"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span class="ms-2">Активно</span></div>
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
                    <div id="table-nav-3" class="footable-paging-external footable-paging-right"><div class="footable-pagination-wrapper"><ul class="pagination"><li class="footable-page-nav disabled" data-page="first"><a class="footable-page-link" href="#">«</a></li><li class="footable-page-nav disabled" data-page="prev"><a class="footable-page-link" href="#">‹</a></li><li class="footable-page visible active" data-page="1"><a class="footable-page-link" href="#">1</a></li><li class="footable-page visible" data-page="2"><a class="footable-page-link" href="#">2</a></li><li class="footable-page-nav" data-page="next"><a class="footable-page-link" href="#">›</a></li><li class="footable-page-nav" data-page="last"><a class="footable-page-link" href="#">»</a></li></ul><div class="divider"></div><span class="label label-default">1 / 2</span></div></div>
                  </div>
                </div>
              </div>
              <div class="page-save"><button class="button" type="button">Сохранить</button></div>
            </div>
          </div>

</div>
