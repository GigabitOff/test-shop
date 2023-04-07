jQuery(document).ready(function ($) {
  // All scripts
  // Запрет пробела первым символом
  var input = document.querySelector('.search__input');
  input.oninput = () => {
    if(input.value.charAt(0) === ' ') {
      input.value = '';
    }
  }
  
  $('input[type="number"]').on('input', function() {
    $(this).val($(this).val().replace(/[A-Za-zА-Яа-яЁё]/, ''))
  });
  
  var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
  var email = $('.js-email');
  var emailMessages = email.next('.invalid-feedback');
  
  email.blur(function(){
    if(email.val() != ''){
      if(email.val().search(pattern) == 0){
        $(this).removeClass('is-invalid');
      }else{
        emailMessages.text('Введите email в правильном формате');
        $(this).addClass('is-invalid');
      }
    }else{
      $(this).addClass('is-invalid');
      emailMessages.text('Поле e-mail не должно быть пустым');
    }
  });
  
  email.on('keyup paste', function() {
    if (this.value && /[^_a-zA-Z0-9@\-.]/i.test(this.value)) {
      email.trigger('input');
      emailMessages.text('Только латинские буквы');
      $(this).addClass('is-invalid');
    } else {
      emailMessages.text('');
      $(this).removeClass('is-invalid');
    }
  });
  
  // Запрет ввода кириллицы
  $('.js-no-cyrillic').keyup(function () {
    if (!this.value.match(/^[a-zA-Z0-9@]+$/)) {
      this.value = this.value.replace(/[^a-zA-Z0-9@]/g, '');
    }
  });
  
  $('.js-date').datepicker({autoClose: true,});
  $('.js-select').niceSelect();
  $('.js-phone').inputmask({"mask": "+38(999) 999-99-99"});
  // Кнопки дейсвий в таблице
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
  $(document).on('click', '.counter .minus', function(event) {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
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
  $(document).on("click", ".drop-menu", function() {
    if(document.documentElement.clientWidth <= 767){
      var is_open = $(this).hasClass("open");
      if (is_open) {
        $(this).removeClass("open");
      } else {
        $(this).addClass("open");
      }
    }
  });
  
  $(document).on("click", ".drop-menu li", function() {
    if(document.documentElement.clientWidth <= 767){
      var selected_value = $(this).html();
      var first_li = $(".drop-menu li:first-child").html();
      $(".drop-menu li:first-child").html(selected_value);
      $(this).html(first_li);
    }
  });
  
  $(document).on("mouseup", function(event) {
    var target = event.target;
    var select = $(".drop-menu");
    if (!select.is(target) && select.has(target).length === 0) {
      select.removeClass("open");
    }
  });
  /* -------------------------------- Dropdown -------------------------------- */
  
  $('.drop input').attr('autocomplete', 'off');
  
  // $('.drop input').before('<span class="drop-clear"></span>');
  
  $(document).on('click', '.drop-button', function(){
    $('.drop').removeClass('_active');
    $('.drop-box').hide();
    $(this).closest('.drop').find('.drop-box').show();
    $(this).closest('.drop').addClass('_active');
  });
  
  $(document).on('focus', '.drop input', function(){
    $('.drop').removeClass('_active');
    $('.drop-box').hide();
    $(this).closest('.drop').find('.drop-box').show();
    $(this).closest('.drop').addClass('_active');
  });
  
  $(document).on('input', '.drop input', function(){
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
    $(this).closest('.drop').removeClass('_active');
    $(this).closest('.drop').removeClass('_active-close');
    $(this).closest('.drop').find('.drop-box').hide();
  });
  
  $(document).on('click', '.drop-box .drop-list-item', function(){
    let currentVal = $(this).html();
    let regex      = /<\/?\w+[^>]*\/?>/g;
    let currentTxt = $(this).html().replace(regex, "");
    console.log("🚀 ~ file: dropdown.js ~ line 45 ~ $ ~ currentTxt", currentTxt)
    $(this).closest('.drop').find('.form-control').val(currentTxt);
    $(this).closest('.drop').find('.drop-button').html(currentVal);
    $(this).closest('.drop').find('.drop-clear').addClass('_active');
    $(this).closest('.drop').addClass('_active-close');
    $('.drop-box').hide();
    $('.drop').removeClass('_active');
    $('.drop').removeClass('_active-close');
  });
  
  $(document).on('click', function(e) {
    if (!$(e.target).closest(".drop").length) {
      $('.drop').removeClass('_active _active-close');
      $('.drop-box').hide();
    }
    e.stopPropagation();
  });
  $(document).on('click', '.js-dropdown-sort .dropdown-item', function(){
    $('.dropdown-item').removeClass('_active');
    $(this).addClass('_active');
    let current = $(this).text();
    $(this).closest('.dropdown').find('.dropdown-toggle>span').text(current);
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
  
  $(document).on('click', '.upload-unit__trash', function(){
    let ths  = $(this);
    ths.closest('.upload-file-block').find('input.upload-file-block__input').val('');
    ths.closest('.upload-unit').remove();
  });
  /* ----------------------------- Таблица Footable ---------------------------- */
  
  $('.js-table').footable({
    "empty": "Таблица пуста",
    "toggleColumn": "last",
    "paging": {
      "enabled": true,
      "container": "#table-nav",
      "limit": 3,
      "position": "right",
      "countFormat": "{CP} / {TP}",
      "size": 5
    }
  });
  
  $(document).on('click', '.js-page-size .drop-list-item', function (e) {
    var newSize = $(this).attr('data-page-size');
    console.log(newSize);
    FooTable.get('.js-table').pageSize(newSize);
  });
  
  $(document).on('click', '.js-table tbody button.ico_trash', function(){
    $(this).closest('tr').remove()
  });
  
  $(document).on('click', '.button-icon.ico_trash', function(){
    $(this).closest('tr').remove();
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
  
  
  if(document.querySelector('.js-select-all')) {
    const table = document.querySelector('.js-table')
    const check = document.querySelector('.js-select-all')
  
    if(table.contains(check)) {
        table.addEventListener('change', function (evt) {
          var el = evt.target.closest('.check');
  
          if (el.classList.contains('js-select-all')) {
            return
          } else {
            table.querySelector('.js-select-all .check__input').checked = false
          }
      });
    }
  }
  $('.order-block').hide();
  $('.delivery-content').hide();
  $('.pay-content').hide();
  $('.pay-manager-content').hide();
  $('.customer-content').hide();
  $('.counterparty-content').hide();
  
    $(document).on('click', '.order-select-current', function(){
      $('.order-select').removeClass('is-active');
      $(this).closest('.order-select').addClass('is-active');
    });
  
    $(document).on('click', '.order-select-box li', function(){
      let $currentVal    = $(this).html();
      let $selectBox     = $(this).closest('.order-select');
      let $selectCurent  = $selectBox.find('.order-select-current span');
      $selectCurent.html($currentVal);
      $selectBox.removeClass('is-active');
    });
  
    $(document).on('click', function(e) {
      if (!$(e.target).closest(".order-select").length) {
        $('.order-select').removeClass('is-active');
      }
      e.stopPropagation();
    });
  
    $('.js-group-option .group-option-item').hide();
    $('.js-group-option').each(function(){
      var value = $(this).find('input[type="radio"]:checked').val();
      $(".js-"+ value).show();
    });
  
    $(document).on('click', '.js-group-option label.check', function(){
      $(this).closest('.js-group-option').find('.group-option-item').hide();
      let val = $(this).find('input.check__input').val();
      $(this).closest('.js-group-option').find(".js-"+ val).show();
    });
  
    $(document).on('click', '.js-select-pay .order-select-box li', function(){
      $('.order-block.--pay').show();
    });
  
    $(document).on('click', '.js-pay-1', function(){
      $('.pay-content').hide();
      $('.js-pay-content-1').show();
    });
  
    $(document).on('click', '.js-pay-2', function(){
      $('.pay-content').hide();
      $('.js-pay-content-2').show();
    });
  
    $(document).on('click', '.js-pay-3', function(){
      $('.pay-content').hide();
      $('.js-pay-content-3').show();
    });
  
    $(document).on('click', '.js-select-delivery .order-select-box li', function(){
      $('.order-block.--delivery').show();
    });
  
    $(document).on('click', '.js-delivery-1', function(){
      $('.delivery-content').hide();
      $('.js-delivery-content-1').show();
    });
  
    $(document).on('click', '.js-delivery-2', function(){
      $('.delivery-content').hide();
      $('.js-delivery-content-2').show();
    });
  
    $(document).on('click', '.js-delivery-3', function(){
      $('.delivery-content').hide();
      $('.js-delivery-content-3').show();
    });
  
    $(document).on('click', '.js-delivery-4', function(){
      $('.delivery-content').hide();
      $('.js-delivery-content-4').show();
    });
  
    $(document).on('click', '.js-delivery-5', function(){
      $('.delivery-content').hide();
      $('.js-delivery-content-5').show();
    });
  
    $(document).on('click', '.js-select-customer .order-select-box li', function(){
      $('.order-block.--customer').show();
    });
  
    $(document).on('click', '.js-customer-1', function(){
      $('.customer-content').hide();
      $('.js-customer-content-1').show();
    });
  
    $(document).on('click', '.js-customer-2', function(){
      $('.customer-content').hide();
      $('.js-customer-content-2').show();
    });
  
    $(document).on('click', '.js-customer-3', function(){
      $('.customer-content').hide();
      $('.js-customer-content-3').show();
    });
  
    $(document).on('click', '.js-select-counterparty .order-select-box li', function(){
      $('.order-block.--counterparty').show();
    });
  
    $(document).on('click', '.js-counterparty-1', function(){
      $('.counterparty-content').hide();
      $('.js-counterparty-content-1').show();
    });
  
    $(document).on('click', '.js-counterparty-2', function(){
      $('.counterparty-content').hide();
      $('.js-counterparty-content-2').show();
    });
  
    $(document).on('click', '.js-counterparty-3', function(){
      $('.counterparty-content').hide();
      $('.js-counterparty-content-3').show();
    });
  
    $(document).on('click', '.js-select-client .order-select-box li', function(){
      $('.order-block.--client').show();
    });
  
    $(document).on('click', '.js-client-1', function(){
      $('.customer-content').hide();
      $('.js-customer-content-1').show();
    });
  
    $(document).on('click', '.js-client-2', function(){
      $('.customer-content').hide();
      $('.js-customer-content-2').show();
    });
  
    $(document).on('click', '.js-client-3', function(){
      $('.customer-content').hide();
      $('.js-customer-content-3').show();
    });
  
    $(document).on('click', '.js-add-comment', function(){
      $('.order-form-values').show();
      $('.order-block.--comment').show();
    });
  
    $(document).on('click', '.js-select-pay-manager .order-select-box li', function(){
      $('.order-block.--pay-manager').show();
    });
  
    $(document).on('click', '.js-pay-manager-1', function(){
      $('.pay-manager-content').hide();
      $('.js-pay-manager-content-1').show();
    });
  
    $(document).on('click', '.js-pay-manager-2', function(){
      $('.pay-manager-content').hide();
      $('.js-pay-manager-content-2').show();
    });
  
    $(document).on('click', '.js-add-phone .drop-list-item', function(){
      $('.add-phone').show();
    });
  
    $(document).on('click', '.js-add-phone .drop-clear', function(){
      $('.add-phone').hide();
    });
  
    $(document).on('input', '.js-add-phone.drop input', function(){
      let val = $(this).val();
      if( val.length >= 1 ) {
        $('.add-phone').show();
      } else {
        $('.add-phone').hide();
      }
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
  scrollTo('._scrollto', 120);
  function scrollTo(element, offset) {
    if(element) {
      document.querySelectorAll(element).forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            let href = this.getAttribute('href').substring(1);
            const scrollTarget = document.getElementById(href);
            const topOffset = offset; // если не нужен отступ сверху
            const elementPosition = scrollTarget.getBoundingClientRect().top;
            const offsetPosition = elementPosition - topOffset;
            window.scrollBy({
                top: offsetPosition,
                behavior: 'smooth'
            });
        });
      });
    }
  }
  $(document).on('click', '.js-dropdown .dropdown-item', function(){
    let currentVal = $(this).text();
    $(this).closest('.js-dropdown').find('.dropdown-toggle').text(currentVal);
    $(this).closest('.js-dropdown').find('.dropdown-item').removeClass('active');
    $(this).addClass('active');
  });
  
  $(document).on('input', '.search input', function () {
    let textLenght = $(this).val().length;
    // console.log("🚀 ~ file: main.js ~ line 47 ~ textLenght", textLenght)
    if (textLenght > 0) {
      $(this).closest('.search').find('.search__clear').addClass('is-show');
      $(this).closest('.search').addClass('is-active');
      $(this).closest('.search').find('.search__icon').removeClass('is-show');
    } else {
      $(this).closest('.search').find('.search__clear').removeClass('is-show');
      $(this).closest('.search').find('.search__icon').addClass('is-show');
    }
  });
  
  $(document).on('click', '.search__clear', function () {
    $(this).removeClass('is-show');
    $(this).closest('.search').removeClass('is-active');
    $(this).closest('.search').find('.search__icon').addClass('is-show');
    $(this).closest('.search').find('input').val('');
    $(this).closest('.search').find('input').focus();
  
    let searchDropdown =  document.querySelector('.search-dropdown');
    searchDropdown.classList.remove('is-active');
  });
  
  if (document.querySelector('.search__input')) {
    const formSearchs = document.querySelectorAll('.search__input');
    let searchDropdown =  document.querySelector('.search-dropdown');
  
    for (const formSearch of formSearchs) {
  
        formSearch.addEventListener('keyup', function() {
            let searchInput =  this;
            searchDropdown.classList.add('is-active');
  
            if(searchInput.value == 0) {
                searchDropdown.classList.remove('is-active');
                searchInput.closest('.search').classList.remove('is-active');
            }
        });
    }
  }
  
  if(document.querySelector('.search-menu__item')) {
  
    document.addEventListener('mouseover', function (e) {
      if ((e.target.closest('.search-menu__item'))) {
        const menuItemTarget = e.target.closest('.search-menu__item')
  
        if(window.innerWidth > 768) {
          const searchMenusList = document.querySelector('.search-category-list');
          const searchMenuDropdowns = searchMenusList.querySelectorAll('.search-sub-menu');
          const menuItems = document.querySelectorAll('.search-menu__item');
          
          for (const menuItem of menuItems) {
            menuItem.classList.remove('is-active')
          }
          for (const searchMenuDropdown of searchMenuDropdowns) {
            searchMenuDropdown.classList.remove('is-active')
          }
          for (let i = 0; i < menuItems.length; i++) {
            if(menuItemTarget == menuItems[i]) {
              menuItems[i].classList.add('is-active')
              searchMenuDropdowns[i].classList.add('is-active');
            }
          }
          
        }
      } else  {return}
    }, false);
  
    const menuItems = document.querySelectorAll('.search-menu__item');
  
    for (let i = 0; i < menuItems.length; i++) {
      const menuItem = menuItems[i];
  
      menuItem.addEventListener('click', function(){
        if(window.innerWidth < 768) {
          const pane = this.querySelector('.search-sub-menu');
  
          if (pane.style.maxHeight) {
              pane.style.maxHeight = null;
              pane.classList.remove('is-active-mobile');
              this.classList.remove('is-active-mobile');
          } else {
              pane.style.maxHeight = pane.scrollHeight + 'px';
              pane.classList.add('is-active-mobile');
              this.classList.add('is-active-mobile');
          }
        }
      });
    }
  }
  
  $(document).on('click', '.js-menu-btn', function(){
    $('.offcanvas-overlay').addClass('is-show');
    $('.offcanvas-menu').addClass('is-show');
    $('.page-header').addClass('page-header-menu-show');
    $('body').addClass('stop-scroll');
  });
  
  $(document).on('click', '.js-menu-close', function(){
    $('.offcanvas-overlay').removeClass('is-show');
    $('.offcanvas-menu').removeClass('is-show');
    $('.page-header').removeClass('page-header-menu-show');
    $('body').removeClass('stop-scroll');
  });
  
  $(document).mouseup(function (e){
    var div = $(".offcanvas-menu");
    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $('.offcanvas-overlay').removeClass('is-show');
      $('.offcanvas-menu').removeClass('is-show');
      $('.page-header').removeClass('page-header-menu-show');
      $('body').removeClass('stop-scroll');
    }
  });
  
  $(document).on('click', '.js-add-compare', function(){
    if( !$(this).hasClass('is-active') ){
      $(this).addClass('is-active');
      let compareCol = Number($('.shop-action-item.--compare .shop-action-item__col').text());
      compareCol = ++compareCol;
      $('.shop-action-item.--compare .shop-action-item__col').text(compareCol);
    } else {
      $(this).removeClass('is-active');
      let compareCol = Number($('.shop-action-item.--compare .shop-action-item__col').text());
      compareCol = --compareCol;
      $('.shop-action-item.--compare .shop-action-item__col').text(compareCol);
    }
  });
  
  $(document).on('click', '.js-add-cart', function(){
    $(this).toggleClass('is-active');
    let cartCol = Number($('.shop-action-item.--cart .shop-action-item__col').text());
    cartCol = ++cartCol;
    $('.shop-action-item.--cart .shop-action-item__col').text(cartCol);
  });
  
  $(document).on('click', '.js-show-search', function(){
    $('.search').addClass('is-show');
    document.body.classList.add('search-opened');
  });
  
  $(document).mouseup(function (e){
    var div = $(".search__control");
    if (!div.is(e.target) && div.has(e.target).length === 0 && !e.target.closest('.search-dropdown')) {
      $('.search').removeClass('is-show');
      document.body.classList.remove('search-opened');
    }
  });
  /* -------------------------------- Валидация ------------------------------- */
  
  (function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
  })()
  
  /* ------------------------- Показать/Скрыть пароль ------------------------- */
  $(document).on('click', '.show-password', function(){
    let $inputPass = $(this).closest('.form-group').find('input.form-control');
    if ($inputPass.attr('type') == 'password'){
      $(this).addClass('_active');
      $inputPass.attr('type', 'text');
    } else {
      $(this).removeClass('_active');
      $inputPass.attr('type', 'password');
    }
    return false;
  });
  
  /* ---------- Форма регистрации показать/скрыть дополнительные поля --------- */
  if( !$('input._hide-checkbox').prop('checked') ){
    $('._hide-box').find('._hide').hide();
    $('._hide-box').find('._hide input').attr('required', false);
    $('.login-btns-group.--privat').show();
    $('.login-btns-group.--legal').hide();
  } else {
    $('._hide-box').find('._hide').show();
    $('._hide-box').find('._hide input').attr('required', true);
    $('.login-btns-group.--privat').hide();
    $('.login-btns-group.--legal').show();
  }
  $('input._hide-checkbox').on('change', function(){
    if( $('input._hide-checkbox').prop('checked') ){
      $('._hide-box').find('._hide').slideToggle();
      $('._hide-box').find('._hide input').attr('required', false);
      $('.login-btns-group.--privat').hide();
      $('.login-btns-group.--legal').show();
    } else {
      $('._hide-box').find('._hide').slideToggle();
      $('._hide-box').find('._hide input').attr('required', true);
      $('.login-btns-group.--privat').show();
      $('.login-btns-group.--legal').hide();
    }
  });
  
  /* --------------------- Проверка на совпадение паролей --------------------- */
  $("._pass-2").blur(function() {
    let pass1 = $(this).closest('._pass-form').find("._pass-1").val();
    let pass2 = $(this).closest('._pass-form').find("._pass-2").val();
    if (pass1 !== pass2) {
      $(this).closest('.form-group').find(".form-control").addClass('is-invalid');
      $("._pass-2").addClass('is-valid');
    } else {
      $(this).closest('.form-group').find(".form-control").removeClass('is-invalid');
      $("._pass-2").removeClass('is-valid');
    }
  });
  
  /* ------------------------ Проверка сложности пароля ----------------------- */
  $("._pass").keyup(function() {
    var pass = $("._pass").val();
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
  
  /* ------------------ Дополнительные поля при выборе города ----------------- */
  $(document).on('click', '#m-change-city .js-btn-yes', function(){
    $('.js-change-city-btns').slideUp();
    $('.js-change-city-yes').slideDown();
  });
  
  $(document).on('click', '#m-change-city .js-btn-no', function(){
    $('.js-change-city-btns').slideUp();
    $('.js-change-city-no').slideDown();
  });
  
  /* ----------------------------- Загрузка файлов ---------------------------- */
  $('.upload-file input[type="file"]').change(function() {
    if ($(this).val() != '') $(this).closest('.upload-file ').find('.upload-file-text').text('Обрано файлів: ' + $(this)[0].files.length);
    else $(this).closest('.upload-file ').find('.upload-file-text').text('Завантажити резюме');
  });
  
  $('#upload').change(function() {
    $(this).closest('.upload').find('.upload-placeholder').hide();
    $(this).closest('.upload').find('.upload-file-name').show();
    $(this).closest('.upload').find('.upload-file-name > span').text($('#upload')[0].files[0].name);
  });
  
  $(document).on('click', '.upload-file-name .ico_close', function(){
    $(this).closest('.upload').find('#upload').val(null);
    $(this).closest('.upload').find('.upload-placeholder').show();
    $(this).closest('.upload').find('.upload-file-name').hide();
    $(this).closest('.upload').find('.upload-file-name > span').text('');
  });
  
  const contactsSlider = new Swiper('.js-contacts-slider .swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: false,
    watchOverflow: true,
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    speed: 800,
    autoplay: {
      delay: 5000,
    },
    on: {
      slidesLengthChange: function () {
        let contactsSliderSlides = this.slides.length
        if(contactsSliderSlides == 1) {
          this.el.closest('.m-contacts').classList.add('m-contacts-single')
        }
        if(contactsSliderSlides > 1) {
          this.el.closest('.m-contacts').classList.remove('m-contacts-single')
        }
      },
    },
    navigation: {
      nextEl: '.js-contacts-slider .swiper-button-next',
      prevEl: '.js-contacts-slider .swiper-button-prev',
    },
    pagination: {
      el: '.js-contacts-slider .swiper-pagination',
      type: 'fraction', // 'bullets', 'fraction', 'progressbar'
      clickable: true,
    },
    breakpoints: {
      767: {
        slidesPerView: 'auto',
        spaceBetween: 20,
      },
    },
  });
  
  /* ----------------------------- address-list delete ---------------------------- */
  $(document).on('click', '.address-list button.ico_trash', function(){
    $(this).closest('.address-row').remove()
  });
  
  /* ----------------------------- cookie-btn-drop ---------------------------- */
  $(document).on('click', '.js-cookie-btn-drop', function(){
    $(this).remove();
    $('.cookie-drop').fadeIn();
  });
  if(document.querySelector('.hero-menu__item--parent')) {
    const menuLinks = document.querySelectorAll('.hero-menu__item--parent'),
    subMenus = document.querySelectorAll('.hero-menu__submenu'),
    menuCont = document.querySelector('.hero__inner'),
    menuHolder = menuCont.querySelector('.hero-menu-wrap'),
    catalogBtn = document.querySelector('.catalog-full-btn');
  
    catalogBtn.addEventListener('click', function(e){
      e.preventDefault();
      menuHolder.classList.toggle('is-fixed');
      menuCont.classList.toggle('is-fixed');
      this.classList.toggle('is-fixed')
      document.body.classList.toggle('stop-scroll')
    });
  
    
    menuCont.addEventListener('click', function(e) {
      if (e.target !== this) {
          return;
      } else {
        menuHolder.classList.remove('is-fixed');
        menuCont.classList.remove('is-fixed');
        this.classList.remove('is-fixed')
        document.body.classList.remove('stop-scroll');
      }
    });
  
    menuCont.addEventListener('mouseleave', function(){
  
      if(menuHolder.classList.contains('is-fixed')) {
        return
      } else {
        for (const menuLink of menuLinks) {
          menuLink.classList.remove('is-active');
        }
        for (const subMenu of subMenus) {
          subMenu.classList.remove('is-active');
        }
      }
    });
  
    for (let i = 0; i < menuLinks.length; i++) {
      const menuLink = menuLinks[i];
      menuLink.addEventListener('mouseenter', function(){
        for (const menuLink of menuLinks) {
          menuLink.classList.remove('is-active')
        }
        for (const subMenu of subMenus) {
          subMenu.classList.remove('is-active')
        }
        this.classList.add('is-active')
        subMenus[i].classList.add('is-active');
      });
    }
  }
  
  const heroSlider = new Swiper('.js-hero-slider .swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    watchOverflow: true,
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    speed: 800,
    autoplay: {
      delay: 5000,
    },
    navigation: {
      nextEl: '.js-hero-slider .swiper-button-next',
      prevEl: '.js-hero-slider .swiper-button-prev',
    },
    pagination: {
      el: '.js-hero-slider .swiper-pagination',
      type: 'fraction', // 'bullets', 'fraction', 'progressbar'
      clickable: true,
    },
    parallax: true,
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
  });
  const brandsSlider = new Swiper('.js-brands-slider .swiper', {
    slidesPerView: 2,
    spaceBetween: 0,
    loop: true,
    watchOverflow: true,
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    speed: 800,
    autoplay: {
      delay: 5000,
    },
    navigation: {
      nextEl: '.js-brands-slider .swiper-button-next',
      prevEl: '.js-brands-slider .swiper-button-prev',
    },
    pagination: {
      el: '.js-brands-slider .swiper-pagination',
      type: 'fraction', // 'bullets', 'fraction', 'progressbar'
      clickable: true,
    },
    breakpoints: {
      767: {
        slidesPerView: 4,
        spaceBetween: 0,
      },
      1199: {
        slidesPerView: 6,
        spaceBetween: 0,
      },
      1679: {
        slidesPerView: 9,
        spaceBetween: 0,
      },
    },
  });
  const productsView = new Swiper('.js-products-view .swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    // loop: true,
    watchOverflow: true,
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    speed: 800,
    autoplay: {
      delay: 5000,
    },
    navigation: {
      nextEl: '.js-products-view .swiper-button-next',
      prevEl: '.js-products-view .swiper-button-prev',
    },
    pagination: {
      el: '.js-products-view .swiper-pagination',
      type: 'fraction', // 'bullets', 'fraction', 'progressbar'
      clickable: true,
    },
    breakpoints: {
      575: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      767: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      1199: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
      1359: {
        slidesPerView: 5,
        spaceBetween: 20,
      },
      1679: {
        slidesPerView: 6,
        spaceBetween: 20,
      },
    },
  });
  $(document).on('click', '.change-view-item.--grid', function(){
    $(this).removeClass('is-active');
    $('.change-view-item.--list').addClass('is-active');
    $('.catalog-list').removeClass('--grid').addClass('--list')
  });
  
  $(document).on('click', '.change-view-item.--list', function(){
    $(this).removeClass('is-active');
    $('.change-view-item.--grid').addClass('is-active');
    $('.catalog-list').removeClass('--list').addClass('--grid');
  });
  
  $(document).on('click', '.product-card__sizes ul li', function(){
    $(this).closest('.product-card__sizes').find('li').removeClass('is-active');
    $(this).addClass('is-active');
  });
  
  $(document).on('click', '.product-card__colors li span', function(){
    $(this).closest('.product-card__colors').find('span').removeClass('is-select');
    $(this).addClass('is-select');
  });
  
  $('.tags-list > .tags-list__item').hide();
  $('.tags-list > .tags-list__item').slice(0,8).show();
  
  $('.tags-more').on('click', function(e){
  
    e.preventDefault();
  
    if( $(this).hasClass('is-active') ) {
      $(this).removeClass('is-active');
      $('.tags-list > .tags-list__item').hide();
      $('.tags-list > .tags-list__item').slice(0,8).show();
    } else {
      $('.tags-list > .tags-list__item:hidden').fadeIn();
      $('.tags-more').addClass('is-active');
    }
  
  });
  
  
  if(document.querySelector('.copy-text')) {
    let copyLinks  = document.querySelectorAll('.copy-text');
    for (const copyLink of copyLinks) {
        copyLink.onclick = function (e) {
            navigator.clipboard.writeText(copyLink.textContent || copyLink.innerText);
        }
    }
  }
  
  
  
  /* ------------- Показать/Скрыть фильтр на мобильных устройствах ------------ */
  $(document).on('click', '.products-filter-head .button', function(){
    $(this).toggleClass('is-active');
    $('.products-filter').toggleClass('is-show');
  });
  
  /*-------------------------------search------------------------*/
  
  
  $(document).on('input', '.filter-search__input', function () {
    let textLenght = $(this).val().length;
    if (textLenght > 0) {
      $(this).closest('.search-cont').find('.filter-search__clear').addClass('is-show');
    } else {
      $(this).closest('.search-cont').find('.filter-search__clear').removeClass('is-show');
    }
  });
  
  $(document).on('click', '.filter-search__clear', function () {
    $(this).removeClass('is-show');
    $(this).closest('.search-cont').find('input').val('');
    $(this).closest('.search-cont').find('input').focus();
  });
  
  /* ------------------------------ Ползунок цены ----------------------------- */
  function rargePrice(){
  
      var $range = $(".range-price");
      var $inputFrom = $(".range-price-from");
      var $inputTo = $(".range-price-to");
      var instance;
      var min = 0;
      var max = 3000;
      var from = 0;
      var to = 3000;
  
      $range.ionRangeSlider({
      skin: "round",
      type: "double",
      min: min,
      max: max,
      from: from,
      to: to,
      hide_min_max: true,
      hide_from_to: true,
      onStart: updateInputs,
      onChange: updateInputs,
      onFinish: updateInputs
  
    });
  
    instance = $range.data("ionRangeSlider");
  
    function updateInputs (data) {
      from = data.from;
      to = data.to;
      $inputFrom.prop("value", from);
      $inputTo.prop("value", to);
    }
  
    $inputFrom.on("change", function () {
      var val = $(this).prop("value");
      if (val < min) {
          val = min;
      } else if (val > to) {
          val = to;
      }
      instance.update({
          from: val
      });
      $(this).prop("value", val);
    });
  
    $inputTo.on("change", function () {
      var val = $(this).prop("value");
      if (val < from) {
          val = from;
      } else if (val > max) {
          val = max;
      }
      instance.update({
          to: val
      });
      $(this).prop("value", val);
    });
  }
  rargePrice();
  const productThumb = new Swiper('.js-product-thumb .swiper', {
    direction: "horizontal",
    slidesPerView: 3,
    spaceBetween: 10,
    speed: 800,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    rewind: true,
    navigation: {
      nextEl: '.js-product-thumb .swiper-button-next',
      prevEl: '.js-product-thumb .swiper-button-prev',
    },
    breakpoints: {
      767: {
        direction: "horizontal",
        slidesPerView: 3,
        spaceBetween: 15,
      },
      1199: {
        direction: "horizontal",
        slidesPerView: 4,
        spaceBetween: 10,
      },
      1679: {
        direction: "vertical",
        slidesPerView: 4,
        spaceBetween: 10,
      },
    },
  });
  
  const productFull = new Swiper('.js-product-full .swiper', {
    slidesPerView: 1,
    spaceBetween: 5,
    rewind: true,
    speed: 800,
    navigation: {
      nextEl: '.js-product-full .swiper-button-next',
      prevEl: '.js-product-full .swiper-button-prev',
    },
    thumbs: {
      swiper: productThumb
    },
  });
  
  const productFullSingle = new Swiper('.js-product-full-single .swiper', {
    slidesPerView: 1,
    spaceBetween: 5,
    rewind: true,
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    speed: 800,
    navigation: {
      nextEl: '.js-product-full-single .swiper-button-next',
      prevEl: '.js-product-full-single .swiper-button-prev',
    }
  });
  
  const relatedProducts = new Swiper('.js-related-products .swiper', {
    slidesPerView: 2,
    spaceBetween: 10,
    rewind: true,
    watchOverflow: true,
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    speed: 800,
    autoplay: {
      delay: 5000,
    },
    navigation: {
      nextEl: '.js-related-products .swiper-button-next',
      prevEl: '.js-related-products .swiper-button-prev',
    },
    pagination: {
      el: '.js-related-products .swiper-pagination',
      type: 'fraction', // 'bullets', 'fraction', 'progressbar'
      clickable: true,
    },
    breakpoints: {
      767: {
        slidesPerView: 'auto',
        spaceBetween: 50,
      },
    },
  });
  
  const relatedProducts2 = new Swiper('.js-related-products-manager .swiper', {
    slidesPerView: 2,
    spaceBetween: 10,
    loop: true,
    watchOverflow: true,
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    speed: 800,
    autoplay: {
      delay: 5000,
    },
    navigation: {
      nextEl: '.js-related-products-manager .swiper-button-next',
      prevEl: '.js-related-products-manager .swiper-button-prev',
    },
    pagination: {
      el: '.js-related-products-manager .swiper-pagination',
      type: 'fraction', // 'bullets', 'fraction', 'progressbar'
      clickable: true,
    },
    breakpoints: {
      767: {
        slidesPerView: 3,
        spaceBetween: 50,
      },
      991: {
        slidesPerView: 4,
        spaceBetween: 50,
      },
      1100: {
        slidesPerView: 6,
        spaceBetween: 50,
      },
      1300: {
        slidesPerView: 7,
        spaceBetween: 50,
      },
    },
  });
  
  $(document).on('click', '.colors li span', function(){
    $(this).closest('.colors').find('span').removeClass('is-active');
    $(this).addClass('is-active');
  });
  // Сравнение товаров
  $('.compare-sidebar__list li').on({
    mouseenter: function() {
      let index = $(this).index();
      $('.compare-item').each(function(){
        $(this).find('.compare-item__list li:eq('+ index + ')').find('.compare-item__item').addClass('is-active');
      });
    },
    mouseleave: function() {
      let index = $(this).index();
      $('.compare-item').each(function(){
        $(this).find('.compare-item__list li:eq('+ index + ')').find('.compare-item__item').removeClass('is-active');
      });
    }
  });
  
  
  /* ----------------------- Страница сравнения товаров ----------------------- */
  $('.compare-item__list li').on({
  mouseenter: function() {
    let index = $(this).index();
    $('.compare-item').each(function(){
      $(this).find('.compare-item__list li:eq('+ index + ')').find('.compare-item__item').addClass('is-active');
    });
    $('.compare-sidebar__list li:eq('+ index + ')').addClass('is-active');
  },
  mouseleave: function() {
    let index = $(this).index();
    $('.compare-item').each(function(){
      $(this).find('.compare-item__list li:eq('+ index + ')').find('.compare-item__item').removeClass('is-active');
      $('.compare-sidebar__list li:eq('+ index + ')').removeClass('is-active');
    });
  }
  });
  
  const compareSlider = new Swiper('.js-compare-slider .swiper', {
    loop: false,
    slidesPerView: 1,
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    speed: 500,
    navigation: {
      nextEl: '.js-compare-slider .swiper-button-next',
      prevEl: '.js-compare-slider .swiper-button-prev',
    },
    pagination: {
      el: '.js-compare-slider .swiper-pagination',
      type: 'fraction', // 'bullets', 'fraction', 'progressbar'
      clickable: true,
    },
    breakpoints: {
      767: {
        slidesPerView: 3,
      },
      1599: {
        slidesPerView: 5,
      },
    },
  });
  
  
  $(document).on('click', '.compare-item .btn-delete', function(){
  let ths = $(this).closest('.swiper-slide');
  $(this).closest('.compare-item').fadeOut('300');
  var remove = function(){
    ths.remove();
  }
  setTimeout(remove, 400);
  });
  /* --------------------------- Страница "Контакты" -------------------------- */
  
  // const mapBox      = document.getElementById("map");
  
  // if(mapBox) {
  //   const markerIcon  = '/assets/img/pin.png';
  //   const mapZoom     = 12;
  //   const centerMap   = new google.maps.LatLng(48.298377962578456, 25.935977095425084);
  //   const markersData = [
  //                         { lat: 48.298377962578456, lng: 25.935977095425084},
  //                       ];
  
  //   function initMap() {
  //     var mapOptions = {
  //       center: centerMap,
  //       zoom: mapZoom,
  //     };
  //     map = new google.maps.Map(mapBox, mapOptions);
  //     const markers = markersData.map((location, i) => {
  //       return new google.maps.Marker({
  //         position: location,
  //         map,
  //         icon: markerIcon,
  //       });
  //     });
  //   }
  
  //   initMap();
  // }
  
  
  const jobsSlider = new Swiper('.js-jobs-slider .swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    watchOverflow: true,
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    speed: 800,
    autoplay: {
      delay: 5000,
    },
    navigation: {
      nextEl: '.js-jobs-slider .swiper-button-next',
      prevEl: '.js-jobs-slider .swiper-button-prev',
    },
    pagination: {
      el: '.js-jobs-slider .swiper-pagination',
      type: 'fraction',
      clickable: true,
    },
    breakpoints: {
      767: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1199: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },
  });
  const othersArticle = new Swiper('.js-others-article .swiper', {
    slidesPerView: 1,
    spaceBetween: 10,
    loop: true,
    watchOverflow: true,
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    speed: 800,
    autoplay: {
      delay: 5000,
    },
    navigation: {
      nextEl: '.js-others-article .swiper-button-next',
      prevEl: '.js-others-article .swiper-button-prev',
    },
    pagination: {
      el: '.js-others-article .swiper-pagination',
      type: 'fraction', // 'bullets', 'fraction', 'progressbar'
      clickable: true,
    },
    breakpoints: {
      767: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1199: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },
  });
  const partnersSlider = new Swiper('.js-partners-slider .swiper', {
    slidesPerView: 2,
    spaceBetween: 0,
    loop: true,
    watchOverflow: true,
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    speed: 800,
    autoplay: {
      delay: 5000,
    },
    navigation: {
      nextEl: '.js-partners-slider .swiper-button-next',
      prevEl: '.js-partners-slider .swiper-button-prev',
    },
    pagination: {
      el: '.js-partners-slider .swiper-pagination',
      type: 'fraction', // 'bullets', 'fraction', 'progressbar'
      clickable: true,
    },
    breakpoints: {
      767: {
        slidesPerView: 4,
        spaceBetween: 0,
      },
      1199: {
        slidesPerView: 6,
        spaceBetween: 0,
      },
      1679: {
        slidesPerView: 7,
        spaceBetween: 0,
      },
    },
  });
  $(document).on('click', '.widjet-user-info__btn button', function(){
    let $input = $(this).closest('.widjet-user-info__item').find('.widjet-user-info__input > input');
    if( $input.hasClass('is-active') ) {
      $(this).removeClass('is-active');
      $input.removeClass('is-active');
    } else {
      $(this).addClass('is-active');
      $input.addClass('is-active');
    }
  });
  
  $(document).on('click', '.js-save-change', function(){
    $('.widjet-user-info__btn button').removeClass('is-active');
    $('.widjet-user-info__input > input').removeClass('is-active');
  });
  const productsSelect = new Swiper('.js-products-select .swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    rewind: true,
    watchOverflow: true,
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    speed: 800,
    // autoplay: {
    //   delay: 5000,
    // },
    navigation: {
      nextEl: '.js-products-select .swiper-button-next',
      prevEl: '.js-products-select .swiper-button-prev',
    },
    pagination: {
      el: '.js-products-select .swiper-pagination',
      type: 'fraction', // 'bullets', 'fraction', 'progressbar'
      clickable: true,
    },
    breakpoints: {
      575: {
        slidesPerView: 2,
        spaceBetween: 2,
      },
      767: {
        slidesPerView: 3,
        spaceBetween: 2,
      },
      1199: {
        slidesPerView: 4,
        spaceBetween: 2,
      },
      1359: {
        slidesPerView: 5,
        spaceBetween: 2,
      },
      1679: {
        slidesPerView: 7,
        spaceBetween: 2,
      },
    },
  });
  const compareSlider2 = new Swiper('.js-compare-slider-2 .swiper', {
  loop: false,
  slidesPerView: 1,
  observeParents: true,
  observeSlideChildren: true,
  observer: true,
  speed: 500,
  scrollbar: {
    el: '.js-compare-slider-2 .swiper-scrollbar',
    draggable: true,
  },
  breakpoints: {
    767: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
    1700: {
      slidesPerView: 4,
    },
  },
  });
  //copy token
  if (document.querySelector('.m-user-aip__copy')) {
    const copyBtns = document.querySelectorAll('.m-user-aip__copy');

    for (const copyBtn of copyBtns) {
      copyBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const copyData = this.previousSibling.getAttribute('data-token');
        navigator.clipboard.writeText(copyData);
      });
    }
  }

  $(document).on('click', '.filter-drop-btn', function () {
    const drop = this.closest('.filter-drop');
    const filteDrops = document.querySelectorAll('.filter-drop');

    for (const filteDrop of filteDrops) {
      if (filteDrop == drop) {
        if (drop.classList.contains('--open')) {
          drop.classList.remove('--open');
        } else {
          drop.classList.add('--open');
        }
      } else {
        filteDrop.classList.remove('--open');
      }
    }
  });
  $(document).on('click', '.filter-drop-footer .save', function () {
    $(this).closest('.filter-drop').removeClass('--open');
  });
  $(document).mouseup(function (e) {
    var div = $(".filter-drop");

    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $('.filter-drop').removeClass('--open');
    }
  });
  $(document).on('click', '.tags-list__link', function () {
    $(this).toggleClass('is-active');
  });
  $(document).on('click', '.button-upload .ico_close', function () {
    let $label = $('.file-upload').attr('data-label');
    $('.file-upload-text').text($label);
    $('.button-upload').removeClass('is-upload');
    $('.file-upload').removeClass('is-upload');
    $('.file-upload input').val('');
  });
  var parallax = document.querySelectorAll('.lk-widjet__parallax');

  if (parallax) {
    parallax.forEach(function (index) {
      var parallaxItem = new Parallax(index);
    });
  }
  /* -------------------------- Анимация при скролле -------------------------- */


  AOS.init({
    disable: 'mobile',
    // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
    duration: 1000,
    // values from 0 to 3000, with step 50ms
    easing: 'ease',
    // default easing for AOS animations
    once: true // whether animation should happen only once - while scrolling down

  });
  $(document).on('click', '.lk-submenu__item', function () {
    $('.lk-submenu__item').removeClass('active');
    $(this).addClass('active');
  });
  $(document).on('click', '.lk-menu__btn', function () {
    $(this).toggleClass('is-active');
    $('.lk-menu__box').toggleClass('is-show');
  });
  $(document).on('click', '.lk-menu-btn', function () {
    $(this).toggleClass('is-active');
    $(this).next('.lk-menu-list').toggleClass('is-active');
  });
  $(document).mouseup(function (e) {
    var div = $(".lk-menu");

    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $('.lk-menu-btn, .lk-menu-list').removeClass('is-active');
    }
  });
  $(document).on('click', '.submenu__btn', function () {
    $(this).toggleClass('is-active');
    $(this).closest('.submenu').toggleClass('is-active');
    $(this).closest('.submenu').find('.submenu__box').toggleClass('is-active');
  });
  $(document).mouseup(function (e) {
    var div = $(".submenu");

    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $('.submenu, .submenu__box').removeClass('is-active');
    }
  });
  $(document).on('click', '.lk-submenu__item .label', function () {
    $(this).closest('.submenu').find('.submenu__btn .label').html($(this).html());
    $(this).closest('.submenu').removeClass('is-open');
    $(this).closest('.submenu').find('.submenu__btn, .submenu__box').removeClass('is-active');
  });
  $('.file-upload').file_upload();
  /* ---------------------------- Tags в поле input --------------------------- */

  if ($('.js-tags').length) {
    tagger($('.js-tags'));
    $('.js-tags').each(function () {
      let placeholder = $(this).attr('placeholder');
      $(this).closest('.tagger').find('.tagger-new > input').attr('placeholder', placeholder);
    });
  }

  $(document).on('click', '.js-show-filter', function () {
    $('.catalog-sidebar').addClass('is-show');
    $('.catalog-overlay').addClass('is-show');
    $('body').addClass('stop-scroll');
  });
  $(document).on('click', '.js-hide-filter', function () {
    $('.catalog-sidebar').removeClass('is-show');
    $('.catalog-overlay').removeClass('is-show');
    $('body').removeClass('stop-scroll');
  });
  $(document).mouseup(function (e) {
    var div = $(".catalog-sidebar");

    if (!div.is(e.target) && div.has(e.target).length === 0) {
      $('.catalog-sidebar').removeClass('is-show');
      $('.catalog-overlay').removeClass('is-show');
      $('body').removeClass('stop-scroll');
    }
  });
});