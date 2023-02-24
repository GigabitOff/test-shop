jQuery(document).ready(function ($) {
  //= Scripts
  /* ---------------------------------- Base ---------------------------------- */

  //$('.js-date').datepicker({autoClose: true,});
  //$('.js-date-multy').datepicker({autoClose: true, range: true, multipleDatesSeparator: ' - '});
  $('.js-select').niceSelect();
  $('.js-color').inputmask({regex: '[0-9a-fA-F]{6}'});
  $('.js-phone').inputmask({"mask": "+38(999) 999-99-99"});
  $('.js-phone-small').inputmask({"mask": "(999) 999-99-99"});

  $('.dropify').dropify({
    messages: {
      'default': '',
      'replace': 'Заменить',
      'remove':  '',
      'error':   'Недопустимый формат'
    },
    error: {
      'fileSize': 'Превышен размер файла ({{ value }} макс.).',
      'minWidth': 'Ширина изображения слишком мала ({{ value }}}px мин.).',
      'maxWidth': 'Ширина изображения слишком велика ({{ value }}}px макс.).',
      'minHeight': 'Высота изображения слишком мала ({{ value }}}px мин.).',
      'maxHeight': 'Высота изображения слишком велика ({{ value }}px макс.).',
      'imageFormat': 'Формат файла не допускается ({{ value }} только).'
    },
  });

  var sortableItems = document.querySelectorAll('.tb-sortable');
  sortableItems.forEach(function(element){
    var sortable = Sortable.create(element);
  });



  $('.show-hide input[type="checkbox"]').closest('.show-hide').next('.show-hide-box').hide();
  $('.show-hide input[type="checkbox"]').on('change', function() {
    var target = $(this).closest('.show-hide').next('.show-hide-box');
    if (this.checked) target.slideDown();
    else target.slideUp();
  });


  if(document.querySelector('.js-select-w-drop')) {
    const selectDrop = document.querySelector('.js-select-w-drop'),
    selectDropItems = selectDrop.querySelectorAll('.drop-list-item'),
    selectDropBox = selectDrop.closest('.form-group').nextElementSibling;

    for (let selectDropItem of selectDropItems) {

      selectDropItem.addEventListener('click', function(){
        for (let selectDropItem of selectDropItems) {
          selectDropItem.classList.remove('is-active');
        }
        this.classList.add('is-active');
        const itemData = this.getAttribute('data-drop');
        if(itemData == 1) {
          selectDropBox.classList.add('is-active')
        } else {
          selectDropBox.classList.remove('is-active')
        }
      })

    }
  }

  /* ------------------------ Кнопки дейсвий в таблице ------------------------ */

  $(document).on('click', '.action-group-btn', function () {
    $('.action-group').removeClass('is-show');
    $(this).closest('.action-group').toggleClass('is-show');
  });

  $(document).on('click', function (e) {
    if (!$(e.target).closest(".action-group").length) {
      $('.action-group').removeClass('is-show');
    }
    e.stopPropagation();
  });

  $(document).on('click', '.js-hide-drop', function(){
    $(this).closest('.action-group').toggleClass('is-show');
  });
  /* --------------------------------- Counter -------------------------------- */

  $(document).on('click', '.counter .minus', function(event) {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 0 ? 0 : count;
    $input.val(count);
    $input.change();
    return false;
  });

  $(document).on('click', '.counter .plus', function(event) {
    var $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
  });
  /* -------------------------------- Dropdown -------------------------------- */

  $('.drop input').attr('autocomplete', 'off');

  // $('.drop input').before('<span class="drop-clear"></span>');

  $(document).on('click', '.drop-button', function(){
    $('.drop').removeClass('_active');
    $(this).closest('.drop').find('.drop-box').show();
    $(this).closest('.drop').addClass('_active');
  });

  $(document).on('focus', '.drop input', function(){
    $('.drop').removeClass('_active');
    $('.drop-box').hide();
    $(this).closest('.drop').find('.drop-box').show();
    $(this).closest('.drop').addClass('_active');
  });

  $(document).on('input', '.drop input:not(".js-free")', function(){
    let val = $(this).val();
    if( val.length >= 1 ) {
      $(this).closest('.drop').find('.drop-clear').addClass('_active');
      $(this).closest('.drop').addClass('_active-close');
    } else {
      $(this).closest('.drop').find('.drop-clear').removeClass('_active');
      $(this).closest('.drop').removeClass('_active-close');
    }
  });

  $(document).on('click', '.drop-clear', function(){
    $(this).removeClass('_active');
    let placeholder = $(this).closest('.drop').find('.drop-input').attr('placeholder');
    $(this).next('input').val('');
    $(this).closest('.drop').find('.drop-button').text(placeholder);
    $(this).closest('.drop').removeClass('_active _selected');
    $(this).closest('.drop').removeClass('_active-close');
    $(this).closest('.drop').find('.drop-box').hide();
  });

  $(document).on('click', '.drop-box .drop-list-item', function(){
    let currentVal = $(this).html();
    let regex      = /<\/?\w+[^>]*\/?>/g;
   // let currentTxt = $(this).html().replace(regex, "");
    //$(this).closest('.drop').find('.form-control').val(currentTxt);
    //$(this).closest('.drop').find('.drop-button').html(currentVal);
    $(this).closest('.drop').find('.drop-clear').addClass('_active');
    $(this).closest('.drop').addClass('_active-close');
    $('.drop-box').hide();
    $(this).closest('.drop').addClass('_selected');
    $('.drop').removeClass('_active');
    $('.drop').removeClass('_active-close');
  });

  $(document).on('click', function(e) {
    if (!$(e.target).closest(".drop").length) {
      $('.drop').removeClass('_active');
      $('.drop-box').hide();
    }
    e.stopPropagation();
  });

  $(document).on('click', '.drop-select .drop-list-item', function() {
    let $dropResultItem = $(this).closest('.drop-select').next('.drop-list-result').find('.drop-list-result-item')
    $dropResultItem.hide().eq($(this).index()).fadeIn();
  });
  $('input.upload-unit__input').bind('change', function() {

    let ths           = $(this);
    let size          = parseInt(this.files[0].size / 1024);
    let name          = this.files[0].name;
    let nameBox       = ths.closest('.upload-unit').find('.upload-unit__title');
    let sizeBox       = ths.closest('.upload-unit').find('.upload-unit__size');
    let status        = ths.closest('.upload-unit').find('.upload-unit__status');
    let fileExtension = ['jpg', 'jpeg', 'png'];

    nameBox.text(name);
    sizeBox.text(size + ' kb. Завантаженно');
    status.children().removeAttr('class');
    status.removeClass('cancel').addClass('success');
    status.children().addClass('ico_file-success');

    if(4880 < size){
      sizeBox.text('Імпорт неможливий. Розмір перевищено');
      status.children().removeAttr('class');
      status.removeClass('success').addClass('cancel');
      status.children().addClass('ico_file-cancel');
    }

    if ($.inArray(name.split('.').pop().toLowerCase(), fileExtension) == -1) {
      sizeBox.text('Імпорт неможливий. Недійсний формат');
      status.children().removeAttr('class');
      status.removeClass('success').addClass('cancel');
      status.children().addClass('ico_file-cancel');
    }

  });

  $('.upload-file-block.--full input.upload-file-block__input').bind('change', function() {
    let ths  = $(this);
    let size = parseInt(this.files[0].size / 1024);
    let name = this.files[0].name;
    let unit = `<div class="col-lg-3 col-md-6 upload-unit">
                  <div class="upload-unit__label">
                    <div class="upload-unit__icon">
                      <div class="upload-unit__icon-file"><i class="ico_file"></i></div>
                      <div class="upload-unit__trash"><i class="ico_trash"></i></div>
                    </div>
                    <div class="upload-unit__info">
                      <div class="upload-unit__title">${name}</div>
                      <div class="upload-unit__size">${size} Kb.</div>
                    </div>
                  </div>
                </div>`;
    ths.closest('.upload-file-block').find('.upload-file-block__box').append(unit);
  });

  $('.upload-file-block.--small input.upload-file-block__input').bind('change', function() {
    let ths  = $(this);
    let size = parseInt(this.files[0].size / 1024);
    let name = this.files[0].name;
    let unit = `<div class="upload-unit --small">
                  <div class="upload-unit__label">
                    <div class="upload-unit__info">
                      <div class="upload-unit__title">${name}</div>
                      <div class="upload-unit__trash"><i class="ico_close"></i></div>
                    </div>
                  </div>
                </div>`;
    ths.closest('.upload-file-block').find('.upload-file-block__box').append(unit);
  });

  $('.upload-file-block.--partners input.upload-file-block__input').bind('change', function() {

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '.' + dd + '.' + yyyy;

    let ths  = $(this);
    let size = parseInt(this.files[0].size / 1024);
    let name = this.files[0].name;
    let unit = `<div class="upload-unit --partners">
                  <div class="upload-unit__label">
                    <div class="upload-unit__info">
                      <div class="upload-unit__box">
                        <div>
                          <img src="assets/img/pdf.svg" alt="pdf">
                        </div>
                        <div>
                          <div class="upload-unit__title">${name}</div>
                          <div class="upload-unit__date">${today}</div>
                        </div>
                      </div>
                      <div class="upload-unit__trash"><i class="ico_close"></i></div>
                    </div>
                  </div>
                </div>`;
    ths.closest('.upload-file-block').find('.upload-file-block__btn').hide();
    ths.closest('.upload-file-block').find('.upload-file-block__box').append(unit);
  });

  $(document).on('click', '.upload-unit__trash', function(){
    let ths  = $(this);
    ths.closest('.upload-file-block').find('.upload-file-block__btn').show();
    ths.closest('.upload-file-block').find('input.upload-file-block__input').val('');
    ths.closest('.upload-unit').remove();

  });
  /* ----------------------------- Таблица Footable ---------------------------- */

  $('.js-table_new').footable({
   // "empty": "Таблица пуста",
    //"toggleColumn": "last",
    "paging": {
      "enabled": false,
      //"container": "#table-nav",
      //"limit": 3,
      //"position": "right",
      //"countFormat": "{CP} / {TP}",
      //"size": 6
    }
  });

  $(document).on('click', '.js-page-size .drop-list-item', function (e) {
   // var newSize = $(this).attr('data-page-size');
   // console.log(newSize);
   // FooTable.get('.js-table').pageSize(newSize);
  });

  // js-free добавлено что бы исключить влияние обработчика
  // т.к. он жестко привязан к стилевым классам
  $(document).on('click', 'table button.ico_trash:not(".js-free")', function(){
    $(this).closest('tr').remove();
  });
  // Dynamic Adapt v.1
  // HTML data-da="where(uniq class name),when(breakpoint),position(digi)"
  // e.x. data-da=".item,992,2"
  // Andrikanych Yevhen 2020
  // https://www.youtube.com/c/freelancerlifestyle

  "use strict";

  function DynamicAdapt(type) {
  	this.type = type;
  }

  DynamicAdapt.prototype.init = function () {
  	const _this = this;
  	// массив объектов
  	this.оbjects = [];
  	this.daClassname = "_dynamic_adapt_";
  	// массив DOM-элементов
  	this.nodes = document.querySelectorAll("[data-da]");

  	// наполнение оbjects объктами
  	for (let i = 0; i < this.nodes.length; i++) {
  		const node = this.nodes[i];
  		const data = node.dataset.da.trim();
  		const dataArray = data.split(",");
  		const оbject = {};
  		оbject.element = node;
  		оbject.parent = node.parentNode;
  		оbject.destination = document.querySelector(dataArray[0].trim());
  		оbject.breakpoint = dataArray[1] ? dataArray[1].trim() : "767";
  		оbject.place = dataArray[2] ? dataArray[2].trim() : "last";
  		оbject.index = this.indexInParent(оbject.parent, оbject.element);
  		this.оbjects.push(оbject);
  	}

  	this.arraySort(this.оbjects);

  	// массив уникальных медиа-запросов
  	this.mediaQueries = Array.prototype.map.call(this.оbjects, function (item) {
  		return '(' + this.type + "-width: " + item.breakpoint + "px)," + item.breakpoint;
  	}, this);
  	this.mediaQueries = Array.prototype.filter.call(this.mediaQueries, function (item, index, self) {
  		return Array.prototype.indexOf.call(self, item) === index;
  	});

  	// навешивание слушателя на медиа-запрос
  	// и вызов обработчика при первом запуске
  	for (let i = 0; i < this.mediaQueries.length; i++) {
  		const media = this.mediaQueries[i];
  		const mediaSplit = String.prototype.split.call(media, ',');
  		const matchMedia = window.matchMedia(mediaSplit[0]);
  		const mediaBreakpoint = mediaSplit[1];

  		// массив объектов с подходящим брейкпоинтом
  		const оbjectsFilter = Array.prototype.filter.call(this.оbjects, function (item) {
  			return item.breakpoint === mediaBreakpoint;
  		});
  		matchMedia.addListener(function () {
  			_this.mediaHandler(matchMedia, оbjectsFilter);
  		});
  		this.mediaHandler(matchMedia, оbjectsFilter);
  	}
  };

  DynamicAdapt.prototype.mediaHandler = function (matchMedia, оbjects) {
  	if (matchMedia.matches) {
  		for (let i = 0; i < оbjects.length; i++) {
  			const оbject = оbjects[i];
  			оbject.index = this.indexInParent(оbject.parent, оbject.element);
  			this.moveTo(оbject.place, оbject.element, оbject.destination);
  		}
  	} else {
  		for (let i = 0; i < оbjects.length; i++) {
  			const оbject = оbjects[i];
  			if (оbject.element.classList.contains(this.daClassname)) {
  				this.moveBack(оbject.parent, оbject.element, оbject.index);
  			}
  		}
  	}
  };

  // Функция перемещения
  DynamicAdapt.prototype.moveTo = function (place, element, destination) {
  	element.classList.add(this.daClassname);
  	if (place === 'last' || place >= destination.children.length) {
  		destination.insertAdjacentElement('beforeend', element);
  		return;
  	}
  	if (place === 'first') {
  		destination.insertAdjacentElement('afterbegin', element);
  		return;
  	}
  	destination.children[place].insertAdjacentElement('beforebegin', element);
  }

  // Функция возврата
  DynamicAdapt.prototype.moveBack = function (parent, element, index) {
  	element.classList.remove(this.daClassname);
  	if (parent.children[index] !== undefined) {
  		parent.children[index].insertAdjacentElement('beforebegin', element);
  	} else {
  		parent.insertAdjacentElement('beforeend', element);
  	}
  }

  // Функция получения индекса внутри родителя
  DynamicAdapt.prototype.indexInParent = function (parent, element) {
  	const array = Array.prototype.slice.call(parent.children);
  	return Array.prototype.indexOf.call(array, element);
  };

  // Функция сортировки массива по breakpoint и place
  // по возрастанию для this.type = min
  // по убыванию для this.type = max
  DynamicAdapt.prototype.arraySort = function (arr) {
  	if (this.type === "min") {
  		Array.prototype.sort.call(arr, function (a, b) {
  			if (a.breakpoint === b.breakpoint) {
  				if (a.place === b.place) {
  					return 0;
  				}

  				if (a.place === "first" || b.place === "last") {
  					return -1;
  				}

  				if (a.place === "last" || b.place === "first") {
  					return 1;
  				}

  				return a.place - b.place;
  			}

  			return a.breakpoint - b.breakpoint;
  		});
  	} else {
  		Array.prototype.sort.call(arr, function (a, b) {
  			if (a.breakpoint === b.breakpoint) {
  				if (a.place === b.place) {
  					return 0;
  				}

  				if (a.place === "first" || b.place === "last") {
  					return 1;
  				}

  				if (a.place === "last" || b.place === "first") {
  					return -1;
  				}

  				return b.place - a.place;
  			}

  			return b.breakpoint - a.breakpoint;
  		});
  		return;
  	}
  };

  const da = new DynamicAdapt("max");
  da.init();


  // $(document).on('click', '.search__items button.ico_plus', function(){
  //   $('.search__result').addClass('is-show');
  //   $('.result-clear').addClass('is-show');
  // });

  // $(document).on('click', '.result-item__del', function(){
  //   $(this).closest('.result-item').remove();
  // });

  // $(document).on('click', '.result-clear', function(){
  //   $('.search__result').removeClass('is-show');
  //   $('.result-clear').removeClass('is-show');
  // });
  $(".sidebar-menu__link").click(function(e) {
    $('.sidebar-menu__link').removeClass('is-active'),
    $(".sidebar-menu__dropdown").slideUp(),
    $(this).next().is(":visible") || $(this).addClass('is-active').next().slideDown(),
    e.stopPropagation()
  });

  $(document).on('click', '.page-sidebar__btn', function(){
    $(this).toggleClass('is-active');
    $('.page-sidebar__drop').toggleClass('is-active');
    $('.page-wrapper').toggleClass('is-show-menu');
  });

  $(document).mouseup(function (e){
    var div = $(".page-sidebar");
    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $('.page-sidebar__btn').removeClass('is-active');
      $('.page-sidebar__drop').removeClass('is-active');
      $('.page-wrapper').removeClass('is-show-menu');
    }
  });

  $('.--instructions .sidebar-menu__link').click(function(){
    $('.page-sidebar__btn').removeClass('is-active');
    $('.page-sidebar__drop').removeClass('is-active');
    $('.page-wrapper').removeClass('is-show-menu');
  });
  if(document.querySelector('.order-history__more')) {
      const orderDropdowns = document.querySelectorAll('.order-history__more');
      for (const orderDropdown of orderDropdowns) {
          orderDropdown.addEventListener('click', function(){
              this.classList.toggle('active');
              var panel = this.previousSibling;
              if (panel.style.maxHeight){
                  panel.style.maxHeight = null;
              } else {
                  panel.style.maxHeight = panel.scrollHeight + "px";
              }
          })
      }
  }
  /* --------------------- Проверка на совпадение паролей --------------------- */
  $("._pass-2").blur(function() {
    let pass1 = $(this).closest('._pass-form').find("._pass-1").val();
    let pass2 = $(this).closest('._pass-form').find("._pass-2").val();
    if (pass1 !== pass2) {
      $(this).closest('._pass-form').addClass('is-invalid');
      $("._pass-2").addClass('is-invalid');
    } else {
      $(this).closest('._pass-form').removeClass('is-invalid');
      $("._pass-2").removeClass('is-invalid');
    }
  });

  /* ------------------------ Проверка сложности пароля ----------------------- */
  $("._pass._pass-1").keyup(function() {
    var pass = $("._pass._pass-1").val();
    check(pass);
  });
  function check(pass) {
    var protect = 0;
    // Проверка на кол-во символов
    if(pass.length >= 8) { protect++; }
    // Проверка на наличие символов a,s,d,f ... x,y,z
    var small = "([a-z]+)";
    if(pass.match(small)) { protect++; }
    // Проверка на наличие символов A,B,C,D ... X,Y,Z
    var big = "([A-Z]+)";
    if(pass.match(big)) { protect++; }
    // Проверка на наличие символов 1,2,3,4,5 ... 0
    var numb = "([0-9]+)";
    if(pass.match(numb)) { protect++; }
    //  Проверка на наличие символов !@#$
    var vv = /\W/;
    if(pass.match(vv)) { protect++; }
    // Добавление классов
    if(protect >= 1) {
      $("._password-quality > li.one").addClass('_active');
      $('._password-quality').addClass('easy');
      $('._password-quality-title').addClass('easy');
    } else {
      $("._password-quality > li.one").removeClass('_active');
      $('._password-quality').removeClass('easy');
      $('._password-quality-title').removeClass('easy');
    }
    if(protect >= 2) {
      $("._password-quality > li.two").addClass('_active');
      $('._password-quality').removeClass('easy');
      $('._password-quality-title').removeClass('easy');
      $('._password-quality').addClass('normal');
      $('._password-quality-title').addClass('normal');
    } else {
      $("._password-quality > li.two").removeClass('_active');
      $('._password-quality').removeClass('normal');
      $('._password-quality-title').removeClass('normal');
    }
    if(protect >= 3) {
      $("._password-quality > li.three").addClass('_active');
      $('._password-quality').removeClass('normal');
      $('._password-quality-title').removeClass('normal');
      $('._password-quality').addClass('good');
      $('._password-quality-title').addClass('good');
    } else {
      $("._password-quality > li.three").removeClass('_active');
      $('._password-quality').removeClass('good');
      $('._password-quality-title').removeClass('good');
    }
    if(protect >= 4) {
      $("._password-quality > li.four").addClass('_active');
    } else {
      $("._password-quality > li.four").removeClass('_active');
    }
    if(protect >= 5) {
      $("._password-quality > li.five").addClass('_active');
    } else {
      $("._password-quality > li.five").removeClass('_active');
    }
  }
  $(document).on('click', '.js-clear-date', function () {
    $(this).closest('.js-date-group').find('input').val('');
  });
  $(document).on('click', '.custome-accordion-button', function () {
    let $accordion_item = $(this).closest('.custome-accordion-item');
    let $accordion_item_box = $accordion_item.find('.custome-accordion-content');
    $accordion_item.toggleClass('--open');
    $accordion_item_box.slideToggle();
  });
  $(document).on('click', '.js-remove-item', function () {
    $(this).closest('.custome-accordion-item').remove();
  });
  $(document).on('click', '.js-accordion-add-item', function () {
    let $box = $(this).closest('.js-accordion-add-subdivision');
    let $accordion = $box.find('.custome-accordion');
    let $accordion_item = $accordion.find('.custome-accordion-item:last');
    let $accordion_item_id = parseInt($accordion_item.data('id')) + 1;
    let $accordion_item_clone = $accordion_item.clone();
    $accordion_item.removeClass('--open').find('.custome-accordion-content').slideToggle();
    $accordion_item_clone.attr('data-id', $accordion_item_id);
    $accordion_item_clone.find('.custome-accordion-button > span').text($accordion_item_id);
    $accordion.append($accordion_item_clone);
  });
  $('.select-option-box').find('.select-option-item').hide();
  $(document).on('click', '.js-show-select-option', function () {
    const box = $(this).closest('.form-group').prev('.select-option-box');

    if (box.find('.select-option-item').hasClass('is-active')) {
      let item = box.find('.select-option-item.is-active').clone();
      box.append(item.removeClass('is-active').addClass('--new'));
    } else {
      box.find('.select-option-item').addClass('is-active');
      box.find('.select-option-item').slideDown();
    }
  });
  $(document).on('click', '.js-toggle-dropdown', function () {
      $(this).closest('.custome-table__dropdown').toggleClass('is-show');
      $(this).closest('.custome-table__dropdown-title').next('.custome-table__dropdown-content').slideToggle();
      $(document).trigger('toggle-dropdown.toggled', [this]);
  });
  $(document).on('click', '.js-show-person-box', function () {
    const box = $(this).closest('.person-box');

    if (box.find('.person-box__body').hasClass('is-active')) {
      let item = box.find('.person-box__body').clone();
      box.append(item.addClass('--new'));
    } else {
      box.find('.person-box__body').addClass('is-active');
      box.find('.person-box__body').slideDown();
    }
  });
  $(document).on('click', '.js-hide-person-box', function () {
    const box = $(this).closest('.person-box');
    box.find('.person-box__body.--new').remove();
    box.find('.person-box__body').removeClass('is-active').slideUp();
    box.find('.person-box__body').find('input[type="text"]').val('');
  });
  $(document).on('input', '.search__controls > input, .search__controls .tagger-new > input', function () {
    let textLenght = $(this).val().length;

    if (textLenght >= 1) {
      $(this).closest('.search').addClass('is-active');
      $(this).closest('.search').find('.search__drop').addClass('is-show');
      $('.search__overlay').addClass('is-show');
      $('body').addClass('no-scroll');
    } else {
      $('.search').removeClass('is-active');
      $(this).closest('.search').find('.search__drop').removeClass('is-show');
      $('.search__overlay').removeClass('is-show');
      $('body').removeClass('no-scroll');
    }
  });
  $(document).on('click', '.search__close, .search__btn button', function () {
    $('.search__drop').removeClass('is-show');
    $('.search__overlay').removeClass('is-show');
    $('.search').removeClass('is-active');
  });
  $(document).on('click', function (e) {
    if (!$(e.target).closest(".search").length) {
      $('.search__drop').removeClass('is-show');
      $('.search__overlay').removeClass('is-show');
      $('.search').removeClass('is-active');
      $('body').removeClass('no-scroll');
    }

    e.stopPropagation();
  });
  $(document).on('input', '.sidebar-search input', function () {
    let textLenght = $(this).val().length;

    if (textLenght > 0) {
      $(this).closest('.sidebar-search').find('.form-control-clear').addClass('--active');
    } else {
      $(this).closest('.sidebar-search').find('.form-control-clear').removeClass('--active');
    }
  });
  $(document).on('click', '.form-control-clear', function () {
    $(this).closest('.sidebar-search').find('.form-control').val('');
    $(this).removeClass('--active');
  });
  $(document).on('click', '.js-change', function () {
    let numb = $(this).closest('tr').find('.js-art').text();
    let tags = `<li>
                  <a href="/tag/${numb}" target="_black">
                    <span class="label">${numb}</span>
                    <span class="close">×</span>
                  </a>
                </li>`;
    $(tags).prependTo('.search__result-box .tagger > ul');
    $('.search__result-box .tagger > input.js-tags').val(numb + ', ' + $('.search__result-box .tagger > input.js-tags').val());
  });
  $(document).on('keyup', '.js-password', function () {
    var reg = /[а-яА-ЯёЁ]/g;

    if (this.value.search(reg) != -1) {
      $('.js-cirilick').addClass('is-show');
    } else {
      $('.js-cirilick').removeClass('is-show');
    }
  });
  $('.js-password').capsChecker({
    capson: function (e, isOn) {
      $('.js-capslock').addClass('is-show');
    },
    capsoff: function (e, isOn) {
      $('.js-capslock').removeClass('is-show');
    }
  });
  var langList = new Swiper(".js-lang-list", {
    slidesPerView: "4",
    scrollbar: {
      el: ".swiper-scrollbar",
      draggable: true
    },
    mousewheel: true
  });
  $(document).on('click', '.button-change', function () {
    $(this).toggleClass('is-change');
  });
  $(document).on('input', '.form-control-file__text > input', function () {
    let textLenght = $(this).val().length;
    let box = $(this).closest('.form-control-file');
    let boxUpload = box.find('.form-control-file__upload');

    if (textLenght >= 1) {
      boxUpload.addClass('is-not-active');
    } else {
      boxUpload.removeClass('is-not-active');
    }
  });
  $('.form-control-file__upload > input').bind('change', function () {
    let ths = $(this);
    let name = this.files[0].name;
    let nameBox = ths.closest('.form-control-file').find('.upload-result-text');
    let textBox = ths.closest('.form-control-file').find('.form-control-file__text');
    let uploadBox = ths.closest('.form-control-file').find('.form-control-file__upload');
    let resultBox = ths.closest('.form-control-file').find('.form-control-file__upload-result-text');
    nameBox.text(name);
    resultBox.addClass('is-active');
    textBox.hide();
    uploadBox.hide();
  });
  $(document).on('click', '.upload-result-icon', function () {
    let ths = $(this);
    let nameBox = ths.closest('.form-control-file').find('.upload-result-text');
    let textBox = ths.closest('.form-control-file').find('.form-control-file__text');
    let uploadBox = ths.closest('.form-control-file').find('.form-control-file__upload');
    let resultBox = ths.closest('.form-control-file').find('.form-control-file__upload-result-text');
    nameBox.text('');
    resultBox.removeClass('is-active');
    textBox.show();
    uploadBox.show();
  });
  $(document).on('click', '.js-select-user-type', function () {
    $(this).next('.select-user-type').toggleClass('is-show');
  });
  $(document).on('click', '.select-user-type .ico_close', function () {
    $(this).closest('.select-user-type').toggleClass('is-show');
  });
  $('.js-multiselect').multiselect({
    nSelectedText: 'выбрано',
    maxHeight: 230,
    numberDisplayed: 4,
    templates: {
      button: '<button type="button" class="multiselect dropdown-toggle" data-bs-toggle="dropdown"><span class="multiselect-selected-text"></span></button>'
    },
    onChange: function (option, checked) {
      var selectedOptions = $('.js-multiselect option:selected');

      if (selectedOptions.length >= 1) {
        $('.js-multiselect .multiselect').addClass('is-active');
      }
    }
  });
  $('input.js-daterange').daterangepicker({
    "opens": 'left',
    "drops": 'auto',
    "autoApply": true,
    "locale": {
      "format": "MM/DD/YYYY",
      "separator": " - ",
      "applyLabel": "Apply",
      "cancelLabel": "Cancel",
      "fromLabel": "From",
      "toLabel": "To",
      "customRangeLabel": "Custom",
      "weekLabel": "W",
      "daysOfWeek": ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
      "monthNames": ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
      "firstDay": 1
    }
  });
  $("table .js-more").each(function () {
    if ($(this).height() > 35) {
      $(this).addClass('hide');
    } else {
      $(this).next('.more-show').remove();
      $(this).next('.more-hide').remove();
    }
  });
  $(document).on('click', '.more-show', function () {
    $(this).prev('.js-more').removeClass('hide');
  });
  $(document).on('click', '.more-hide', function () {
    $(this).prev().prev('.js-more').addClass('hide');
  });
  $(document).on('click', 'button.blocked', function () {
    $(this).toggleClass('is-active');
    $('body').toggleClass('page-is-blocked');
  });
  $(document).on('click', '.icon-status.ico_checkmark:not(".js-free")', function () {
    $(this).toggleClass('is-active');
  }); // Example starter JavaScript for disabling form submissions if there are invalid fields

  (function () {
    'use strict'; // Fetch all the forms we want to apply custom Bootstrap validation styles to

    var forms = document.querySelectorAll('.needs-validation'); // Loop over them and prevent submission

    Array.prototype.slice.call(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add('was-validated');
      }, false);
    });
  })();

  $(document).on('click', '.js-show-on, .js-show-off', function () {
    $('.login-form-on').slideToggle();
    $('.login-form-off').slideToggle();
  });
  $(document).on('click', '.search-select-list li', function () {
    let numb = $(this).attr('data-coutry-number');
    $('.js-phone-country').text(numb);
    let serchItems = document.querySelectorAll('.search-select-list li');

    for (const serchItem of serchItems) {
      serchItem.classList.remove('is-selected');
    }

    $(this).addClass('is-selected');
  });
  $(document).on('click', '.js-add-characteristic', function () {
    let btnBox = $(this).closest('.page-save');
    cloneEl = btnBox.prev().clone();
    btnBox.prepend(cloneEl);
  });
  /* ------------------------- Показать/Скрыть пароль ------------------------- */

  $(document).on('click', '.show-password', function () {
    let $inputPass = $(this).closest('._pass-form').find('input.js-password');

    if ($inputPass.attr('type') == 'password') {
      $(this).addClass('_active');
      $inputPass.attr('type', 'text');
    } else {
      $(this).removeClass('_active');
      $inputPass.attr('type', 'password');
    }

    return false;
  });
  $(document).on('click', 'table .js-select-all', function () {
    let $table = $(this).closest('table');
    let $checkboxs = $table.find('tbody td:first-child input[type="checkbox"]');

    if ($(this).find('input[type="checkbox"]').prop('checked')) {
      $checkboxs.prop("checked", true);
    } else {
      $checkboxs.prop("checked", false);
    }
  });
  $(document).on('click', '.id-adress', function () {
    if ($(this).hasClass('--locked')) {
      $(this).removeClass('--locked').addClass('--unlocked');
    } else {
      $(this).removeClass('--unlocked').addClass('--locked');
    }
  });
  $(document).on('click', '.page-sidebar__lang ul li a', function () {
    $('.page-sidebar__lang ul li a').removeClass('active');
    $(this).addClass('active');
  });
  $(document).on('click', '.uploads-item__del', function () {
    $(this).closest('.uploads-item').parent().remove();
    let uploadItemsCount = $('.uploads-grid > *').length;
    if (uploadItemsCount <= 1) $('.uploads-main-img').hide();
  });
  $(document).on('click', '.uploads-item__btn', function () {
    let bg = $(this).closest('.uploads-item').attr('style');
    $('.uploads-main-img .uploads-item').attr('style', bg);
    $('.uploads-main-img').show();
  });
  $(document).on('click', '.action-drop__btn', function () {
    $(this).closest('.action-drop').addClass('is-show');
  });
  $(document).on('click', '.action-drop__close', function () {
    $(this).closest('.action-drop').removeClass('is-show');
  });
  $(document).mouseup(function (e) {
    var div = $(".action-drop");

    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $('.action-drop').removeClass('is-show');
    }
  });
  $(document).on('click', '.action-drop__item button.ico_trash2', function () {
    $(this).closest('.action-drop__item').remove();
  });
  $(document).on('click', '.js-del-option', function () {
    $(this).closest('.option-item').parent().remove();
  });
  $(document).on('click', '.js-copy-row', function () {
    let cloneRow = $(this).closest('table').find('tbody').find('tr:first-child').clone();
    $(this).closest('table').find('tbody').append(cloneRow);
  });
  $(document).on('click', '.js-change', function () {
    $(this).toggleClass('is-active');
  });
  // $('input[type="number"]').on('input', function () {
  //   $(this).val($(this).val().replace(/[A-Za-zА-Яа-яЁё]/, ''));
  // });
  $(document).on('click', '.table-banner-row input[type="checkbox"]', function () {
    let $actionBtn = $(this).closest('.table-banner-row').find('.js-change-btn');

    if ($(this).prop('checked')) {
      $actionBtn.addClass('is-active');
    } else {
      $actionBtn.removeClass('is-active');
    }
  });
  $(document).on('click', '.js-change-btn', function () {
    let $checkbox = $(this).closest('.table-banner-row').find('input[type="checkbox"]');
    $(this).toggleClass('is-active');

    if ($checkbox.prop('checked')) {
      $checkbox.prop("checked", false);
    } else {
      $checkbox.prop("checked", true);
    }
  });
  $(document).on('click', '.add-social__item.is-active .add-social__btn', function () {
    $(this).closest('.add-social__item').find('.add-social__text').text('');
    $(this).closest('.add-social__item').removeClass('is-active');
  });
  $(document).on('click', '.lang-list a', function () {
    $('.lang-list a').removeClass('is-active');
    $(this).addClass('is-active');
  }); // var logo = {
  //   container: document.getElementById('logo_animate'),
  //   renderer: 'svg',
  //   loop: true,
  //   autoplay: true,
  //   rendererSettings: { progressiveLoad:false, preserveAspectRatio: 'xMidYMid slice' },
  //   path: 'assets/js/animated/logo.json',
  // };
  // var logo_anim;
  // logo_anim = lottie.loadAnimation(logo);

  var params = {
    container: document.getElementById('logo_animate'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: '/assets/js/logo_animate.json'
  };
  var anim;
  anim = lottie.loadAnimation(params);
  $(document).on('focus', '.js-date-popap', function () {
    var myModal = new bootstrap.Modal(document.getElementById('m-select-date'));
    myModal.show();
  });
  $('.calendar-item').datepicker({
    inline: true,
    range: true,
    multipleDates: true,
    multipleDatesSeparator: "-",
    autoClose: true
  });
  if ($("input#desctop-left").is(':checked')) $(".desctop-view__box").removeClass("right top").addClass("left");
  $("input#desctop-left").on("change", function () {
    $(".desctop-view__box").removeClass("right top").addClass("left");
  });
  if ($("input#desctop-right").is(':checked')) $(".desctop-view__box").removeClass("left top").addClass("right");
  $("input#desctop-right").on("change", function () {
    $(".desctop-view__box").removeClass("left top").addClass("right");
  });
  if ($("input#desctop-top").is(':checked')) $(".desctop-view__box").removeClass("left right").addClass("top");
  $("input#desctop-top").on("change", function () {
    $(".desctop-view__box").removeClass("left right").addClass("top");
  });
  if ($("input#mobile-left").is(':checked')) $(".mobile-view__box").removeClass("right top").addClass("left");
  $("input#mobile-left").on("change", function () {
    $(".mobile-view__box").removeClass("right top").addClass("left");
  });
  if ($("input#mobile-right").is(':checked')) $(".mobile-view__box").removeClass("left top").addClass("right");
  $("input#mobile-right").on("change", function () {
    $(".mobile-view__box").removeClass("left top").addClass("right");
  });
  $(document).on('click', '.js-dropdown .radio__box', function () {
    $(this).closest('.js-dropdown').find('.dropdown-toggle > span').text($(this).text());
  });
  $(document).on('click', '.js-dropdown-select .dropdown-select-item', function () {
    $(this).closest('.js-dropdown-select').find('.dropdown-select-item').removeClass('is-active');
    $(this).addClass('is-active');
    $(this).closest('.js-dropdown-select').find('.dropdown-toggle > span').text($(this).find('.dropdown-select-item__txt').text());
  });
  $(document).on('click', '.copy-item .ico_plus', function () {
    //let block = $(this).closest('.copy-block'); // let item = $(this).closest('.copy-item');
    // block.append(item.clone());

   // let item = $(this).closest('.copy-item').clone();
   // let btn = item[0].querySelector('.ico_plus');
   // btn.classList.remove('ico_plus');
    //btn.classList.add('ico_close');
   // block.append(item.addClass('--new'));
   // $('.js-phone').inputmask({
   //   "mask": "+38(999) 999-99-99"
   // });
  });
  $(document).on('click', '.copy-item .ico_close', function () {
    //let block = $(this).closest('.copy-block');
    //let item = $(this).closest('.copy-item').remove();
  });
  $(document).on('click', '.select-products-item .ico_remove', function () {
    $(this).closest('.select-products-item').remove();
  });

  if (document.querySelector('.copy-section__btn')) {
    const copyBtns = document.querySelectorAll('.copy-section__btn');

    for (const copyBtn of copyBtns) {
      copyBtn.addEventListener('click', function () {
        const copyCont = this.closest('.copy-section'),
              copyItem = copyCont.querySelector('.copy-section__item').cloneNode(true),
              copyBtnCont = this.closest('.form-group');
        copyCont.insertBefore(copyItem, copyBtnCont);
      });
    }
  }

  if (document.getElementById("wheelPicker")) {
    const wheelPicker = new iro.ColorPicker("#wheelPickerHolder", {
      width: 250,
      color: '#D4014C',
      display: 'grid',
      margin: 0,
      handleRadius: 15,
      layout: [{
        component: iro.ui.Wheel
      }, {
        component: iro.ui.Slider,
        options: {
          sliderType: 'saturation',
          handleRadius: 12
        }
      }, {
        component: iro.ui.Slider,
        options: {
          sliderType: 'value',
          handleRadius: 12
        }
      }]
    });
    window.wheelColorPicker = wheelPicker;
    const colorInput = document.querySelector('.select-color-input');
    colorInput.addEventListener('change', function () {
      wheelPicker.color.hexString = this.value;
    });
    wheelPicker.on('color:change', function (color) {
      // if the first color changed
      if (color.index === 0) {
        // log the color index and hex value
        const previweColor = document.querySelector('.select-color-previve');
        const previweColorInner = document.querySelector('.select-color-previve__inner');
        const selectedColor = color.hexString;
        colorInput.value = selectedColor.toUpperCase();
        previweColor.style.background = selectedColor;
        previweColorInner.style.background = selectedColor;
      }
    });

    if (document.querySelector('.color-button')) {
      const selectColorButton = document.querySelector('.button-select-color'),
            colorHolder = document.querySelector('.color-button');
      selectColorButton.addEventListener('click', function () {
        colorHolder.innerHTML = wheelPicker.color.hexString.toUpperCase();
      });
    }
  }
});
