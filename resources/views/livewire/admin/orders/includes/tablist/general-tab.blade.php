<div class="orders-filter">
            <div>
              <div class="drop --search">
                <span class="drop-clear @if(isset($filter['id'])) _active @endif" onclick="@this.deleteFilterList('id')"></span>
                <input class="form-control drop-input" oninput="sellectFilterListOrder('id',this.value)" type="text" autocomplete="off" placeholder="@lang('custom::admin.By Order No.')">
             {{--   <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">№ заказ 1</li>
                      <li class="drop-list-item">№ заказ 2</li>
                      <li class="drop-list-item">№ заказ 3</li>
                      <li class="drop-list-item">№ заказ 4</li>
                      <li class="drop-list-item">№ заказ 5</li>
                      <li class="drop-list-item">№ заказ 6</li>
                      <li class="drop-list-item">№ заказ 7</li>
                      <li class="drop-list-item">№ заказ 8</li>
                      <li class="drop-list-item">№ заказ 9</li>
                      <li class="drop-list-item">№ заказ 10</li>
                    </ul>
                  </div>
                </div>--}}
              </div>
            </div>
            <div>
              <div class="drop --search">
                <span class="drop-clear @if(isset($filter['customer'])) _active @endif" onclick="@this.deleteFilterList('customer')"></span>
                <input class="form-control drop-input" oninput="sellectFilterListOrder('customer',this.value)" type="text" autocomplete="off" placeholder="@lang('custom::admin.Сustomer')">
             {{--   <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">№ заказ 1</li>
                      <li class="drop-list-item">№ заказ 2</li>
                      <li class="drop-list-item">№ заказ 3</li>
                      <li class="drop-list-item">№ заказ 4</li>
                      <li class="drop-list-item">№ заказ 5</li>
                      <li class="drop-list-item">№ заказ 6</li>
                      <li class="drop-list-item">№ заказ 7</li>
                      <li class="drop-list-item">№ заказ 8</li>
                      <li class="drop-list-item">№ заказ 9</li>
                      <li class="drop-list-item">№ заказ 10</li>
                    </ul>
                  </div>
                </div>--}}
              </div>
            </div>

            <div>
              <div class="drop --search">
                <span class="drop-clear @if($search != '') _active @endif" onclick="@this.set('search','')"></span>
                <input class="form-control drop-input" wire:model.debounce.650ms="search" type="text" autocomplete="off" placeholder="@lang('custom::admin.Search')">
             {{--   <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">№ заказ 1</li>
                      <li class="drop-list-item">№ заказ 2</li>
                      <li class="drop-list-item">№ заказ 3</li>
                      <li class="drop-list-item">№ заказ 4</li>
                      <li class="drop-list-item">№ заказ 5</li>
                      <li class="drop-list-item">№ заказ 6</li>
                      <li class="drop-list-item">№ заказ 7</li>
                      <li class="drop-list-item">№ заказ 8</li>
                      <li class="drop-list-item">№ заказ 9</li>
                      <li class="drop-list-item">№ заказ 10</li>
                    </ul>
                  </div>
                </div>--}}
              </div>
            </div>

            <div>

              <div class="input-group" wire:key="filter_date_from" >
                <input readonly id="filter_date_from_to" @error("filter.date_from") style='border: 1px solid red' @enderror type="text" class="js-date-multy form-control" value="{{ isset($filter['date_from']) ? \Carbon\Carbon::parse($filter['date_from'])->format('d.m.Y') : ''}} {{ isset($filter['date_to']) ? '-'.\Carbon\Carbon::parse($filter['date_to'])->format('d.m.Y') : ''}}" placeholder="@lang('custom::admin.From')-@lang('custom::admin.To')" />
                @include('livewire.admin.includes.calendar-form',['formId'=>'filter_date_from_to','nameForm'=>'filter.date_start_end','date_start'=>'filter.date_from','date_end'=>'filter.date_to','hide_min_date'=>true,'clear'=>true])

        <input type="hidden" wire:model="filter.date_from">

        <input type="hidden" wire:model="filter.date_to">
                <button class="js-clear-date clear-date" type="button" onclick="@this.deleteFilterList('date_from'); @this.deleteFilterList('date_to'); $('#filter_date_from_to').val('');"></button>
            </div>
            </div>
          </div>
          <div wire:ignore>
          @livewire('admin.orders.order-index-filter-livewire', key(time().'-order-index'))

          </div>

<div id="footable-content"
             class="footable-content @if($this->isNeedRevalidateFootable()) footable-revalidate @endif"
             style="display: none">
            @include('livewire.admin.orders.includes.index-footable-render')
        </div>
<table wire:ignore id="footable-holder" class="users-table table-td-small"
               data-empty="@lang('custom::site.data_is_absent')"
               data-show-toggle="true" data-toggle-column="last">
        </table>
<script>
    function sellectFilterListOrder(type,value,set,set2) {
    setTimeout(() => {
        //alert(value);
        @this.sellectFilterList(type,value,set,set2)
        //changeTableFoot();

    }, 600);
    }
</script>
