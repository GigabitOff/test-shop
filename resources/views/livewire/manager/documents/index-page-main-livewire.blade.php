<div class="lk-page__main">
    <div class="lk-page-header">
        <div class="lk-page-title">@lang('custom::site.my_documents')</div>
    </div>
    <div class="lk-table">
        @include('livewire.customer.documents.page-menu-livewire')
        <div class="lk-table-filter">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-3">
                    <x-livewire.custome-filterable
                        :placeholder="__('custom::site.client')"
                        name="filterableClient"
                        model="filterableClient.value"
                        :key="$filterableClient['id']"
                        :list="$filterableClient['list']"
                        :edit="$filterableMode === 'filterableClient'"
                    >
                    </x-livewire.custome-filterable>
                </div>
                <div class="col-xl-3 col-md-6 mb-3">
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
                @if($this->isFilterOrders())
                    <div class="col-xl-3 col-md-6 mb-3">
                        @php($counter = $attentions ? "/$attentions" : '')
                        <a class="lk-submenu__link d-inline-flex"
                           wire:click="onNeedsAttention"
                           href="javascript:void(0);">@lang('custom::site.needs_attention') {{$counter}}</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="lk-table-body @if($this->isFilterReversesOrComplaints()) --claim-list @endif">
            <div id="footable-content-{{$filter}}" class="footable-content" style="display: none" data-table="{{ $table }}"></div>
            <table wire:ignore id="footable-holder-{{$filter}}"
                   class="
                   @if($this->isFilterReverses()) table-with-table-inner table-reverse-invoices @endif
                   @if($this->isFilterComplaints()) table-with-table-inner @endif
                       "
                   data-empty="@lang('custom::site.data_is_absent')"
                   data-show-toggle="true" data-toggle-column="last">
            </table>
        </div>

        <div class="lk-table-footer">
            <div></div>
            @include('livewire.includes.per-page-table', ['data_paginate' => $records])
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            document.FooTableEx.init('#footable-content-{{$filter}}', '#footable-holder-{{$filter}}');
            window.addEventListener('updateFooData', (event)=>{
                document.FooTableEx.redraw('#footable-content-' + event.detail.filter);
            });
            window.addEventListener('redrawFooTable', (event)=>{
                const filter = event.detail.filter;
                document.FooTableEx.init('#footable-content-' + filter, '#footable-holder-' + filter);
            });
        })
        //# sourceURL=customer.documents.index-page-main-livewire.js
    </script>
@endpush
