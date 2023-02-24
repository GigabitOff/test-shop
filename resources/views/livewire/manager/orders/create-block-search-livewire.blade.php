<div>
    <div class="lk-table">
        <div class="lk-table-filter row">
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
            <div class="col-xl-3 col-md-4 col-10 mb-2">
                {{--                <x-livewire.custome-filterable--}}
                {{--                    :placeholder="__('custom::site.by_product_name')"--}}
                {{--                    name="filterableProductName"--}}
                {{--                    model="filterableProductName.value"--}}
                {{--                    :key="$filterableProductName['id']"--}}
                {{--                    :list="$filterableProductName['list']"--}}
                {{--                    :edit="$filterableMode === 'filterableProductName'"--}}
                {{--                >--}}
                {{--                </x-livewire.custome-filterable>--}}

            </div>
            <div class="col-xl-3 col-md-4 col-2 mb-2 ml-auto">
                <div class="d-flex justify-content-end">
                    <button class="button button-primary" type="button"
                            onclick="document.lazyWireModal.uploadAndShow('modal-customer-create', {'force':true, payload:{manager_id:{{auth()->user()->id}}}})"
                            data-toggle="modal" data-target="#modal-add-user"
                            data-da=".lk-btn-empty, 1199">@lang('custom::site.create_customer')</button>
                    <div class="action-group ml-2">
                        <div class="action-item" wire:click="clearSearchList">
                            <div class="action-item__btn"><span class="ico_trash"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--        <div class="lk-table-search">--}}
        {{--            @include('livewire.includes.search-dropdown')--}}
        {{--        </div>--}}
        {{--        <button class="js-clear-list-products button button-secondary"--}}
        {{--                wire:click="clearSearchList"--}}
        {{--                type="button">@lang('custom::site.clear_list')</button>--}}
    </div>
    <div class="lk-table-body js-clear-box">
        <div id="footable-content" class="footable-content" style="display: none" data-table="{{ $table }}"></div>
        <table id="footable-holder" data-show-toggle="true" data-empty="@lang('custom::site.data_is_absent')"
               data-toggle-column="last" wire:ignore></table>
    </div>
    <div class="lk-table-footer mb-4 js-clear-box">
        <div>
            <div class="button-group">
                <a  class="button button-secondary"
                    href="#modal-bulk-upload-products"
                    data-toggle="modal">@lang('custom::site.upload_excel')</a>
            </div>
        </div>
        @include('livewire.includes.per-page-table', ['data_paginate' => $products])
    </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            document.FooTableEx.init('#footable-content', '#footable-holder');
            window.addEventListener('updateFooData', () => {
                document.FooTableEx.redraw('#footable-content');
            });

            // Обновляем input-ы элементов в таблице, для случая когда изменилось количество.
            window.addEventListener('cartQuantityUpdated', event => {
                // исключаем случай когда обновление было инициировано самой же таблицей.
                if ('table' !== event.detail.source) {
                    const ids = Object.keys(event.detail.products);
                    $('#footable-holder input.input-col')
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
