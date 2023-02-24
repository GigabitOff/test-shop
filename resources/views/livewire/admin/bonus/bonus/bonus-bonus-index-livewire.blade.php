<div>
    {{-- In work, do what you enjoy. --}}
          <h4 class="text-center text-xl-start">Бонусы</h4>
          <div class="table-before-btn --small">
            <div>
              <div class="action-group">
                <div class="action-group-btn"><span class="ico_submenu"></span></div>
                <div class="action-group-drop">
                  <ul class="action-group-list">
                    <li><a class="ico_plus" href="{{route('admin.bonus.bonus.create')}}"></a></li>
                    <li><button class="ico_trash" type="button"></button></li>
                    <li><button class="js-hide-drop ico_close" type="button"></button></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <table class="js-table table-td-small footable footable-1 footable-paging footable-paging-right breakpoint-lg" data-paging-size="5" style="">
            <thead>
              <tr class="footable-header">
              <th class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check js-select-all"><input class="check__input" type="checkbox"><span class="check__box"></span></label><span>Название</span></div>
                </th><th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">Дата создания</th><th class="text-md-center" data-breakpoints="xs" style="display: table-cell;">Активен До</th><th data-breakpoints="xs sm md" style="display: table-cell;">Тип кешбэка</th><th class="text-md-center" data-breakpoints="xs sm md" style="display: table-cell;">Активность</th><th class="text-end text-xl-center w-1 footable-last-visible" data-breakpoints="xs sm md" style="display: table-cell;"></th></tr>
            </thead>
            <tbody>
            <tr>
              <td class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a href="{{route('admin.bonus.edit',['1'])}}">Спецобувь с нескользящей подошве от Portwest</a></div>
                </td><td class="text-md-center" style="display: table-cell;">29.09.22</td><td class="text-md-center" style="display: table-cell;">29.09.22</td><td style="display: table-cell;"><span class="nowrap">Персональное предложение</span></td><td class="text-center" style="display: table-cell;"><label class="check eye"><input class="check__input" type="checkbox"><span class="check__box"></span></label></td><td class="text-end text-xl-center w-1 footable-last-visible" style="display: table-cell;"><a class="button button-small button-icon ico_edit" href="{{route('admin.bonus.edit',['1'])}}"></a></td></tr><tr>

              <td class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a href="{{route('admin.bonus.edit',['1'])}}">Спецобувь с нескользящей подошве от Portwest</a></div>
                </td><td class="text-md-center" style="display: table-cell;">29.09.22</td><td class="text-md-center" style="display: table-cell;">29.09.22</td><td style="display: table-cell;"><span class="nowrap">Определенный товар</span></td><td class="text-center" style="display: table-cell;"><label class="check eye"><input class="check__input" type="checkbox"><span class="check__box"></span></label></td><td class="text-end text-xl-center w-1 footable-last-visible" style="display: table-cell;"><a class="button button-small button-icon ico_edit" href="{{route('admin.bonus.edit',['1'])}}"></a></td></tr><tr>
              <td class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a href="{{route('admin.bonus.edit',['1'])}}">Спецобувь с нескользящей подошве от Portwest</a></div>
                </td><td class="text-md-center" style="display: table-cell;">29.09.22</td><td class="text-md-center" style="display: table-cell;">29.09.22</td><td style="display: table-cell;"><span class="nowrap">Процент от суммы продажи</span></td><td class="text-center" style="display: table-cell;"><label class="check eye"><input class="check__input" type="checkbox"><span class="check__box"></span></label></td><td class="text-end text-xl-center w-1 footable-last-visible" style="display: table-cell;"><a class="button button-small button-icon ico_edit" href="{{route('admin.bonus.edit',['1'])}}"></a></td></tr><tr>
              <td class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a href="{{route('admin.bonus.edit',['1'])}}">Спецобувь с нескользящей подошве от Portwest</a></div>
                </td><td class="text-md-center" style="display: table-cell;">29.09.22</td><td class="text-md-center" style="display: table-cell;">29.09.22</td><td style="display: table-cell;"><span class="nowrap">Бонус от конкретной суммы</span></td><td class="text-center" style="display: table-cell;"><label class="check eye"><input class="check__input" type="checkbox"><span class="check__box"></span></label></td><td class="text-end text-xl-center w-1 footable-last-visible" style="display: table-cell;"><a class="button button-small button-icon ico_edit" href="{{route('admin.bonus.edit',['1'])}}"></a></td></tr><tr>

              <td class="footable-first-visible" style="display: table-cell;">
                  <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox"><span class="check__box"></span></label><a href="{{route('admin.bonus.edit',['1'])}}">Спецобувь с нескользящей подошве от Portwest</a></div>
                </td><td class="text-md-center" style="display: table-cell;">29.09.22</td><td class="text-md-center" style="display: table-cell;">29.09.22</td><td style="display: table-cell;"><span class="nowrap">Покупка опред. кол-ва товаров</span></td><td class="text-center" style="display: table-cell;"><label class="check eye"><input class="check__input" type="checkbox"><span class="check__box"></span></label></td><td class="text-end text-xl-center w-1 footable-last-visible" style="display: table-cell;"><a class="button button-small button-icon ico_edit" href="{{route('admin.bonus.edit',['1'])}}"></a></td></tr></tbody>
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
                <div id="table-nav" class="footable-paging-external footable-paging-right"><div class="footable-pagination-wrapper"><ul class="pagination"><li class="footable-page-nav disabled" data-page="first"><a class="footable-page-link" href="#">«</a></li><li class="footable-page-nav disabled" data-page="prev"><a class="footable-page-link" href="#">‹</a></li><li class="footable-page visible active" data-page="1"><a class="footable-page-link" href="#">1</a></li><li class="footable-page visible" data-page="2"><a class="footable-page-link" href="#">2</a></li><li class="footable-page visible" data-page="3"><a class="footable-page-link" href="#">3</a></li><li class="footable-page-nav" data-page="next"><a class="footable-page-link" href="#">›</a></li><li class="footable-page-nav" data-page="last"><a class="footable-page-link" href="#">»</a></li></ul><div class="divider"></div><span class="label label-default">1 / 3</span></div></div>
              </div>
            </div>
          </div>
</div>
