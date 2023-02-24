/* --------------------------- Страница "Контакты" -------------------------- */

const mapBox      = document.getElementById("map");

if(mapBox && document.shopLocations[0]) {
    const markerIcon  = '/assets/img/pin.png';
    const mapZoom     = 12;
    const centerMap   = new google.maps.LatLng(document.shopLocations[0]);

    function initMap() {
        var mapOptions = {
            center: centerMap,
            zoom: mapZoom,
        };
        map = new google.maps.Map(mapBox, mapOptions);
        const markers = document.shopLocations.map((location, i) => {
            return new google.maps.Marker({
                position: location,
                map,
                icon: markerIcon,
            });
        });
        /*const markers = markersData.map((location, i) => {
            return new google.maps.Marker({
                position: location,
                map,
                icon: markerIcon,
            });
        });*/
    }

    initMap();
}


jQuery(document).ready(function ($) {

    /**
     * Контроль верхней границы значения числовых инпутов.
     */
    document.inputNumberCorrect = function (input) {
        const max = $(input).attr('max');
        if (max !== undefined) {
            if (input.value > max) {
                input.value = max;
            }
        }
    }

    /**
     * Установка фокуса на элемент
     * Запускается из livewire компонента
     * $this->dispatchBrowserEvent('setFocusTo', ['query' => 'строка поиска']);
     */
    window.addEventListener('setFocusTo', event => {
        const $input = $(event.detail.query);
        if ($input.length) {
            $input.focus();
        }
    })

    /** Отображает модальное окно по запросу */
    window.addEventListener('showModal', event => {
        $('#' + event.detail.modalId).modal('show');
    })

    /**
     * Предотвращает отображение более одного окна одновременно.
     * - Закрывает все открытые окна перед открытием нового.
     */
    window.addEventListener('show.bs.modal', event => {
        $(".modal.show").modal("hide");
    });

    /**
     * Принудительно восстанавливаем форму быстрой покупки при сокрытии окна
     * уведомления об успешном быстром заказе.
     */
    // jQuery('#modal-quick-purchase').on('hide.bs.modal', function (e) {
    //     if ($(this).find('.modal-content.modal-success').length) {
    //         Livewire.emit('quick-purchase-modal.restore-form')
    //     }
    // })

    // Скрываем все ошибки на форме при отправке формы
    // для отмены добавьте форме класс suppress-submit-hide-errors
    $(document).on('submit', 'form', function (e) {
        if (!$(e.target).hasClass('suppress-submit-hide-errors')) {
            $(e.target).find('.invalid-feedback, .alert').hide();
        }
    });

    /**
     * Ответная реакция на закрытие информационного окна.
     * Разная в зависимости от источника сообщения.
     */
    $(document).on('modal-info-message_confirm', function (e, key) {
        if ('do_complete_registration' === key) {
            $('#modal-registration').modal().show();
        }
        if ('session_expired' === key) {
            $('#modal-login').modal().show();
        }
    });

    /**
     * Автоматический скролл модального окна вверх
     * при наличии сообщения в первом элементе формы с классом .alert
     * только для компонентов livewire
     */
    Livewire.hook('message.processed', (message, component) => {
        const $alert = $(component.el).find('form>.alert');
        if ($alert.length) {
            $(component.el).find('.modal-body').animate({scrollTop: 0})
        }
    })

    /**
     * Отображение Флэш модального окна.
     * запуск из livewire $this->dispatchBrowserEvent(
     *      'flashMessage', ['title'=>'...', 'message'=>'...', 'state'=>'...']
     */
    window.addEventListener('flashMessage', event => {
        const title = event.detail.hasOwnProperty('title') ? event.detail.title : '';
        const message = event.detail.hasOwnProperty('message') ? event.detail.message : '';
        const state = event.detail.hasOwnProperty('state') ? event.detail.state : 'none';
        document.modalFlashInfoMessageShow(title, message, state);
    })

    /**
     * Функция отображает flash сообщение
     * @param title
     * @param message
     * @param state [none, success, danger, warning, ...] Состояние добавляется как часть класса.
     */
    document.modalFlashInfoMessageShow = function (title = '', message = '', state = 'none') {
        const $modalFlash = $('#modal-flash-info-message');
        $modalFlash.find('.info-title').text(title);
        $modalFlash.find('.message').html(
            `
            <div class="message alert alert-${state}">${message}</div>
            `
        );
        if (message) {
            $('.modal').modal('hide');
            $modalFlash.modal('show');
        }
    }

    /**
     * API lazyWireModal позволяет делать отложенную загрузку Livewire компонента модальной формы
     * Для работы скрипта компонент изначально ренденит только оболочку
     * и должен содержать метод  uploadLazyContent(payload=null) после вызова которого
     * компонент рендерит содержимое.
     *
     * Для вызова формы просто вызовите onclick="document.lazyWireModalShow('{id тега оболочки}', options)"
     * Если форма еще не загружена, она подгрузится и отобразится
     *
     * @param componentId // атрибут id родительского тега модального окна.
     * дополнительные данные
     * @param options // {
     * -- force - Обязательная презагрузка содержимого окна.
     * -- payload - Полезная нагрзука передаваемая на сервер (формировать как объект).
     * // }
     *
     * Апи генерирует 2 события lazyModalUploaded и lazyModalFailed
     */
    document.lazyWireModal = {
        ids: {},
        init: function () {
            Livewire.hook('message.failed', (message, component) => {
                if (this.ids.hasOwnProperty(component.id)) {
                    let options = this.ids[component.id];
                    options.message = message;
                    options.component = component;
                    $(document).trigger('lazyModalFailed', options);
                    this.uploadAndShow(options.componentId);
                    delete this.ids[options.wireId];
                }
            })
            Livewire.hook('message.processed', (message, component) => {
                if (this.ids.hasOwnProperty(component.id)) {
                    let options = this.ids[component.id];
                    options.message = message;
                    options.component = component;
                    $(document).trigger('lazyModalUploaded', options);
                    this.uploadAndShow(options.componentId);
                    delete this.ids[options.wireId];
                }
            })
        },
        uploadAndShow: function (componentId, options = {}) {
            options = this.parseAttributes(options);
            let $wrapper = $('#' + componentId + ' .modal-content');
            if ($wrapper.length && $wrapper.children().length && !options.force) {
                $('#' + componentId).modal('show');
            } else {
                let wireId = $wrapper.length ? $wrapper.attr('wire:id') : '';
                if (wireId && !this.ids.hasOwnProperty(wireId)) {
                    options.wireId = wireId;
                    options.componentId = componentId;
                    window.Livewire.find(wireId).uploadLazyContent(options.payload);
                    this.ids[wireId] = options;
                    return;
                }

                delete this.ids[wireId];
            }
        },
        parseAttributes: function (attributes = {}) {
            return {
                force: attributes.hasOwnProperty('force') ? attributes.force : false,
                payload: attributes.hasOwnProperty('payload') ? attributes.payload : {},
            }
        }
    }
    document.lazyWireModal.init();

    /**
     * Установка фокуса на элемент модального окна при открытии
     * выбирается input имя которого указано в атрибуте data-focusable
     * элеметна .modal-body
     */
    $(document).on('shown.bs.modal', function (e) {
        const body = $(e.target).find('.modal-body');
        const field = body.length ? body.data('focusable') : '';

        if (field) {
            body.find(`[name="${field}"]`).trigger('focus');
        }
    });

    /**
     * API управления элементом customeDropdown
     */
    document.customeDropdown = {
        init: function () {
            let me = this;
            $(document).on("keydown", '.custome-dropdown input[type=text]', function (e) {
                me.scrollFocus(e);
            });
        },
        hideDropdown: function (target) {
            setTimeout(function () {
                $(target).closest('.custome-dropdown').find($('.custome-dropdown-box')).hide();
            }, 500);
        },
        scrollFocus: function (e) {
            // Переключение физуального фокуса в списке при нажатии Up Down Enter
            // Основа кода взята тут https://www.w3schools.com/howto/howto_js_autocomplete.asp

            const $items = $(e.target).closest('.custome-dropdown')
                .find('.custome-dropdown-box li').filter(':visible');
            if (!$items.length) return;

            let currentFocus = -1;
            $items.each((i, el) => {
                if ($(el).hasClass('active')) {
                    currentFocus = i;
                    return false;
                }
            });
            let changes = false;

            if (e.keyCode === 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                changes = true;
            } else if (e.keyCode === 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                changes = true;
            } else if (e.keyCode === 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    $items.eq(currentFocus).trigger('click');
                }
                changes = true;
            }
            if (changes) {
                if (currentFocus < 0) currentFocus = $items.length - 1;
                if (currentFocus >= $items.length) currentFocus = 0;

                $items.removeClass('active');
                $items.eq(currentFocus).addClass('active');
            }
        }
    }

    document.customeDropdown.init();

    /**
     * Обновление Js компонентов
     * Каждый тип компонента - это массив из queryString для поиска помпонента.
     */
    Livewire.on('revalidate', (data) => {
        if (data['footable'] !== undefined && data['footable']) {
            (data['footable']).forEach(queryString => {
                if ($(queryString).length) {
                    $(queryString).each((i, table) => {
                        $(table).footable()
                    });
                }
            });
        }

        if (data['nice_select'] !== undefined && data['nice_select']) {
            (data['nice_select']).forEach(queryStrings => {
                const $target = $(queryStrings);
                if ($target.length) {
                    const name = $target.attr('name');
                    const $source = $target.closest('.nice-select-group').find(`select[name="${name}-hidden"]`);
                    if ($source.length) {
                        $target
                            .html($source.html())
                            .niceSelect('update');
                    }
                }
            });
        }

        if (data['select2'] !== undefined && data['select2']) {
            (data['select2']).forEach(queryStrings => {
                const $target = $(queryStrings);
                if ($target.length) {
                    const name = $target.attr('name');
                    const $source = $target.closest('.select2-group').find(`select[name="${name}-hidden"]`);
                    if ($source.length) {
                        const params = $target.data('params') ? $target.data('params') : {};
                        $target
                            .html($source.html())
                            .attr('disabled', !!$source.attr('disabled'))
                            .select2(params);
                    }
                }
            });
        }

    });

    window.addEventListener('favoriteUpdated', event => {
        const $items = $(`.product-item.product-${event.detail.product} .js-add-favorites`);
        if ($items.length) {
            if (event.detail.exist) {
                $items.addClass('is-active');
            } else {
                $items.removeClass('is-active');
            }
        }
    })

    window.addEventListener('comparisonsToggle', event => {
        const $items = $(`.product-item.product-${event.detail.product} .js-add-compare`);
        if ($items.length) {
            if (event.detail.exist) {
                $items.addClass('is-active');
            } else {
                $items.removeClass('is-active');
            }
        }
    })

    /**
     * Авто фильтрует список по мере ввода.
     * Скрывает и отображает элементы.
     */
    $(document).on('input', '.drop-input.js-filterable', function (e) {
        const value = $(e.target).val().toLowerCase();
        $(e.target).closest('.drop').find('li')
            .each((i, el) => {
                if (!value || $(el).hasClass('js-filterable-off')) {
                    $(el).css('display', 'block');
                } else {
                    if ($(el).text().toLowerCase().indexOf(value) !== -1) {
                        $(el).css('display', 'block');
                    } else {
                        $(el).css('display', 'none');
                    }
                }
            })
    })

    document.tm = {
        beep: function () {
            var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");
            snd.play();
        },

        /**
         * Проверяет видимость элемента внутри родителя со скролингом
         * @param el    Проверяемый элемент. пример: $(.element).get(0)
         * @param holder родитель
         * @param full
         * @returns {boolean}
         */
        isScrollableVisible: function (el, holder, full = true) {
            holder = holder || document.body
            let {top, bottom, height} = el.getBoundingClientRect()
            const holderRect = holder.getBoundingClientRect()

            height = full ? 0 : height;

            return top <= holderRect.top
                ? holderRect.top - top <= height
                : bottom - holderRect.bottom <= height
        },

        scrollToElement: function (el, holder) {

            holder.scrollTop = getRelativePos(el).top - 5;

            /**
             * Возвращает координаты элемента относительно родителя
             * @param elm
             * @returns {{}}
             */
            function getRelativePos(elm) {
                let pPos = elm.parentNode.getBoundingClientRect(), // parent pos
                    cPos = elm.getBoundingClientRect(), // target pos
                    pos = {};

                pos.top = cPos.top - pPos.top + elm.parentNode.scrollTop;
                pos.right = cPos.right - pPos.right;
                pos.bottom = cPos.bottom - pPos.bottom;
                pos.left = cPos.left - pPos.left;

                return pos;
            }
        }
    }

    /**
     * Разрешаем ввод только цифр, и Enter-13 Delete-46 Backspace-8 DecimalPoint-110
     * @param event
     * @returns {boolean}
     */
    function validateNumeric(event) {
        const key = window.event ? event.keyCode : event.which;
        if (event.keyCode === 8 || event.keyCode === 46 || event.keyCode === 13 || event.keyCode === 110 ) {
            return true;
        } else if ( key < 48 || key > 57 ) {
            return false;
        } else {
            return true;
        }
    }

    $('.js-phone, .js-phone-short, .js-phone-short-code, .js-okpo, .js-numeric').on('keypress', validateNumeric);


    $(document).on('input', '.search__controls > input, .tagger-new > input', function(){
        let textLenght = $(this).val().length;
        if (textLenght >= 1) {
            //$(this).closest('.search').addClass('is-active');
            //$('.search__drop').show();
            //$('.search__overlay').addClass('is-show');
            $('body').addClass('no-scroll');
        } else {
            //$('.search__drop').hide();
            //$('.search').removeClass('is-active');
            //$('.search__overlay').removeClass('is-show');
            $('body').removeClass('no-scroll');
        }
    });

    $(document).on('click', '.change-view-item.--grid', function(){
        if (document.cookie.indexOf("catalogView") == -1)
            document.cookie = 'catalogView=1; path=/; max-age=86400;';


    });

    $(document).on('click', '.change-view-item.--list', function(){
        document.cookie = 'catalogView=1; path=/; max-age=0;';

    });

    // Контроль ввода количества по max и min
    $(document).on('click', '.counter .minus', function () {
        const $input = $(this).closest('.counter').find('input');
        const minimum = parseFloat($input.attr("min") || 1);
        let count = parseInt($input.val()) - minimum;
        $input.val(count);
        $input.change();
        return false;
    });
    $(document).on('click', '.counter .plus', function () {
        const $input = $(this).closest('.counter').find('input');
        const min = parseFloat($input.attr("min") || 1);
        let count = parseFloat($input.val()) + min;
        $input.val(count);
        $input.change();
        return false;
    });
    $(document).on('change', '.counter input.input-col', function () {
        const min = parseFloat($(this).attr("min") || 1);
        const max = parseFloat($(this).attr("max") || -1);
        let count = parseFloat($(this).val());

        count = count < min ? min : count;

        if (count / min > 1) {
            const quantity = Math.ceil(count / min);
            count = (min * quantity);
            count = (max > 0 && count > max)
                ? (min * (quantity - 1))
                : count;
        }

        $(this).val(count);
    });


});



