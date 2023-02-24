<div class="row g-3">
    <div class="col-xl-3 col-md-6">
        <div class="drop">
            <span class="drop-clear @if(isset($filter['name'])) _active @endif" onclick="@this.deleteFilterList('name')"></span>
        </div>
        <input class="form-control" wire:model.lazy="filter.name" type="text" placeholder="@lang('custom::admin.products.Product name')" oninput="sellectFilterList_1('name',this.value,null,true)">
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="drop">
            <span class="drop-clear @if(isset($filter['articul'])) _active @endif" onclick="@this.deleteFilterList('articul')"></span>
    </div>
        <input class="form-control"  wire:model.lazy="filter.articul" type="text" placeholder="@lang('custom::admin.products.Product artikul')" oninput="sellectFilterList_1('articul',this.value)">
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="input-group">
            <input class="form-control text-center" type="number" placeholder="@lang('custom::admin.Price from')"
                oninput="sellectFilterList_1('price_from',this.value)">

            <input class="form-control text-center" type="number" placeholder="@lang('custom::admin.Price to')"
                oninput="sellectFilterList_1('price_to',this.value)">

        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="drop --arrow @if(isset($filter['set_category']) AND !isset($select_data['set_category']['input'])) _active @endif" wire:ignore.self>
            <span class="drop-clear @if(isset($filter['set_category'])) _active @endif" onclick="@this.deleteFilterList('set_category')"></span>
            <input class="form-control drop-input" oninput="@this.searchSelectCategoryDataFilter(this.value)" type="text" autocomplete="off" placeholder="@lang('custom::admin.products.Product category')" value="{{ isset($select_data['set_category']['input']) ? $select_data['set_category']['input'] : ''}}" />
            <div class="drop-box" @if(isset($filter['set_category']) AND !isset($select_data['set_category']['input'])) style="display: block" @endif>
                <div class="drop-overflow">
                    <ul class="drop-list">

                    @foreach ($category as $item)

                        <li class="drop-list-item"  onclick="sellectFilterList_1('set_category', '{{ $item['id'] }}','{{ $item['name'] }}')">@if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->name)){{$item->translate(session('lang'))->name}}@else{{config('app.fallback_locale') }}@endif</li>
                    @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="drop --arrow"><span class="drop-clear @if(isset($filter['set_availability'])) _active @endif" onclick="@this.deleteFilterList('set_availability')"></span>
            <input class="form-control drop-input" type="text" autocomplete="off" placeholder="@lang('custom::admin.products.Product availability')" value="{{ isset($filter['set_availability']) ? __('custom::admin.availability.'.$filter['set_availability']) : ''}}" />
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                         @foreach (\App\Models\Product::AVAILABILITY_TYPES as $ke_av => $item_av)
                      <li class="drop-list-item" onclick="sellectFilterList_1('set_availability',{{$item_av}})">{{  __('custom::admin.availability.'.$ke_av) }}</li>

                        @endforeach

                    </ul>
                  </div>
                </div>
              </div>
    </div>
    {{-- <div class="col-xl-2 col-md-6">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="@lang('custom::admin.products.Manufacture')"
                oninput="sellectFilterList_1('manufacturer',this.value,null,'lang')">

        </div>
       <div class="drop --arrow"><span class="drop-clear"></span>
            <input class="form-control drop-input" type="text" autocomplete="off" placeholder="Производитель" />
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">Производитель 1</li>
                      <li class="drop-list-item">Производитель 2</li>
                      <li class="drop-list-item">Производитель 3</li>
                      <li class="drop-list-item">Производитель 4</li>
                      <li class="drop-list-item">Производитель 5</li>
                      <li class="drop-list-item">Производитель 6</li>
                      <li class="drop-list-item">Производитель 7</li>
                      <li class="drop-list-item">Производитель 8</li>
                      <li class="drop-list-item">Производитель 9</li>
                      <li class="drop-list-item">Производитель 10</li>
                    </ul>
                  </div>
                </div>
              </div>
    </div>--}}

    {{--<div class="col-xl-3 col-md-6">
        <input class="form-control" type="text" placeholder="@lang('custom::admin.products.Seller')"
                oninput="sellectFilterList_1('seller',this.value,null,'lang')">
              <div class="drop --arrow"><span class="drop-clear"></span><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Продавец" />
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">Продавец 1</li>
                      <li class="drop-list-item">Продавец 2</li>
                      <li class="drop-list-item">Продавец 3</li>
                      <li class="drop-list-item">Продавец 4</li>
                      <li class="drop-list-item">Продавец 5</li>
                      <li class="drop-list-item">Продавец 6</li>
                      <li class="drop-list-item">Продавец 7</li>
                      <li class="drop-list-item">Продавец 8</li>
                      <li class="drop-list-item">Продавец 9</li>
                      <li class="drop-list-item">Продавец 10</li>
                    </ul>
                  </div>
                </div>
              </div>
    </div>--}}
            <div class="col-xl-4 col-md-6">
                @include('livewire.admin.includes.select-data-arrow',[
                    'select_data_input'=>(isset($filter['set_atribute']) ? $select_array['set_atribute'][$filter['set_atribute']]['name']: null),
                    'select_data_array'=>$select_array['set_atribute'],
                    'placeholder'=>__('custom::admin.products.Features'),
                    'index'=>'set_atribute',
                    'show_name'=>true,
                    'onClick' =>'sellectFilterList',
                    'key_for_select_array'=>'hide_parent_id',
                    'classTable' => 'Attribute',
                    'searchSelectDataArrow'=>'set_atribute'])


            </div>
            <div class="col-xl-4 col-md-6">
              <div class="drop --search">
                  <span class="drop-clear @if($search != '')_active @endif" onclick="@this.deleteFilterList('search')"></span>
                  <input class="form-control drop-input" type="text" autocomplete="off" placeholder="@lang('custom::admin.Search')" wire:model.debounce.1000ms="search" {{--oninput="sellectFilterList_1('search',this.value,null,true)"--}} />
                {{--<div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      <li class="drop-list-item">Результат поиска 1</li>
                      <li class="drop-list-item">Результат поиска 2</li>
                      <li class="drop-list-item">Результат поиска 3</li>
                      <li class="drop-list-item">Результат поиска 4</li>
                      <li class="drop-list-item">Результат поиска 5</li>
                      <li class="drop-list-item">Результат поиска 6</li>
                      <li class="drop-list-item">Результат поиска 7</li>
                      <li class="drop-list-item">Результат поиска 8</li>
                      <li class="drop-list-item">Результат поиска 9</li>
                      <li class="drop-list-item">Результат поиска 10</li>
                    </ul>
                </div>--}}
            </div>
        </div>
    </div>
</div>

<script>
    function sellectFilterList_1(type,value,set,set2) {
    setTimeout(() => {
        //alert(value);
        @this.sellectFilterList(type,value,set,set2)
        //changeTableFoot();

    }, 600);
    }
    document.addEventListener("DOMContentLoaded", function(event) {
        $('.form-control').on('input',function() {
            setTimeout(() => {
                  //  changeTableFoot();

            }, 500);
         });
    });
</script>
