/**
 * Работа с таблицами footable
 * Адаприровано под работу с Livewire
 */
document.addEventListener('DOMContentLoaded', function () {


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
            const data = $(source).html() || $(source).attr('data-table');
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
        updateInputs: function (source) {
            let ft = this.data[source];
            if (ft === undefined) {
                return;
            }
            ft.$el.find('input').each((i, el) => {
                const value = $(el).attr('data-ft-value');
                if (value !== undefined) {
                    switch ($(el).attr('type')) {
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
            const data = $(source).html() || $(source).attr('data-table')
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
            const data = $(source).html() || $(source).attr('data-table')
            return $(data).find('tbody tr')
                .map((i, row) => {
                    let data = {};
                    let tds = $(row).find('td');
                    for (let j = 0; j < tds.length; j++) {
                        data['col_' + j] = {
                            value: this.packInputValues(tds.eq(j).html()),
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
        },
        packInputValues: function (html) {
            $(html).find('input')
                .each((i, el) => {
                    let value = '';
                    switch ($(el).attr('type')) {
                        case 'text':
                        case 'number':
                        case 'password':
                            value = $(el).val();
                            break;
                        case 'checkbox':
                            value = $(el).prop('checked');
                            break;
                    }
                    $(el).attr('data-ft-value', value);
                })
            return html;
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
                $(el).removeClass('footable-revalidate');
            })
    });

})
