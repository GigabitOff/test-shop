<div>

<div class="search  @if($search)is-active @endif" >
<div class="search__body">
    {{-- Action Search Product Livewire. --}}
    {{--<div class="search__label"  onclick="@this.addProductToActionAll(); this.disabled;"><span class="ico_plus" ></span></div>--}}
        <div class="search__controls w-100 ">
            <input type="text" id="id_search_action" placeholder="@lang('custom::admin.Enter the name or article number of the product')" wire:model.debounce.700ms="search">

    </div>
    <div class="search__drop uk-drop search__drop_1 @if($search AND $search != '')is-show @endif" @if($search == '') @if(!$search__drop_show  AND isset($action_product) AND count($action_product)<5) style="display: none;"  @endif  @endif >
        <div class="search__result">
            <div class="search__result-box">
            <div class="tagger"  @if($search == '') style="display: none;" @endif>
                <input class="js-tags" type="hidden" placeholder="Артикул товара" hidden="hidden" value="sfdsf">
                <ul>

            @if($products_entered AND count($products_entered)>0 )
                @foreach ($products_entered as $key_pr=>$item_pr)
                    <li><a href="javascript:void(0);"  class="--yellow" >
                        <span class="label">{{ $item_pr['articul'] ? $item_pr['articul'] : 'no articul' }}</span>
                        <span class="close --yellow" onclick="@this.removeProductFromActionSearchTmp('{{$key_pr}}')">×</span>
                    </a></li>
                @endforeach
            @endif

            @if(isset($select_products_no_articul) AND count($select_products_no_articul)>0)
            @foreach ($select_products_no_articul as $key_no_art=>$item_no_art)
                    <li><a href="javascript:void(0);">
                        <span class="label">{{ $item_no_art }}</span>
                        <span class="close" onclick="@this.removeProductFromActionSearchTmp('{{ $item_no_art }}')">×</span>
                    </a></li>
                @endforeach
            @endif
                    <li class="tagger-new">
                        <input class="js-tags-next" onkeypress="return addNewProducts(event,this.value)" placeholder="@lang('custom::admin.products.Product artikul')" list="tagger-completion-1">
                        <div class="tagger-completion"></div>
                    </li>
                </ul>
            </div>
                        </div>
                      <div class="search__result-btns">
                        <div class="result-clear" onclick="@this.setDataProductsToDb('true');  clearNewProducts();">@lang('custom::admin.Cansel')</div>
                    @if($products_entered AND count($products_entered)>0 )
                        <div class="result-select" onclick="@this.addProductToActionAll(); this.disabled;  clearNewProducts();">@lang('custom::admin.Select')</div>
                    @endif
                      </div>
        </div>
        <div class="search__items">
            @if($result_search AND count($result_search)>0)

            <table class="js-table js-table_new  footable footable-1 footable-paging footable-paging-right">
                <thead class="d-none">
                          <tr class="footable-header">
                            <td class="footable-first-visible" style="display: table-cell;">@lang('custom::admin.products.Product name')</td>
                            <td data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.products.Brand')</td>
                            <td data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Status')</td>
                            <td data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.products.Articul')</td>
                            <td data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.products.Price')</td>
                            <td data-breakpoints="xs" class="footable-last-visible" style="display: table-cell;"></td>
                        </tr>
                        </thead>
                <tbody>
                @foreach ($result_search as $key=>$item)
                <tr>
                    <td style="display: table-cell;">
                        <span>{{ $item->translate(session('lang')) ? $item->translate(session('lang'))->name : config('app.fallback_locale') }}</span>
                    </td>
                    <td style="display: table-cell;">
                        <span class="title">@lang('custom::admin.products.Brand')</span><span>{{ $item->brand ? ($item->brand->translate(session('lang')) ? $item->brand->translate(session('lang'))->title : config('app.fallback_locale')) : config('app.fallback_locale') }}</span>
                    </td>
                    <td style="display: table-cell;">
                        <button class="button-status status-1"><span class="circle"></span>
                            <span>{{  __('custom::admin.availability.'.$item->availability) }}</span></button>
                    </td>
                    <td style="display: table-cell;">
                        <span class="title">@lang('custom::admin.products.Articul')</span>
                        <a class="accent" href="#!">№ {{$item->articul}}</a>
                    </td>
                    <td style="display: table-cell;">
                        <strong>{{ $item->getPriceAttribute()}} @lang('custom::admin.products.UAH')</strong>
                    </td>
                    <td style="display: table-cell;">
                        <button class="button button-accent button-small button-icon ico_plus @if(isset($action_product[$item->id]) OR isset($products_entered[$item->id])) is-active @endif"
                            @if(isset($action_product[$item->id]) OR isset($products_entered[$item->id])) onclick="@this.removeProductFromActionSearchTmp({{$item->id}})" @else wire:click="addProductToActionTmp({{$item->id}})" @endif></button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
           @elseif($search AND $search != '')
            @lang('custom::admin.No results found for your search results')
            @endif
        </div>
        <div>
              @include('livewire.admin.includes.per-page-table',[ 'data_paginate'=> $result_search])
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        var search_h = $('.search');
        $(document).click(function (e) {
        if (!$(e.target).closest(".search").length && search_h.hasClass('is-active')) {
            @this.clearSearchData();
        }

        });



        $('#id_search_action').on('keypress',function(e) {
            if(e.which == 13) {
                @this.addProductToActionTmpPressEnter($('#id_search_action').val());
            }
        });



    });

    window.addEventListener('showSearchResults', () => {
            var height =0;

            if($('.search__drop').height() != height){
                height = $('.search__drop').height()+50;
                $('.search__drop').attr('style','top:-'+height+'px; display:block;');
            }

         });

    function setBlockUp(params) {
        setTimeout(() => {
            name
        }, 700);

    }
    function addNewProducts(e,val='') {
     if(e.which == 13) {

        @this.setDataProducts(val);
        $('.js-tags-next').val('');
    }
   }

   function clearNewProducts() {
        $('.search__drop_{{ $table_name}}').hide();
                $('.search__overlay_{{ $table_name}}').removeClass('is-show');
                $('.search__overlay').removeClass('is-show');
                $('.search_{{ $table_name}}').removeClass('is-active');
                $('.search__result_{{ $table_name}}').removeClass('is-show');
    }
</script>
</div>
<div class="search__overlay search__overlay_{{ $table_name}} @if($search != '')is-show @endif" ></div>

    @if(isset($action_product) AND count($action_product)>0)
    <div class="table-before-btn --catalog-table">
            <div>
              <div class="action-group" style="margin-right: 25px; margin-top: -22%">
                <div class="button-group flex-row">
                    @if(isset($selectedData) AND count($selectedData)>0)
                    <button class="button button-small button-icon ico_trash" type="button" onclick="@this.dellAllData();"></button>

                    @endif
                </div>
              </div>
            </div>
          </div>
              <table class="js-table js-table_new footable footable-1" >
                <thead>
                  <tr class="footable-header">
                    <th style="display: table-cell;" class="footable-first-visible">
                        <div class="d-flex align-items-center">
                        <label class="check js-select-all">
                            <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataItem('all',true)" /><span class="check__box"></span>
                            </label>
                            <span>@lang('custom::admin.products.Articul')</span>
                        </div>
                    </th>
                    <th style="display: table-cell;">@lang('custom::admin.products.Name')</th>
                    <th style="display: table-cell;" class="text-center">@lang('custom::admin.products.Code')</th>
                    <th style="display: table-cell;" class="text-center">@lang('custom::admin.products.Addet')</th>
                    <th style="display: table-cell;" class="text-center ">@lang('custom::admin.products.Addet user')</th>
                    <th class="text-end w-1" style="display: table-cell;" data-breakpoints="xs"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($action_product as $key=>$item)

                    <tr>
                    <td style="display: table-cell;" class="footable-first-visible">
                        <div class="d-flex align-items-center">
                      <label class="check">
                          <input class="check__input" type="checkbox" @if(isset($selectedData[$item['id']])) checked @endif onclick="@this.selectDataItem({{$item['id']}})" />
                          <span class="check__box"></span>
                        </label>
                        <span class="ms-2"><a class="accent" href="{{ route('admin.product.edit',$item['id']) }}">№ {{ isset($item['articul']) ? $item['articul']: '' }}</a></span>
                    </div>
                    </td>

                    <td style="display: table-cell;"><a  target="_blank" href="{{ route('admin.product.edit',$item['id']) }}">{{ (!is_array($item) AND $item->translate(session('lang'))) ? $item->translate(session('lang'))->name : (is_array($item) ? $item['name'] : config('app.fallback_locale')) }}</a></td>
                    <td style="display: table-cell;" class="text-center"><span>{{ isset($item['code_1c']) ? $item['code_1c']: '' }}</span></td>
                    <td style="display: table-cell;" class="text-center"><span>{{ (isset($item['created_at']) AND $item['created_at']  !== null) ? \Carbon\Carbon::parse($item['created_at'])->format('d.m.Y') : ''}}</span></td>
                    <td style="display: table-cell;" class="text-center"><span>{{ Auth::guard('admin')->user()->name}}</span></td>
                    <td style="display: table-cell;" class="text-center footable-last-visible">
                      {{--<button class="button button-small button-icon ico_trash" type="button" onclick="@this.removeProductFromActionTmp({{ $item['id'] }})"></button>--}}

                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
    <div>
        @include('livewire.admin.includes.per-page-table')
    </div>
    @endif

    {{--@if(isset($product_tmp) AND count($product_tmp)>0)
    <table class="js-table js-table_new footable footable-1" >
                <thead>
                  <tr class="footable-header">
                    <th style="display: table-cell;" class="footable-first-visible">@lang('custom::admin.products.Articul')</th>
                    <th style="display: table-cell;">@lang('custom::admin.products.Name')</th>
                    <th style="display: table-cell;" class="text-center">@lang('custom::admin.products.Code')</th>
                    <th style="display: table-cell;" class="text-center">@lang('custom::admin.products.Addet')</th>
                    <th style="display: table-cell;" class="text-center ">@lang('custom::admin.products.Addet user')</th>
                    <th style="display: table-cell;" class="footable-last-visible"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($product_tmp as $key=>$item)
                    <tr>
                    <td style="display: table-cell;" class="footable-first-visible"><a class="accent" target="_blank" href="{{ route('admin.product.edit',$item['data']['id']) }}">№ {{ isset($item['data']['id_1c']) ? $item['data']['id_1c']: '' }}</a></td>
                    <td style="display: table-cell;"><a  target="_blank" href="{{ route('admin.product.edit',$item['data']['id']) }}">{{ isset($item['data']['name']) ? $item['data']['name']: '' }}</a></td>
                    <td style="display: table-cell;" class="text-center"><span>{{ (isset($item['data']['code_1c'])) ? $item['data']['code_1c']: '' }}</span></td>
                    <td style="display: table-cell;" class="text-center"><span>{{ (isset($item['data']['created_at']) AND $item['data']['created_at']  !== null) ? \Carbon\Carbon::parse($item['data']['created_at'])->format('d.m.Y') : ''}}</span></td>
                    <td style="display: table-cell;" class="text-center"><span>{{ Auth::guard('admin')->user()->name}}</span></td>
                    <td style="display: table-cell;" class="text-center footable-last-visible">
                      <button class="button button-small button-icon ico_trash" type="button" onclick="@this.removeProductFromActionTmp({{ $item['data']['id'] }})"></button>

                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
    @endif--}}
</div>
