<div class="lk-page__content">
  <h1 class="lk-page__title">@lang('custom::site.my_documents')</h1>
  <div class="lk-page__action">
    <div class="lk-page__submenu">
      <div class="submenu">
        <div class="submenu__title">@lang('custom::site.show'):</div><button class="submenu__btn" type="button"><a class="lk-submenu__link" href="#!"><span class="lk-submenu__title">@lang('custom::site.orders')</span><span class="lk-submenu__number">{{$records->count()}}</span></a></button>
        <div class="submenu__box">
          <ul class="lk-submenu">
            <li class="lk-submenu__item active"><a class="lk-submenu__link" href="#!"><span class="lk-submenu__title">@lang('custom::site.orders')</span><span class="lk-submenu__number">{{$records->count()}}</span></a></li>
            <li class="lk-submenu__item"><a class="lk-submenu__link" href="#!"><span class="lk-submenu__title">@lang('custom::site.invoices')</span><span class="lk-submenu__number">{{$invoices}}</span></a></li>
            <li class="lk-submenu__item"><a class="lk-submenu__link" href="#!"><span class="lk-submenu__title">@lang('custom::site.invoices_expense')</span><span class="lk-submenu__number">{{$waybill}}</span></a></li>
            <li class="lk-submenu__item"><a class="lk-submenu__link" href="lk-documents-complaint.html"><span class="lk-submenu__title">@lang('custom::site.complaint_acts')</span><span class="lk-submenu__number">{{$compliant}}</span></a></li>
            <li class="lk-submenu__item"><a class="lk-submenu__link" href="lk-documents-return.html"><span class="lk-submenu__title">@lang('custom::site.return_invoices')</span><span class="lk-submenu__number">{{$reverseInvoice}}</span></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="lk-page__filters">
    <div>
        <x-livewire.custome-filterable
            :placeholder="__('custom::site.client')"
            name="filterableClient"
            model="filterableClient.value"
            :key="$filterableClient['id']"
            :list="$filterableClient['list']"
            :edit="$filterableMode === 'filterableClient'">
        </x-livewire.custome-filterable>

    </div>
    <div>
        <x-livewire.custome-filterable
            type="custome-dropdown-search"
            :placeholder="__('custom::site.search')"
            name="filterableSearch"
            class="--search _active"
            model="filterableSearch.value"
            :key="$filterableSearch['id']"
            :list="$filterableSearch['list']"
            :edit="$filterableMode === 'filterableSearch'">
        </x-livewire.custome-filterable>

    </div>
  </div>
    <div class="lk-page__table">
            <div id="footable-content-{{$filter}}" class="footable-content" style="display: none"
                 data-table="{{ $table }}"></div>
            <table class="ftable" wire:ignore id="footable-holder-{{$filter}}"
                   class="
                   @if($this->isFilterReverses()) table-with-table-inner table-reverse-invoices @endif
                   @if($this->isFilterComplaints()) table-with-table-inner @endif
                       "
                   data-empty="@lang('custom::site.data_is_absent')"
                   data-show-toggle="true" data-toggle-column="last">
            </table>
    </div>
  <div class="lk-page__table-after">
    <div></div>
    @include('livewire.includes.per-page-table', ['data_paginate' => $records])
  </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            document.FooTableEx.init('#footable-content-{{$filter}}', '#footable-holder-{{$filter}}');
            window.addEventListener('updateFooData', (event) => {
                document.FooTableEx.redraw('#footable-content-' + event.detail.filter);
            });
            window.addEventListener('redrawFooTable', (event) => {
                const filter = event.detail.filter;
                document.FooTableEx.init('#footable-content-' + filter, '#footable-holder-' + filter);
            });
        })
        //# sourceURL=customer.documents.index-page-main-livewire.js
    </script>
@endpush