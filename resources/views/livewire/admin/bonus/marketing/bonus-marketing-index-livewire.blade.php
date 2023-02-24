<div>
    {{-- In work, do what you enjoy. --}}
    <div class="container-large">
          <h4 class="text-center text-xl-start">Маркетинговые предложения</h4>
          <div class="row g-4">
            <div class="col-md-6">
              <div class="drop --search"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Название">
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">Название 1</li>
                      <li class="drop-list-item">Название 2</li>
                      <li class="drop-list-item">Название 3</li>
                      <li class="drop-list-item">Название 4</li>
                      <li class="drop-list-item">Название 5</li>
                      <li class="drop-list-item">Название 6</li>
                      <li class="drop-list-item">Название 7</li>
                      <li class="drop-list-item">Название 8</li>
                      <li class="drop-list-item">Название 9</li>
                      <li class="drop-list-item">Название 10</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="drop --select --select"><span class="drop-clear"></span><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="Тип действия"><button class="form-control drop-button" type="button">Тип действия</button>
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">Действие 1</li>
                      <li class="drop-list-item">Действие 2</li>
                      <li class="drop-list-item">Действие 3</li>
                      <li class="drop-list-item">Действие 4</li>
                      <li class="drop-list-item">Действие 5</li>
                      <li class="drop-list-item">Действие 6</li>
                      <li class="drop-list-item">Действие 7</li>
                      <li class="drop-list-item">Действие 8</li>
                      <li class="drop-list-item">Действие 9</li>
                      <li class="drop-list-item">Действие 10</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="drop"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Контрагент">
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">Контрагент 1</li>
                      <li class="drop-list-item">Контрагент 2</li>
                      <li class="drop-list-item">Контрагент 3</li>
                      <li class="drop-list-item">Контрагент 4</li>
                      <li class="drop-list-item">Контрагент 5</li>
                      <li class="drop-list-item">Контрагент 6</li>
                      <li class="drop-list-item">Контрагент 7</li>
                      <li class="drop-list-item">Контрагент 8</li>
                      <li class="drop-list-item">Контрагент 9</li>
                      <li class="drop-list-item">Контрагент 10</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6"><button class="button" type="button">Выгрузить</button></div>
          </div>
          <div class="table-before-btn --small">
            <div class="mt-3">
              <div class="action-group">
                <div class="action-group-btn"><span class="ico_submenu"></span></div>
                <div class="action-group-drop">
                  <ul class="action-group-list">
                    <li><button class="ico_plus" type="button"></button></li>
                    <li><button class="ico_trash" type="button"></button></li>
                    <li><button class="js-hide-drop ico_close" type="button"></button></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <table class="js-table table-td-small footable footable-1 footable-paging footable-paging-right breakpoint-lg" data-paging-size="6" style="">
            <thead>
              <tr class="footable-header">

              <th class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check js-select-all"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название</span></div>
                </th><th data-breakpoints="xs" style="display: table-cell;">Контрагент</th><th data-breakpoints="xs" style="display: table-cell;">Условие А</th><th data-breakpoints="xs" style="display: table-cell;">Условие В</th><th data-breakpoints="xs sm md" style="display: table-cell;">Действие</th><th class="text-sm-center" data-breakpoints="xs sm md" style="display: table-cell;">Активность</th><th class="text-xl-center text-end w-1 footable-last-visible" data-breakpoints="xs sm md" style="display: table-cell;"></th></tr>
            </thead>
            <tbody>

            <tr>

              <td class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a href="{{route('admin.bonus.marketing.edit',['1'])}}">Название маркетингового предложения</a></div>
                </td><td style="display: table-cell;"><span>Розетка</span></td><td style="display: table-cell;"><span>Любой мышь Logitech</span></td><td style="display: table-cell;"><span>Любой монитор Asus</span></td><td style="display: table-cell;"><span>Скидка 5%</span></td><td class="text-xl-center" style="display: table-cell;"><label class="check eye"><input class="check__input" type="checkbox"><span class="check__box"></span></label></td><td class="text-xl-center text-end footable-last-visible" style="display: table-cell;"><a class="button button-small button-icon ico_edit" href="{{route('admin.bonus.marketing.edit',['1'])}}"></a></td></tr><tr>

              <td class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a href="{{route('admin.bonus.marketing.edit',['1'])}}">Название маркетингового предложения</a></div>
                </td><td style="display: table-cell;"><span>Розетка, Эпицентр</span></td><td style="display: table-cell;"><span>Микс любая мышь</span></td><td style="display: table-cell;"><span>В сумарном кол-ве 5 шт</span></td><td style="display: table-cell;"><span>Скидка 30грн</span></td><td class="text-xl-center" style="display: table-cell;"><label class="check eye"><input class="check__input" type="checkbox"><span class="check__box"></span></label></td><td class="text-xl-center text-end footable-last-visible" style="display: table-cell;"><a class="button button-small button-icon ico_edit" href="{{route('admin.bonus.marketing.edit',['1'])}}"></a></td></tr><tr>

              <td class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a href="{{route('admin.bonus.marketing.edit',['1'])}}">Название маркетингового предложения</a></div>
                </td><td style="display: table-cell;"><span>Розетка</span></td><td style="display: table-cell;"><span>Любой мышь Logitech</span></td><td style="display: table-cell;"><span>Любой монитор Asus</span></td><td style="display: table-cell;"><span>Скидка 5%</span></td><td class="text-xl-center" style="display: table-cell;"><label class="check eye"><input class="check__input" type="checkbox"><span class="check__box"></span></label></td><td class="text-xl-center text-end footable-last-visible" style="display: table-cell;"><a class="button button-small button-icon ico_edit" href="{{route('admin.bonus.marketing.edit',['1'])}}"></a></td></tr><tr>

              <td class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a href="{{route('admin.bonus.marketing.edit',['1'])}}">Название маркетингового предложения</a></div>
                </td><td style="display: table-cell;"><span>Розетка</span></td><td style="display: table-cell;"><span>Любой товар Sony &gt; 5000 грн </span></td><td style="display: table-cell;"><span></span></td><td style="display: table-cell;"><span>Бесплатная доставка</span></td><td class="text-xl-center" style="display: table-cell;"><label class="check eye"><input class="check__input" type="checkbox"><span class="check__box"></span></label></td><td class="text-xl-center text-end footable-last-visible" style="display: table-cell;"><a class="button button-small button-icon ico_edit" href="{{route('admin.bonus.marketing.edit',['1'])}}"></a></td></tr><tr>

              <td class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a href="{{route('admin.bonus.marketing.edit',['1'])}}">Название маркетингового предложения</a></div>
                </td><td style="display: table-cell;"><span>Клиент B2C</span></td><td style="display: table-cell;"><span>Любой мышь Logitech</span></td><td style="display: table-cell;"><span>Любой монитор Asus</span></td><td style="display: table-cell;"><span>Скидка 5%</span></td><td class="text-xl-center" style="display: table-cell;"><label class="check eye"><input class="check__input" type="checkbox"><span class="check__box"></span></label></td><td class="text-xl-center text-end footable-last-visible" style="display: table-cell;"><a class="button button-small button-icon ico_edit" href="{{route('admin.bonus.marketing.edit',['1'])}}"></a></td></tr><tr>

              <td class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a href="{{route('admin.bonus.marketing.edit',['1'])}}">Название маркетингового предложения</a></div>
                </td><td style="display: table-cell;"><span>Розетка</span></td><td style="display: table-cell;"><span>Любой мышь Logitech</span></td><td style="display: table-cell;"><span>Любой монитор Asus</span></td><td style="display: table-cell;"><span>Скидка 5%</span></td><td class="text-xl-center" style="display: table-cell;"><label class="check eye"><input class="check__input" type="checkbox"><span class="check__box"></span></label></td><td class="text-xl-center text-end footable-last-visible" style="display: table-cell;"><a class="button button-small button-icon ico_edit" href="{{route('admin.bonus.marketing.edit',['1'])}}"></a></td></tr></tbody>
          </table>
          <div class="page-bottom-group">
            <div class="page-save"><button class="button" type="button">Сохранить</button></div>
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
                <div id="table-nav" class="footable-paging-external footable-paging-right"><div class="footable-pagination-wrapper"><ul class="pagination"><li class="footable-page-nav disabled" data-page="first"><a class="footable-page-link" href="#">«</a></li><li class="footable-page-nav disabled" data-page="prev"><a class="footable-page-link" href="#">‹</a></li><li class="footable-page visible active" data-page="1"><a class="footable-page-link" href="#">1</a></li><li class="footable-page visible" data-page="2"><a class="footable-page-link" href="#">2</a></li><li class="footable-page-nav" data-page="next"><a class="footable-page-link" href="#">›</a></li><li class="footable-page-nav" data-page="last"><a class="footable-page-link" href="#">»</a></li></ul><div class="divider"></div><span class="label label-default">1 / 2</span></div></div>
              </div>
            </div>
          </div>
        </div>
</div>
