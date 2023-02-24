<div class="lk-page__content">
  <div class="lk-page__head">
    <h1 class="lk-page__title">{{__('custom::site.my_orders')}}</h1>
  </div>
  <div class="lk-page__action">
    <livewire:customer.orders.index-filter-section-livewire />

    <div class="lk-page__action-btns">
        <a class="button-outline" href="{{route('customer.orders.create')}}">
            @lang('custom::site.create_order')</a>
    </div>
  </div>
      <div class="lk-page__table" >
        <div id="footable-content"
             class="footable-content @if($this->isNeedRevalidateFootable()) footable-revalidate @endif"
             style="display: none" >
            @include('livewire.customer.orders.index-footable-render')
        </div>
        <table class="ftable" wire:ignore id="footable-holder"
               data-empty="@lang('custom::site.data_is_absent')"
               data-show-toggle="true" data-toggle-column="last">
        </table>
    </div>

  <div class="lk-page__table-after">
    <div>
      <div class="drop --search">
        @include('livewire.includes.search-dropdown-live')
      </div>
    </div>
    <div>
    @include('livewire.includes.per-page-table', ['data_paginate' => $orders])
    </div>
  </div>
</div>
