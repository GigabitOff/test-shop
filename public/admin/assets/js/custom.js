document.addEventListener('DOMContentLoaded', function() {
    /**
     * Авто фильтрует список по мере ввода.
     * Скрывает и отображает элементы.
     * Может иметь элемент .fallback который отображается когда нет других
     */
    $(document).on('input', 'input.js-filterable', function (e) {
        const value = $(e.target).val().toLowerCase();
        const $drop = $(e.target).closest('.drop');
        $drop.find('li:not(.fallback)')
            .each((i, el) => {
                if ($(el).text().toLowerCase().indexOf(value) !== -1) {
                    $(el).removeClass('js-hidden').css('display', 'block');
                } else {
                    $(el).addClass('js-hidden').css('display', 'none');
                }
            })
        if ($drop.find('li:not(.fallback):not(.js-hidden)').length) {
            $drop.find('li.fallback').hide();
        } else {
            $drop.find('li.fallback').show()
        }
    });

    /**
     * Обновление FooTable без переинициализации
     * Запуск document.FooTableEx.init('#footable-content', '#footable-holder')
     * Обновление document.FooTableEx.redraw(#footable-content')
     */
    document.FooTableEx = {
        data: [],
        init: function (source, target) {
            let ft = FooTable.init(target, {
                columns: this.extractColumns(source),
            });

            $(target).on('ready.ft.table', () => {
                // Move attributes for thead tag
                this.moveTheadAttrs(source, target);
                ft.rows.load(this.extractData(source));
            });

            this.data[source] = ft;
        },
        moveTheadAttrs: function (source, target) {
            const data = $(source).html();
            const thead = $(data).find('thead').get(0);
            const attrs = thead.getAttributeNames()
                .reduce((acc, name) => {
                    return {...acc, [name]: thead.getAttribute(name)};
                }, {});
            $(target).find('thead').attr(attrs);
        },
        redraw: function (source) {
            let ft = this.data[source];
            if (ft !== undefined) {
                ft.rows.load(this.extractData(source));
            }
        },
        updateInputs: function(source) {
            const ft = this.data[source];
            const $srcInputs = $(source).find('input');
            if (ft === undefined) {
                return;
            }
            ft.$el.find('input').each((i, el) => {
                const value = $srcInputs.eq(i).attr('data-value');
                const type = $(el).attr('type');
                if (value !== undefined){
                    switch (type){
                        case 'text':
                        case 'number':
                        case 'password':
                            $(el).val(value);
                            break;
                        case 'checkbox':
                            $(el).prop('checked', value);
                            break;
                    }
                }
            });
        },
        extractColumns: function (source) {
            // const data = $(source).data('table')
            const data = $(source).html()
            return $(data).find('thead th')
                .map((i, el) => {
                    return {
                        name: 'col_' + i,
                        title: $(el).html(),
                        classes: $(el).attr('class'),
                        breakpoints: $(el).attr('data-breakpoints')
                    }
                }).toArray();
        },
        extractData: function (source) {
            // const data = $(source).attr('data-table')
            const data = $(source).html()
            return $(data).find('tbody tr')
                .map((i, row) => {
                    let data = {};
                    let tds = $(row).find('td');
                    for (let j = 0; j < tds.length; j++) {
                        data['col_' + j] = {
                            value: tds.eq(j).html(),
                            options: {
                                classes: tds.eq(j).attr('class'),
                            }
                        }
                    }
                    return {
                        value: data,
                        options: {
                            classes: $(row).attr('class'),
                        }
                    };
                }).toArray();
        }
    }

    /**
     * Инициализация footable
     * Находим все элементы с классом .footable-content
     * Берем атрибут 'id' подменяем часть 'content' на 'holder'
     * и запускаем начальную инициализацию
     */
    function initFootables() {
        const fts = document.getElementsByClassName('footable-content');
        for (const ft of fts) {
            const idSource = ft.id;
            const idTarget = idSource.replace('content', 'holder');
            const target = document.getElementById(idTarget);
            if (target) {
                document.FooTableEx.init(`#${idSource}`, `#${idTarget}`);
            }
        }
    }

    initFootables();

    /**
     * Автообновление footable таблиц.
     *
     * Будет обрабатывать все таблицы с классами  '.footable-content.footable-revalidate'
     * Класс '.footable-revalidate' динамический и будет удален после попытки обновления
     */
    Livewire.hook('message.processed', () => {
        $('.footable-content.footable-revalidate')
            .each((i, el) => {
                const source = '#' + $(el).attr('id');
                document.FooTableEx.redraw(source);
                document.FooTableEx.updateInputs(source);
                $(el).removeClass('footable-revalidate footable-update-inputs');
            })

        $('.footable-content.footable-update-inputs')
            .each((i, el) => {
                const source = '#' + $(el).attr('id');
                document.FooTableEx.updateInputs(source);
                $(el).removeClass('footable-update-inputs');
            })
    });

    /**
     * Отображает модальное окно по запросу
     */
    window.addEventListener('showModal', event => {
        const $form = $('#' + event.detail.modalId);

        $('.modal').modal('hide');
        if ($form.length) {
            $form.modal('show');
        }
    })

});

// Створення контексту Web Audio
            var audioCtx = new (window.AudioContext || window.webkitAudioContext)();

            // Завантаження аудіо-файлу
            var audioElement = new Audio('/audio/newMessage.mp3');
            var audioSrc = audioCtx.createMediaElementSource(audioElement);

            // Створення відтворювача
            var gainNode = audioCtx.createGain();
            gainNode.gain.value = 1; // Гучність звуку (від 0 до 1)

            // Підключення відтворювача до контексту Web Audio
            audioSrc.connect(gainNode);
gainNode.connect(audioCtx.destination);




$("._pass._pass-1").keyup(function() {
    var pass = $("._pass._pass-1").val();
    check(pass);
  });
  function check(pass) {
    var protect = 0;
    // РџСЂРѕРІРµСЂРєР° РЅР° РєРѕР»-РІРѕ СЃРёРјРІРѕР»РѕРІ
    if(pass.length >= 8) { protect++; }
    // РџСЂРѕРІРµСЂРєР° РЅР° РЅР°Р»РёС‡РёРµ СЃРёРјРІРѕР»РѕРІ a,s,d,f ... x,y,z
    var small = "([a-z]+)";
    if(pass.match(small)) { protect++; }
    // РџСЂРѕРІРµСЂРєР° РЅР° РЅР°Р»РёС‡РёРµ СЃРёРјРІРѕР»РѕРІ A,B,C,D ... X,Y,Z
    var big = "([A-Z]+)";
    if(pass.match(big)) { protect++; }
    // РџСЂРѕРІРµСЂРєР° РЅР° РЅР°Р»РёС‡РёРµ СЃРёРјРІРѕР»РѕРІ 1,2,3,4,5 ... 0
    var numb = "([0-9]+)";
    if(pass.match(numb)) { protect++; }
    //  РџСЂРѕРІРµСЂРєР° РЅР° РЅР°Р»РёС‡РёРµ СЃРёРјРІРѕР»РѕРІ !@#$
    var vv = /\W/;
    if(pass.match(vv)) { protect++; }
    // Р”РѕР±Р°РІР»РµРЅРёРµ РєР»Р°СЃСЃРѕРІ
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
