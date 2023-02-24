<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.'.$nameLive.'.index'])

          <h4 class="text-center text-xl-start">Название маркетингового предложения</h4>
          <div class="row g-4 mb-4">
            <div class="col-xl-6 col-12"><input class="form-control" type="text" placeholder="Название маркетингового предложения"></div>
            <div class="col-xl-2 col-md-4"><input class="js-date form-control" type="text" placeholder="Действует От"></div>
            <div class="col-xl-2 col-md-4"><input class="js-date form-control" type="text" placeholder="Действует До"></div>
            <div class="col-xl-2 col-md-4">
              <div class="drop --select --select"><span class="drop-clear"></span><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="Приоритет"><button class="form-control drop-button" type="button">Приоритет</button>
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">Приоритет 1</li>
                      <li class="drop-list-item">Приоритет 2</li>
                      <li class="drop-list-item">Приоритет 3</li>
                      <li class="drop-list-item">Приоритет 4</li>
                      <li class="drop-list-item">Приоритет 5</li>
                      <li class="drop-list-item">Приоритет 6</li>
                      <li class="drop-list-item">Приоритет 7</li>
                      <li class="drop-list-item">Приоритет 8</li>
                      <li class="drop-list-item">Приоритет 9</li>
                      <li class="drop-list-item">Приоритет 10</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#counterparty" type="button" role="tab" aria-selected="true">Контрагент</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#group-a-conditions" type="button" role="tab" aria-selected="false" tabindex="-1">Условия группы А</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#group-b-conditions" type="button" role="tab" aria-selected="false" tabindex="-1">Условия группы Б</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#action" type="button" role="tab" aria-selected="false" tabindex="-1">Действие</button></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="counterparty" role="tabpanel">
              <div class="container-medium">
                <form action="#!">
                  <div class="row g-4">
                    <div class="col-12">
                      <div class="search --old-searchm-0 @if($search != "")mb-0 is-active @endif">
                        <div class="search__body">
                          <div class="search__label"><span class="ico_plus"></span></div>
                          <div class="search__controls"><div class="tagger">
                            <input class="js-tags"  type="hidden" placeholder="Контрагент" hidden="hidden"><ul><li class="tagger-new">
                                <input  wire:model="search" placeholder="Контрагент">
                                <div class="tagger-completion"></div></li></ul></div>
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
                              <table class="js-table footable footable-1 footable-paging footable-paging-right breakpoint-lg" data-paging-container="#table-nav-1" style="">
                                <thead class="d-none">
                                  <tr class="footable-header">

                                  <td class="footable-first-visible" style="display: table-cell;">Название</td><td data-breakpoints="xs" style="display: table-cell;">Производитель</td><td data-breakpoints="xs" style="display: table-cell;">Статус</td><td data-breakpoints="xs" style="display: table-cell;">Артикул</td><td data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Price')</td><td data-breakpoints="xs" class="footable-last-visible" style="display: table-cell;"></td></tr>
                                </thead>
                                <tbody>

                                <tr>

                                  <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="js-change button button-accent button-small button-icon ico_plus"></button></td></tr><tr>

                                  <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="js-change button button-accent button-small button-icon ico_plus"></button></td></tr><tr>

                                  <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="js-change button button-accent button-small button-icon ico_plus"></button></td></tr><tr>

                                  <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="js-change button button-accent button-small button-icon ico_plus"></button></td></tr><tr>

                                  <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="js-change button button-accent button-small button-icon ico_plus"></button></td></tr><tr>

                                  <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="js-change button button-accent button-small button-icon ico_plus"></button></td></tr></tbody>
                              </table>
                            </div>
                            <div class="search__btn">
                              <div></div>
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
                                  <div id="table-nav-1" class="footable-paging-external footable-paging-right"><div class="footable-pagination-wrapper"><ul class="pagination"><li class="footable-page-nav disabled" data-page="first"><a class="footable-page-link" href="#">«</a></li><li class="footable-page-nav disabled" data-page="prev"><a class="footable-page-link" href="#">‹</a></li><li class="footable-page visible active" data-page="1"><a class="footable-page-link" href="#">1</a></li><li class="footable-page visible" data-page="2"><a class="footable-page-link" href="#">2</a></li><li class="footable-page-nav" data-page="next"><a class="footable-page-link" href="#">›</a></li><li class="footable-page-nav" data-page="last"><a class="footable-page-link" href="#">»</a></li></ul><div class="divider"></div><span class="label label-default">1 / 2</span></div><div class="footable-pagination-wrapper"><ul class="pagination"><li class="footable-page-nav disabled" data-page="first"><a class="footable-page-link" href="#">«</a></li><li class="footable-page-nav disabled" data-page="prev"><a class="footable-page-link" href="#">‹</a></li><li class="footable-page visible active" data-page="1"><a class="footable-page-link" href="#">1</a></li><li class="footable-page visible" data-page="2"><a class="footable-page-link" href="#">2</a></li><li class="footable-page-nav" data-page="next"><a class="footable-page-link" href="#">›</a></li><li class="footable-page-nav" data-page="last"><a class="footable-page-link" href="#">»</a></li></ul><div class="divider"></div><span class="label label-default">1 / 2</span></div></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="search__overlay  @if($search != "")is-show @endif"></div>
                    </div>
                    <div class="col-12">
                      <div class="search --old-searchm-0">
                        <div class="search__body">
                          <div class="search__label"><span class="ico_plus"></span></div>
                          <div class="search__controls"><div class="tagger"><input class="js-tags" type="hidden" placeholder="Поиск по ID или Ф.И.О." hidden="hidden"><ul><li class="tagger-new"><input placeholder="Поиск по ID или Ф.И.О."><div class="tagger-completion"></div></li></ul></div>
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
                              <table class="js-table footable footable-2 footable-paging footable-paging-right breakpoint-lg" data-paging-container="#table-nav-1" style="">
                                <thead class="d-none">
                                  <tr class="footable-header">






                                  <td class="footable-first-visible" style="display: table-cell;">Название</td><td data-breakpoints="xs" style="display: table-cell;">Производитель</td><td data-breakpoints="xs" style="display: table-cell;">Статус</td><td data-breakpoints="xs" style="display: table-cell;">Артикул</td><td data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Price')</td><td data-breakpoints="xs" class="footable-last-visible" style="display: table-cell;"></td></tr>
                                </thead>
                                <tbody>










                                <tr>






                                  <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="js-change button button-accent button-small button-icon ico_plus"></button></td></tr><tr>






                                  <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="js-change button button-accent button-small button-icon ico_plus"></button></td></tr><tr>






                                  <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="js-change button button-accent button-small button-icon ico_plus"></button></td></tr><tr>






                                  <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="js-change button button-accent button-small button-icon ico_plus"></button></td></tr><tr>






                                  <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="js-change button button-accent button-small button-icon ico_plus"></button></td></tr><tr>






                                  <td class="footable-first-visible" style="display: table-cell;"><span>Сабо с регулируемым ремешком на липучке CARINNE OB A SRC</span></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Производитель</span><span>Safety Jogger</span></td><td style="display: table-cell;"><button class="button-status status-1"><span class="circle"></span><span>В наличии</span></button></td><td style="display: table-cell;"><span class="title d-none d-sm-block">Артикул</span><a class="accent" href="#!">№ 3267264-43</a></td><td style="display: table-cell;"><strong>690 грн</strong></td><td class="footable-last-visible" style="display: table-cell;"><button class="js-change button button-accent button-small button-icon ico_plus"></button></td></tr></tbody>
                              </table>
                            </div>
                            <div class="search__btn">
                              <div></div>
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
                                  <div id="table-nav-1"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="search__overlay"></div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="tab-pane fade" id="group-a-conditions" role="tabpanel">
              <div class="container-medium">
                <div class="drop --select drop-select"><span class="drop-clear"></span><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="Тип условия"><button class="form-control drop-button" type="button">Тип условия</button>
                  <div class="drop-box">
                    <div class="drop-overflow">
                      <ul class="drop-list">
                        <li class="drop-list-item">Товар из товарной группы А + Бренд F + кол-во</li>
                        <li class="drop-list-item">Товар из товарной группы А + Бренд F c ценой (&lt;,&gt;, &lt;&gt;) грн</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="drop-list-result">
                  <div class="drop-list-result-item">
                    <form action="#!">
                      <div class="form-group">
                        <div class="drop --search"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Выбор товарной группы (поиск по ID или названию)">
                          <div class="drop-box">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Товарной группа 1</li>
                                <li class="drop-list-item">Товарной группа 2</li>
                                <li class="drop-list-item">Товарной группа 3</li>
                                <li class="drop-list-item">Товарной группа 4</li>
                                <li class="drop-list-item">Товарной группа 5</li>
                                <li class="drop-list-item">Товарной группа 6</li>
                                <li class="drop-list-item">Товарной группа 7</li>
                                <li class="drop-list-item">Товарной группа 8</li>
                                <li class="drop-list-item">Товарной группа 9</li>
                                <li class="drop-list-item">Товарной группа 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="drop --search"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Выбор Бренда (поиск по ID или названию)">
                          <div class="drop-box">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Бренд 1</li>
                                <li class="drop-list-item">Бренд 2</li>
                                <li class="drop-list-item">Бренд 3</li>
                                <li class="drop-list-item">Бренд 4</li>
                                <li class="drop-list-item">Бренд 5</li>
                                <li class="drop-list-item">Бренд 6</li>
                                <li class="drop-list-item">Бренд 7</li>
                                <li class="drop-list-item">Бренд 8</li>
                                <li class="drop-list-item">Бренд 9</li>
                                <li class="drop-list-item">Бренд 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group"><input class="form-control" type="text" placeholder="Кол-во"></div>
                    </form>
                  </div>
                  <div class="drop-list-result-item">
                    <form action="#!">
                      <div class="form-group">
                        <div class="drop --search"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Выбор товарной группы (поиск по ID или названию)">
                          <div class="drop-box">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Товарной группа 1</li>
                                <li class="drop-list-item">Товарной группа 2</li>
                                <li class="drop-list-item">Товарной группа 3</li>
                                <li class="drop-list-item">Товарной группа 4</li>
                                <li class="drop-list-item">Товарной группа 5</li>
                                <li class="drop-list-item">Товарной группа 6</li>
                                <li class="drop-list-item">Товарной группа 7</li>
                                <li class="drop-list-item">Товарной группа 8</li>
                                <li class="drop-list-item">Товарной группа 9</li>
                                <li class="drop-list-item">Товарной группа 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="drop --search"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Выбор Бренда (поиск по ID или названию)">
                          <div class="drop-box">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Бренд 1</li>
                                <li class="drop-list-item">Бренд 2</li>
                                <li class="drop-list-item">Бренд 3</li>
                                <li class="drop-list-item">Бренд 4</li>
                                <li class="drop-list-item">Бренд 5</li>
                                <li class="drop-list-item">Бренд 6</li>
                                <li class="drop-list-item">Бренд 7</li>
                                <li class="drop-list-item">Бренд 8</li>
                                <li class="drop-list-item">Бренд 9</li>
                                <li class="drop-list-item">Бренд 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group"><input class="form-control" type="text" placeholder="Указание цены"></div>
                      <div class="form-group">
                        <div class="drop --select --select"><span class="drop-clear"></span><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="Выбор условия"><button class="form-control drop-button" type="button">Выбор условия</button>
                          <div class="drop-box">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Выбор условия 1</li>
                                <li class="drop-list-item">Выбор условия 2</li>
                                <li class="drop-list-item">Выбор условия 3</li>
                                <li class="drop-list-item">Выбор условия 4</li>
                                <li class="drop-list-item">Выбор условия 5</li>
                                <li class="drop-list-item">Выбор условия 6</li>
                                <li class="drop-list-item">Выбор условия 7</li>
                                <li class="drop-list-item">Выбор условия 8</li>
                                <li class="drop-list-item">Выбор условия 9</li>
                                <li class="drop-list-item">Выбор условия 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="group-b-conditions" role="tabpanel">
              <div class="container-medium">
                <div class="drop --select drop-select"><span class="drop-clear"></span><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="Тип условия"><button class="form-control drop-button" type="button">Тип условия</button>
                  <div class="drop-box">
                    <div class="drop-overflow">
                      <ul class="drop-list">
                        <li class="drop-list-item">Товар из товарной группы B + Бренд N + кол-во</li>
                        <li class="drop-list-item">Товар из товарной группы B + Бренд N c ценой (&lt;,&gt;, &lt;&gt;) грн</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="drop-list-result">
                  <div class="drop-list-result-item">
                    <form action="#!">
                      <div class="form-group">
                        <div class="drop --search"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Выбор товарной группы (поиск по ID или названию)">
                          <div class="drop-box">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Товарной группа 1</li>
                                <li class="drop-list-item">Товарной группа 2</li>
                                <li class="drop-list-item">Товарной группа 3</li>
                                <li class="drop-list-item">Товарной группа 4</li>
                                <li class="drop-list-item">Товарной группа 5</li>
                                <li class="drop-list-item">Товарной группа 6</li>
                                <li class="drop-list-item">Товарной группа 7</li>
                                <li class="drop-list-item">Товарной группа 8</li>
                                <li class="drop-list-item">Товарной группа 9</li>
                                <li class="drop-list-item">Товарной группа 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="drop --search"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Выбор Бренда (поиск по ID или названию)">
                          <div class="drop-box">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Бренд 1</li>
                                <li class="drop-list-item">Бренд 2</li>
                                <li class="drop-list-item">Бренд 3</li>
                                <li class="drop-list-item">Бренд 4</li>
                                <li class="drop-list-item">Бренд 5</li>
                                <li class="drop-list-item">Бренд 6</li>
                                <li class="drop-list-item">Бренд 7</li>
                                <li class="drop-list-item">Бренд 8</li>
                                <li class="drop-list-item">Бренд 9</li>
                                <li class="drop-list-item">Бренд 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group"><input class="form-control" type="number" placeholder="Кол-во" onclick="this.select();"></div>
                    </form>
                  </div>
                  <div class="drop-list-result-item">
                    <form action="#!">
                      <div class="form-group">
                        <div class="drop --search"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Выбор товарной группы (поиск по ID или названию)">
                          <div class="drop-box">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Товарной группа 1</li>
                                <li class="drop-list-item">Товарной группа 2</li>
                                <li class="drop-list-item">Товарной группа 3</li>
                                <li class="drop-list-item">Товарной группа 4</li>
                                <li class="drop-list-item">Товарной группа 5</li>
                                <li class="drop-list-item">Товарной группа 6</li>
                                <li class="drop-list-item">Товарной группа 7</li>
                                <li class="drop-list-item">Товарной группа 8</li>
                                <li class="drop-list-item">Товарной группа 9</li>
                                <li class="drop-list-item">Товарной группа 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="drop --search"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Выбор Бренда (поиск по ID или названию)">
                          <div class="drop-box">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Бренд 1</li>
                                <li class="drop-list-item">Бренд 2</li>
                                <li class="drop-list-item">Бренд 3</li>
                                <li class="drop-list-item">Бренд 4</li>
                                <li class="drop-list-item">Бренд 5</li>
                                <li class="drop-list-item">Бренд 6</li>
                                <li class="drop-list-item">Бренд 7</li>
                                <li class="drop-list-item">Бренд 8</li>
                                <li class="drop-list-item">Бренд 9</li>
                                <li class="drop-list-item">Бренд 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group"><input class="form-control" type="number" placeholder="Указание цены" onclick="this.select();"></div>
                      <div class="form-group">
                        <div class="drop --select --select"><span class="drop-clear"></span><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="Выбор условия"><button class="form-control drop-button" type="button">Выбор условия</button>
                          <div class="drop-box">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Выбор условия 1</li>
                                <li class="drop-list-item">Выбор условия 2</li>
                                <li class="drop-list-item">Выбор условия 3</li>
                                <li class="drop-list-item">Выбор условия 4</li>
                                <li class="drop-list-item">Выбор условия 5</li>
                                <li class="drop-list-item">Выбор условия 6</li>
                                <li class="drop-list-item">Выбор условия 7</li>
                                <li class="drop-list-item">Выбор условия 8</li>
                                <li class="drop-list-item">Выбор условия 9</li>
                                <li class="drop-list-item">Выбор условия 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="action" role="tabpanel">
              <div class="container-medium">
                <div class="drop --select drop-select"><span class="drop-clear"></span><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="Тип действия"><button class="form-control drop-button" type="button">Тип действия</button>
                  <div class="drop-box">
                    <div class="drop-overflow">
                      <ul class="drop-list">
                        <li class="drop-list-item">Скидка %</li>
                        <li class="drop-list-item">Скидка ГРН</li>
                        <li class="drop-list-item">Товар по фикс. цене</li>
                        <li class="drop-list-item">Бесплатная доставка</li>
                        <li class="drop-list-item">Фиксированная @lang('custom::admin.Price')</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="drop-list-result">
                  <div class="drop-list-result-item">
                    <form action="#!">
                      <div class="form-group"><input class="form-control" type="number" placeholder="% скидки" onclick="this.select();"></div>
                      <div class="page-save"><button class="button" type="button">Сохранить</button></div>
                    </form>
                  </div>
                  <div class="drop-list-result-item">
                    <form action="#!">
                      <div class="form-group"><input class="form-control" type="number" placeholder="Сумма скидки" onclick="this.select();"></div>
                      <div class="page-save"><button class="button" type="button">Сохранить</button></div>
                    </form>
                  </div>
                  <div class="drop-list-result-item">
                    <form action="#!">
                      <div class="form-group">
                        <div class="drop --search"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Выбор товара (поиск по ID или названию)">
                          <div class="drop-box">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Товар 1</li>
                                <li class="drop-list-item">Товар 2</li>
                                <li class="drop-list-item">Товар 3</li>
                                <li class="drop-list-item">Товар 4</li>
                                <li class="drop-list-item">Товар 5</li>
                                <li class="drop-list-item">Товар 6</li>
                                <li class="drop-list-item">Товар 7</li>
                                <li class="drop-list-item">Товар 8</li>
                                <li class="drop-list-item">Товар 9</li>
                                <li class="drop-list-item">Товар 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group"><input class="form-control" type="number" placeholder="Стоимость, грн" onclick="this.select();"></div>
                      <div class="page-save"><button class="button" type="button">Сохранить</button></div>
                    </form>
                  </div>
                  <div class="drop-list-result-item">
                    <form action="#!">
                      <div class="form-group">
                        <div class="drop --select"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Перевозчик">
                          <div class="drop-box">
                            <div class="drop-overflow">
                              <ul class="drop-list">
                                <li class="drop-list-item">Перевозчик 1</li>
                                <li class="drop-list-item">Перевозчик 2</li>
                                <li class="drop-list-item">Перевозчик 3</li>
                                <li class="drop-list-item">Перевозчик 4</li>
                                <li class="drop-list-item">Перевозчик 5</li>
                                <li class="drop-list-item">Перевозчик 6</li>
                                <li class="drop-list-item">Перевозчик 7</li>
                                <li class="drop-list-item">Перевозчик 8</li>
                                <li class="drop-list-item">Перевозчик 9</li>
                                <li class="drop-list-item">Перевозчик 10</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="page-save"><button class="button" type="button">Сохранить</button></div>
                    </form>
                  </div>
                  <div class="drop-list-result-item">
                    <form action="#!">
                      <div class="form-group"><input class="form-control" type="number" placeholder="Стоимость, грн" onclick="this.select();"></div>
                      <div class="page-save"><button class="button" type="button">Сохранить</button></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>
