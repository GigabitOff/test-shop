<div>

    @if(session('success_add_cat'))
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-lable="close">
                <span aria-hidden="true">x</span>
                </button>
                    {{ session()->get('success_add_cat') }}
                </div>
            </div>
        </div>
    @endif
<table class="js-table js-table_new table-category-list table-td-small footable" >
    <thead>
              <tr class="footable-header">
                <th style="display: table-cell;">@lang('custom::admin.Order')</th>
                <th class="w-100" style="display: table-cell;">{{ $menu_title ? $menu_title : __('custom::admin.Category') }}</th>
                <th class="text-center w-1" style="display: table-cell;">
                    <button class="button button-accent button-small button-icon ico_plus" type="button"
                            onclick="@this.getAllDataForAdd(true)"
                            data-bs-target="#m-add-item-menu-{{ $type }}" data-bs-toggle="modal"></button>
                </th>
              </tr>
            </thead>
            <tbody  wire:sortable="updateOrder">
              @php($L=1)


            @if(isset($orderTmpData) AND count($orderTmpData)>0)
                @foreach ($orderTmpData as $key_ord => $item_ord)
                @if (isset($deleteData[$key_ord]) )

                @else

                @if(!isset($addData[$key_ord]))
                <tr wire:sortable.item="{{ $key_ord }}" wire:key="{{$type}}-menu-{{ $key_ord }}" >
                <td wire:sortable.handle class="text-md-center" style="display: table-cell; cursor: move;"><span>{{$L}}</span></td>
                <td style="display: table-cell;">
                    <a href="javascript:void(0);">
                   {{ $type != 'pages' ? ((isset($item_ord['category']) AND !is_array($item_ord['category']) AND $item_ord['category']->translate(session('lang')) !== null) ? $item_ord['category']->translate(session('lang'))->name : config('app.fallback_locale'))  : ((isset($item_ord['page']) AND !is_array($item_ord['page']) AND $item_ord['page']->translate(session('lang')) !==null )  ? $item_ord['page']->translate(session('lang'))->title : config('app.fallback_locale'))   }}</a></td>
                <td class="text-md-center w-1" style="display: table-cell;">
                    @if(isset($item_ord['id']))
                    <button @click="$wire.deleteMenuCategory('{{$item_ord['id']}}','{{$key_ord}}');"
title="@lang('custom::admin.Delete')" class="button button-small button-icon ico_trash" type="button"></button></td>
                    @endif
                </tr>

              @elseif(isset($addData[$key_ord]))

              <tr wire:sortable.item="{{ $key_ord }}" wire:key="{{$type}}-menu-{{ $key_ord }}">
                <td wire:sortable.handle class="text-md-center"  style="display: table-cell; cursor: move;"><span>{{ $L }}</span></td>
                <td  style="display: table-cell;"><a href="javascript:void(0);">{{ $item_ord[session('lang')]['title'] ?? $item_ord['title'] ?? '' }}</a></td>
                <td  class="text-center w-1" style="display: table-cell;"><button  @click="$wire.deleteMenuCategory('null','{{ $key_ord }}','tmp');" title="@lang('custom::admin.Delete')" class="button button-small button-icon ico_trash" type="button"></button></td>
              </tr>
              @endif

              @php($L++)

            @endif

                @endforeach
            @endif

            @if($L == 1)
            <tr>
                    <td class="text-md-center" style="display: table-cell;" colspan="3">
                @lang('custom::admin.No data available')

                    </td>

                </tr>
            @endif
        </tbody>
    </table>
    <div class="modal fade" id="m-add-item-menu-{{ $type }}" tabindex="-1" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">@lang('custom::admin.Add to menu')</h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @if($category )
            @php($L=0)
            <div class="form-group">
                <span class="drop-clear  @if(isset($search_category) AND $search_category != '') _active @endif " onclick="@this.set('search_category','')"></span>
                <input class="form-control " type="text" placeholder="@if($type == 'pages') @lang('custom::admin.Search pages') @else @lang('custom::admin.Search categories')@endif" wire:model="search_category"></div>
            <div class="modal-overflow">

                @foreach ($category as $k_menu=>$item_k)
                @if($item_k->slug !== 'brands' AND $item_k->slug !== 'reviews')
                <div class="form-group">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($category_name[$item_k->id])) checked = 'checked' @endif wire:click="sellectData({{ $item_k->id }})">
                        <span class="check__box"></span>
                        <span class="check__txt">{{ $type != 'pages' ? ($item_k->translate(session('lang'))  !== null  ? $item_k->translate(session('lang'))->name : $item_k->name) : ($item_k->translate(session('lang')) !== null ? $item_k->translate(session('lang'))->title : $item_k->title) }}</span>
                    </label>

                </div>
                @php($L++)
                @endif

                @endforeach
            </div>
            @if($category_index != -1)

              <div class="mt-4"><button class="button w-100" type="button" onclick="@this.dataAddCategory();"  data-bs-dismiss="modal" aria-label="Close">@lang('custom::admin.Add')</button></div>
              @endif

            @if($L==0)
            <div class="modal-title">
                <small style="font-weight: 400;">@lang('custom::admin.No data available')</small>
            </div>
            @endif
            @endif

          </div>
        </div>
      </div>
    </div>

</div>
