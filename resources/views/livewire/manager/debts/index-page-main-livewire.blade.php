<div class="lk-page__main">
    <div class="lk-page-header">
        <div class="lk-page-title">@lang('custom::site.receivables')</div>
    </div>
    <div class="lk-table">
        <div class="lk-table-filter row">
            <div class="col-xl-3 col-md-4 mb-2">
                <x-livewire.custome-filterable
                    :placeholder="__('custom::site.counterparty')"
                    name="filterableCounterparty"
                    model="filterableCounterparty.value"
                    :key="$filterableCounterparty['id']"
                    :list="$filterableCounterparty['list']"
                    :edit="$filterableMode === 'filterableCounterparty'"
                >
                </x-livewire.custome-filterable>
            </div>
            <div class="col-xl-3 col-md-4 mb-2 nice-select-group">
                <x-livewire.nice-select
                    name="sortable"
                    model="sortable_id"
                    :list="$sortable_list"
                    :placeholder="__('custom::site.sorting')">
                </x-livewire.nice-select>
            </div>
            <div class="col-xl-3 col-md-4 mb-2">
                <x-livewire.custome-filterable
                    type="custome-dropdown-search"
                    :placeholder="__('custom::site.search')"
                    name="filterableSearch"
                    model="filterableSearch.value"
                    :key="$filterableSearch['id']"
                    :list="$filterableSearch['list']"
                    :edit="$filterableMode === 'filterableSearch'"
                >
                </x-livewire.custome-filterable>
            </div>
        </div>
        <div class="lk-table-body">
            <div id="footable-content" class="footable-content" style="display: none" data-table="{{ $table }}"></div>
            <table wire:ignore id="footable-holder"
                   data-empty="@lang('custom::site.data_is_absent')"
                   data-show-toggle="true" data-toggle-column="last">
            </table>
        </div>

        <div class="lk-table-footer">
            <div>
                <x-livewire.custome-filterable
                    :placeholder="__('custom::site.client')"
                    class="lk-table-select"
                    name="filterableCustomer"
                    model="filterableCustomer.value"
                    :key="$filterableCustomer['id']"
                    :list="$filterableCustomer['list']"
                    :edit="$filterableMode === 'filterableCustomer'"
                >
                </x-livewire.custome-filterable>
            </div>
            @include('livewire.includes.per-page-table', ['data_paginate' => $contracts])
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {

            $(document).on("expand.ft.row", '.footable', function (e, ft, row) {
                console.log('expand.ft.row')
                // console.log(e, ft)
                setTimeout(function(){
                    row.$details.each((i,el) => {
                        $(el).find('tbody td').removeClass('text-md-center');
                    });
                }, 60)
            });

            document.FooTableEx.init('#footable-content', '#footable-holder');
            window.addEventListener('updateFooData', () => {
                document.FooTableEx.redraw('#footable-content');
            });

            document.receivables = {
                onPayOrder: function(orderId){
                    @this.onPayOrder(orderId);
                }
            }
        })
        //# sourceURL=customer.receivables.page-main.js
    </script>
@endpush
