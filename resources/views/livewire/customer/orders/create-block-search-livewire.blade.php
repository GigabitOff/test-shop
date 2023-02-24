<div>
    <div class="lk-page__action">
        <div class="lk-page__filters">
            @include('livewire.includes.drop-filterable-front', [
                'class' => '--arrow',
                'model' => 'filterableBrand',
                'placeholder' => __('custom::site.Producers'),
            ])

            @include('livewire.includes.drop-filterable-front', [
                'class' => '--arrow',
                'model' => 'filterableSort',
                'placeholder' => __('custom::site.sorting'),
            ])

            @include('livewire.includes.drop-filterable-back', [
                'class' => '--search',
                'model' => 'filterableSearch',
                'placeholder' => __('custom::site.search'),
            ])
        </div>
        <div class="lk-page__submenu" data-da=".da, 1199, 0">
            <div class="submenu">
                <div class="submenu__title">@lang('custom::site.show'):</div>
                @php($curRankView = $filterableRankViewList[$selectedRankView] ?? [])
                <button class="submenu__btn" type="button">
                    <a class="lk-submenu__link" href="javascript:void(0);">
                        <span class="lk-submenu__title">{{$curRankView['label'] ?? ''}}</span>
                        <span class="lk-submenu__number">{{$curRankView['quantity'] ?? ''}}</span>
                    </a>
                </button>
                <div class="submenu__box">
                    <ul class="lk-submenu">
                        @foreach($filterableRankViewList as $key => $rankView)
                            <li class="lk-submenu__item">
                                <a class="lk-submenu__link"
                                   wire:click="selectRankView('{{$key}}')"
                                   href="javascript:void(0);">
                                    <span class="lk-submenu__title">{{$rankView['label']}}</span>
                                    <span class="lk-submenu__number">{{$rankView['quantity']}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="lk-page__table">
        <div id="footable-content" class="footable-content" style="display: none" data-table="{{ $table }}"></div>
        <table class="ftable" wire:ignore data-toggle-column="last"
               data-empty="@lang('custom::site.data_is_absent')"
               id="footable-holder"></table>
    </div>
    <div class="lk-page__table-after">
        <div></div>
        @include('livewire.includes.per-page-footable', ['paginator' => $products])
    </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            // document.FooTableEx.init('#footable-content', '#footable-holder');
            window.addEventListener('updateFooData', () => {
                document.FooTableEx.redraw('#footable-content');
            });

            // Обновляем input-ы элементов в таблице, для случая когда изменилось количество.
            window.addEventListener('cartQuantityUpdated', event => {
                // исключаем случай когда обновление было инициировано самой же таблицей.
                if ('table' !== event.detail.source) {
                    const ids = Object.keys(event.detail.products);
                    $('#footable-holder input.col')
                        .each((i, input) => {
                            const id = $(input).attr('data-id');
                            if (ids.includes(id)) {
                                $(input).val(event.detail.products[id]);
                            } else {
                                $(input).val(0);
                            }
                        });
                }
            });
        });

        //# sourceURL=customer.order.create-block-search.js
    </script>
@endpush
