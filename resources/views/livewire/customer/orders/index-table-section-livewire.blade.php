<div class="lk-page__content">
  <div class="lk-page__head">
    <h1 class="lk-page__title">{{__('custom::site.my_orders')}}</h1>
  </div>
  <div class="lk-page__filters">
                <div class="--search"><span class="drop-clear @if(isset($filter['id'])) _active @endif" onclick="@this.deleteFilterList('id')"></span>
                <input class="form-control drop-input" wire:model="searchId" type="text" autocomplete="off" placeholder="@lang('custom::site.By Order No.')">
                </div>
                {{--<div class="drop --search"><span class="drop-clear @if(isset($filter['customer'])) _active @endif" onclick="@this.deleteFilterList('customer')"></span>
                <input class="form-control drop-input" oninput="sellectFilterListOrder('customer',this.value)" type="text" autocomplete="off" placeholder="@lang('custom::site.customer')">
                </div>--}}

                <div class=" --search">
                    <span class="drop-clear @if($search != '') _active @endif" onclick="@this.set('search','')"></span>
                <input class="form-control drop-input" wire:model.debounce.650ms="search" type="text" autocomplete="off" placeholder="@lang('custom::site.search')">
                </div>
              </div>
  <div class="lk-page__action">
    <livewire:customer.orders.index-filter-section-livewire />

    <div class="lk-page__action-btns">
        <a class="button-outline" href="{{ auth()->user()->hasRole('simple') ? route('catalog.index') : route('customer.orders.create')}}">
            @lang('custom::site.create_order')</a>
    </div>
  </div>
      <div class="lk-page__table" >
        <div id="footable-content"
             class="footable-content @if($this->isNeedRevalidateFootable()) footable-revalidate @endif"
             style="display: none" >
            @include('livewire.customer.orders.index-footable-render')
        </div>
        <table class="ftable table-w-inner" wire:ignore id="footable-holder"
               data-empty="@lang('custom::site.data_is_absent')"
                data-breakpoints="{ &quot;small&quot;: 768, &quot;medium&quot;: 992, &quot;large&quot;: 1450, &quot;x-large&quot;: 1600 }">
        </table>
    </div>

  <div class="lk-page__table-after">
    <div>
      {{--<div class="drop --search">
        @include('livewire.includes.search-dropdown-live')
      </div>--}}
    </div>
    <div>
    @include('livewire.includes.per-page-table', ['data_paginate' => $orders])
    </div>
  </div>
</div>
