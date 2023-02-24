<div>

<div class="search {{-- --old-search--}} @if($search)is-active @endif" >
<div class="search__body">
<div class="search__controls w-100 ">
            <input type="text" id="id_search_action" placeholder="@lang('custom::admin.Enter the name or phone number of the user')" wire:model.debounce.700ms="search">

    </div>
    <div class="search__drop uk-drop search__drop_1 @if($search AND $search != '')is-show @endif" @if($search == '') @if(!$search__drop_show  AND isset($action_product) AND count($action_product)<5) style="display: none;"  @endif  @endif >
        <div class="search__result">
            <div class="search__result-box">
            <div class="tagger"  @if($search == '') style="display: none;" @endif>
                <input class="js-tags" type="hidden" placeholder="@lang('custom::admin.Phone')" hidden="hidden" value="sfdsf">
                <ul>

            @if($products_entered AND count($products_entered)>0 )
                @foreach ($products_entered as $key_pr=>$item_pr)
                    <li><a href="javascript:void(0);"  class="--yellow" >
                        <span class="label">{{ $item_pr['phone'] ? $item_pr['phone'] : 'no phone' }}</span>
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
                        <input class="js-tags-next" onkeypress="return addNewProducts(event,this.value)" placeholder="@lang('custom::admin.Phone')" list="tagger-completion-1">
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
                    <th class="text-xl-center w-1" style="display: table-cell;">
                  <div class="d-flex align-items-center">
                      {{--<label class="check js-select-all">
                          <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataItem('all',true)" />
                          <span class="check__box"></span></label>--}}
                          <span>ID</span>
                    </div>
                </th>
                <th style="display: table-cell;">
                    @lang('custom::admin.clients.FIO')<br>@lang('custom::admin.clients.Registration')
                </th>
                <th data-breakpoints="xs" style="display: table-cell;">
                    @lang('custom::admin.clients.Phone')<br>@lang('custom::admin.clients.E-mail')
                </th>
                <th data-breakpoints="xs" style="display: table-cell;">
                    @lang('custom::admin.clients.Counterparty')<br>@lang('custom::admin.clients.EDRPOU')
                </th>
                <th data-breakpoints="xs" style="display: table-cell;">
                    @lang('custom::admin.clients.Manager')
                </th>
                <th data-breakpoints="xs sm md">
                    @lang('custom::admin.clients.Role')
                </th>
                <th class="text-xl-center" data-breakpoints="xs sm md">
                    @lang('custom::admin.clients.Date of last entry')
                </th>
                <th class="text-xl-center" data-breakpoints="xs sm md">
                    @lang('custom::admin.Status')
                </th>
                            <td data-breakpoints="xs" class="footable-last-visible" style="display: table-cell;"></td>
                        </tr>
                        </thead>
                <tbody>
                @foreach ($result_search as $key=>$item)
                <tr>
                    <td class="text-xl-center w-1 " style="display: table-cell;">
                    <div class="d-flex align-items-center" >
                        {{--<label class="check">
                        <input class="check__input"  type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')" ><span class="check__box"></span>
                    </label>--}}
                        <a class="accent nowrap" href="{{ $link = route('admin.users.edit', [$item->id]) }}">{{ $item->id }}</a></div>
                  </td>
                <td  class="footable-last-visible" style="display: table-cell;" >
                    <span class="d-block" >
                    {{ isset($item->name) ? $item->name: '' }}
                    {{--@if($item->getParent)
                        : {{$item->getParent->title}}
                    @endif--}}
                    </span>
                    <span class="d-block" >{{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y')}}</span>
                </td>
                <td  style="display: table-cell;">
                    <span class="d-block" >{{ $item->phone }}</span>
                    <span class="d-block nowrap" >{{ $item->email }}</span>
                </td>
                <td style="display: table-cell;">
                    <span class="d-block" >
                        {{ ($item->counterparty !== null) ? $item->counterparty->name : ''}}
                    </span>
                    <span class="d-block" >{{ ($item->counterparty !== null) ? $item->counterparty->okpo : ''}}</span>
                </td>
                <td style="display: table-cell;">
                    <span class="nowrap" >{{ ($item->IsHasManager) ? $item->manager->name : ''}}</span>
                </td>
                <td class="text-xl-center" style="display: table-cell;">
                    <span >

                        @if(count($item->getRoleNames())>0)
                        @foreach ($item->getRoleNames() as $key_role => $role)
                        @if($key_role>0),@endif<span>{{ __('custom::admin.role.'. $role) }}</span>

                        @endforeach
                        @endif
                    </span>
                </td>
                <td class="text-xl-center" style="display: table-cell;">
                    <span  >
                        @if($item->entrances !== null AND count($item->entrances)>0)
                    {{ \Carbon\Carbon::parse($item->entrances[0]->login_at)->format('d.m.Y') }}</span>
                        @endif
                </td>
                <td class="text-xl-center" style="display: table-cell;">
                    <span  class="icon-status ico_checkmark mt-1 @if($item->is_active == 1 AND !$item->deleted_at) is-active @endif" onclick="@this.removeUser({{$item->id}})"></span>
                </td>
                    <td style="display: table-cell;">
                        @if(isset($action_product[$item->id]) OR isset($products_entered[$item->id]))
                        <button class="button button-accent button-small button-icon ico_plus is-active" onclick="@this.removeProductFromActionSearchTmp({{$item->id}})"></button>
                        @else
                        <button class="button button-accent button-small button-icon ico_plus"
                            @if(isset($action_product[$item->id]) OR isset($products_entered[$item->id])) onclick="@this.removeProductFromActionSearchTmp({{$item->id}})" @else wire:click="addProductToActionTmp({{$item->id}})" @endif></button>
                            @endif
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

    window.addEventListener('showSearchResultsUser', () => {
            var height =0;

         });

    function setBlockUp(params) {
        setTimeout(() => {
            name
        }, 700);

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
<div class="search__overlay search__overlay_{{ $table_name}} @if($search != '')is-show @endif" >
</div>

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
                  <th class="text-xl-center w-1" style="display: table-cell;">
                  <div class="d-flex align-items-center">
                      <label class="check js-select-all">
                          <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataItem('all',true)" />
                          <span class="check__box"></span></label>
                          <span>ID</span>
                    </div>
                </th>
                <th style="display: table-cell;">
                    @lang('custom::admin.clients.FIO')<br>@lang('custom::admin.clients.Registration')
                </th>
                <th data-breakpoints="xs" style="display: table-cell;">
                    @lang('custom::admin.clients.Phone')<br>@lang('custom::admin.clients.E-mail')
                </th>
                <th data-breakpoints="xs" style="display: table-cell;">
                    @lang('custom::admin.clients.Counterparty')<br>@lang('custom::admin.clients.EDRPOU')
                </th>
                <th data-breakpoints="xs" style="display: table-cell;">
                    @lang('custom::admin.clients.Manager')
                </th>
                <th data-breakpoints="xs sm md">
                    @lang('custom::admin.clients.Role')
                </th>
                <th class="text-xl-center" data-breakpoints="xs sm md">
                    @lang('custom::admin.clients.Date of last entry')
                </th>
                <th class="text-xl-center" data-breakpoints="xs sm md">
                    @lang('custom::admin.Status')
                </th>
                    <th class="text-end w-1" style="display: table-cell;" data-breakpoints="xs"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($action_product as $key=>$item)

                    <tr>
                    <td class="text-xl-center w-1 " style="display: table-cell;">
                    <div class="d-flex align-items-center" >
                        <label class="check">
                        <input class="check__input"  type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')" ><span class="check__box"></span>
                    </label>
                        <a class="accent nowrap" href="{{ $link = route('admin.users.edit', [$item->id]) }}">{{ $item->id }}</a></div>
                  </td>
                <td  class="footable-last-visible" style="display: table-cell;" >
                    <span class="d-block" >
                    {{ isset($item->name) ? $item->name: '' }}
                    {{--@if($item->getParent)
                        : {{$item->getParent->title}}
                    @endif--}}
                    </span>
                    <span class="d-block" >{{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y')}}</span>
                </td>
                <td  style="display: table-cell;">
                    <span class="d-block" >{{ $item->phone }}</span>
                    <span class="d-block nowrap" >{{ $item->email }}</span>
                </td>
                <td style="display: table-cell;">
                    <span class="d-block" >
                        {{ ($item->counterparty !== null) ? $item->counterparty->name : ''}}
                    </span>
                    <span class="d-block" >{{ ($item->counterparty !== null) ? $item->counterparty->okpo : ''}}</span>
                </td>
                <td style="display: table-cell;">
                    <span class="nowrap" >{{ ($item->IsHasManager) ? $item->manager->name : ''}}</span>
                </td>
                <td class="text-xl-center" style="display: table-cell;">
                    <span >

                        @if(count($item->getRoleNames())>0)
                        @foreach ($item->getRoleNames() as $key_role => $role)
                        @if($key_role>0),@endif<span>{{ __('custom::admin.role.'. $role) }}</span>

                        @endforeach
                        @endif
                    </span>
                </td>
                <td class="text-xl-center" style="display: table-cell;">
                    <span  >
                        @if($item->entrances !== null AND count($item->entrances)>0)
                    {{ \Carbon\Carbon::parse($item->entrances[0]->login_at)->format('d.m.Y') }}</span>
                        @endif
                </td>
                <td class="text-xl-center" style="display: table-cell;">
                    <span  class="icon-status ico_checkmark mt-1 @if($item->is_active == 1 AND !$item->deleted_at) is-active @endif" onclick="@this.removeUser({{$item->id}})"></span>
                </td>
                    <td style="display: table-cell;">
                        @if(isset($action_product[$item->id]) OR isset($products_entered[$item->id]))
                        @else
                        <button class="button button-small button-icon ico_trash"
                            @if(isset($action_product[$item->id]) OR isset($products_entered[$item->id])) onclick="@this.removeProductFromActionSearchTmp({{$item->id}})" @else wire:click="addProductToActionTmp({{$item->id}})" @endif></button>
                            @endif
                    </td>

                  </tr>
                  @endforeach
                </tbody>
              </table>
    <div>
        @include('livewire.admin.includes.per-page-table')
    </div>
    @endif

</div>
