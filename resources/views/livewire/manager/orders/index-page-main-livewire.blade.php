<div class="lk-page__main">
    <div class="lk-page-header">
        <div class="lk-page-title">@lang('custom::site.orders')</div>
    </div>
    <div class="lk-table">
        <div class="lk-table-filter">
            <div class="row">
                <div class="col-xl col-md-4 mb-3">
                    <x-livewire.custome-filterable
                        :placeholder="__('custom::site.by_order_id')"
                        name="filterableOrderId"
                        model="filterableOrderId.value"
                        :key="$filterableOrderId['id']"
                        :list="$filterableOrderId['list']"
                        :edit="$filterableOrderId['edit']"
                    >
                    </x-livewire.custome-filterable>
                </div>
                <div class="col-xl col-md-4 mb-3">
                    <x-livewire.custome-filterable
                        :placeholder="__('custom::site.by_product_article')"
                        name="filterableArticle"
                        model="filterableArticle.value"
                        :key="$filterableArticle['id']"
                        :list="$filterableArticle['list']"
                        :edit="$filterableArticle['edit']"
                    >
                    </x-livewire.custome-filterable>
                </div>
                <div class="col-xl col-md-4 mb-3">
                    <x-livewire.custome-filterable
                        :placeholder="__('custom::site.by_counterparty')"
                        name="filterableCounterparty"
                        model="filterableCounterparty.value"
                        :key="$filterableCounterparty['id']"
                        :list="$filterableCounterparty['list']"
                        :edit="$filterableCounterparty['edit']"
                    >
                    </x-livewire.custome-filterable>
                </div>
                <div class="col-xl col-md-4 mb-3">
                    <x-livewire.custome-filterable
                        :placeholder="__('custom::site.by_product_name')"
                        name="filterableProductName"
                        model="filterableProductName.value"
                        :key="$filterableProductName['id']"
                        :list="$filterableProductName['list']"
                        :edit="$filterableProductName['edit']"
                    >
                    </x-livewire.custome-filterable>
                </div>
                <div class="col-xl col-md-4 mb-3">
                    <input class="form-control" id="date_interval" type="text" placeholder="@lang('custom::site.for_date_interval')">
                    @include('livewire.includes.calendar-form',['formId'=>'date_interval','models'=>['start'=>'dateFrom', 'end'=>'dateTo']])
                </div>
            </div>
        </div>
        <div class="lk-table-header">
            <div class="submenu">
                <div class="submenu__title">@lang('custom::site.show'):</div>
                <div class="submenu__btn">
                    <button type="button">
                        <span class="submenu__current">@lang('custom::site.all') /{{$count_all}}</span>
                        <span class="ico_angel-b"></span>
                    </button>
                </div>
                <div class="submenu__drop">
                    <div class="submenu__box">
                        <ul class="lk-submenu">
                            <li class="lk-submenu__item @if($statusId === 0) active @endif">
                                <a class="lk-submenu__link"
                                   wire:click="setStatusId(0)"
                                   href="javascript:void(0);">@lang('custom::site.all') /{{$count_all}}</a></li>
                            @foreach($statusList as $id => $status)
                            <li class="lk-submenu__item @if($statusId === $id) active @endif">
                                <a class="lk-submenu__link"
                                   wire:click="setStatusId({{$id}})"
                                   href="javascript:void(0);">{{$status['name']}} /{{$status['ordersCount']}}</a></li>
                            @endforeach
                            <li class="lk-submenu__item">
                                <a class="lk-submenu__link"
                                   wire:click="resetAllFilters"
                                   href="javascript:void(0);">@lang('custom::site.reset_filters')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @if($this->isNotDirector())
            <a class="button button-primary" href="{{route('manager.orders.create')}}"
               data-da=".lk-btn-empty, 1199">@lang('custom::site.create_order')</a>
            @endif
        </div>
        <div class="lk-table-body">
            <div id="footable-content" class="footable-content" style="display: none" data-table="{{ $table }}"></div>
            <table wire:ignore id="footable-holder"
                   data-empty="@lang('custom::site.data_is_absent')"
                   data-show-toggle="true" data-toggle-column="last">
            </table>
        </div>
        <div class="lk-table-footer">
            <div class="lk-table-footer-filter">
                <x-livewire.custome-filterable
                    class="lk-table-select"
                    :placeholder="__('custom::site.customer_filter')"
                    name="filterableCustomer"
                    model="filterableCustomer.value"
                    :key="$filterableCustomer['id']"
                    :list="$filterableCustomer['list']"
                    :edit="$filterableCustomer['edit']"
                >
                </x-livewire.custome-filterable>
                <div class="lk-table-search">
                    <x-livewire.custome-filterable
                        type="custome-dropdown-search"
                        :placeholder="__('custom::site.search')"
                        name="filterableSearch"
                        model="filterableSearch.value"
                        :key="$filterableSearch['id']"
                        :list="$filterableSearch['list']"
                        :edit="$filterableSearch['edit']"
                    >
                    </x-livewire.custome-filterable>
                </div>
            </div>
            @include('livewire.includes.per-page-table', ['data_paginate' => $orders])
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            document.FooTableEx.init('#footable-content', '#footable-holder');
            window.addEventListener('updateFooData', () => {
                document.FooTableEx.redraw('#footable-content');
            });
            window.addEventListener('eventResetDateInterval', () => {
                $('#date_interval').val('');
            });
        })
        //# sourceURL=manager.orders.index-page-main-livewire.js
    </script>
@endpush

@push('custom-styles')
    <style>
        .lk-table-header{
            align-items: flex-start;
        }
        .lk-table-header .lk-submenu{
            flex-wrap: wrap;
        }
        .lk-table-header .lk-submenu__item {
            margin-bottom: 8px;
        }
    </style>
@endpush
