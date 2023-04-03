<div class="table-before-btn --small --category">
            <div class="action-group">
              <div class="action-group-btn"><span class="ico_submenu"></span></div>
              <div class="action-group-drop">
                <ul class="action-group-list">
                  <li><a class="ico_plus" href="{{ route('admin.'. $nameLive .'.create') }}"></a></li>
                  @if(isset($selectedData) AND count($selectedData)>0)
                            <li><button class="ico_trash" type="button"  data-bs-target="#dellModeall" data-bs-toggle="modal"></button></li>
                        @endif


                  <li><button class="js-hide-drop ico_close" type="button"></button></li>
                </ul>
              </div>
            </div>
          </div>

<div class="custome-table">
    <div class="custome-table__head">
              <div class="custome-table__row">
                <div class="custome-table__cell">
                    <label class="check">
                        <input class="check__input" type="checkbox"  @if(isset($selectedData['all'])) checked @endif  onclick="@this.selectDataItem('all',true); ">
                        <span class="check__box"></span></label>
                        <span class="title">@lang('custom::admin.catalog.Category name')</span>
                    </div>
                <div class="custome-table__cell-group">
                  <div class="custome-table__cell">
                    <span class="title ms-0">@lang('custom::admin.Parent category')</span>
                </div>
                  <div class="custome-table__cell">
                    <span class="title">@lang('custom::admin.Order')</span>
                </div>
                  <div class="custome-table__cell"></div>
                </div>
              </div>
            </div>

            <div class="custome-table__body">
            @if(isset($data_paginate) AND count($data_paginate)>0)
            @foreach ($data_paginate as $key=>$item)
              <div class="custome-table__dropdown @if(isset($show_cat[$item->id])) is-show @endif">
                <div class="custome-table__dropdown-title custome-table__row" >
                  <div class="custome-table__cell">
                    <label class="check" >
                        <input class="check__input" @if(isset($selectedData[$item->id])) checked="checked" @endif  onclick="@this.selectDataItem('{{ $item->id }}')" type="checkbox"><span class="check__box"></span>
                    </label>
                    <div class="js-toggle-dropdown2 toggle-dropdown" @if($item->parentData AND count($item->parentData)>0) onclick="@this.setShowCat({{$item->id}});" @endif>
                        <span class="flag"></span>
                        <span class="value">{{ isset($item->name) ? $item->name : '' }}</span>
                        <button class="toggle-dropdown-btn" type="button"></button>
                    </div>
                  </div>
                  <div class="custome-table__cell-group">
                    <div class="custome-table__cell"><span class="mobile-title">@lang('custom::admin.Parent category')</span>
                        <span class="value">{{  $item->selfCategory !== null ? $item->selfCategory->name : '-' }}</span></div>
                    <div class="custome-table__cell"><span class="mobile-title">@lang('custom::admin.Order')</span>
                        <input class="form-control" type="number" value="{{ $item->sort_order }}" onchange="changeOrderCustom({{$item->id}},this.value, {{$item->parent_id}}, this)" onclick="this.select();">
                    </div>
                    <div class="custome-table__cell">
                        <a class="button button-small button-icon ico_edit" href="{{ route('admin.'. $nameLive .'.edit', [$item->id]) }}""></a></div>
                  </div>
                </div>
                @if($item->parentData AND count($item->parentData)>0)
                <div  class="custome-table__dropdown-content" @if(isset($show_cat[$item->id])) style="display: block" @endif>
                        <div wire:ignore>

                    @livewire('admin.catalog.category.catalog-category-show-parent-livewire',['category_id'=>$item->id], key(time().'-parent_'.$item->id))
                </div>
                </div>
                @endif
              </div>
            @endforeach
            @endif


            </div>
          </div>
        <script>
    function changeOrderCustom(id_s, values, parent_id, input){


        if(values == 0)
            {
                values = 1;
                input.value = values;
            }

            if(values>{{count($data_paginate)}})
            {
                values = {{count($data_paginate)}};
                input.value = values;
              //  alert(input.value);
            }


       @this.changeOrderCustom(id_s, values, parent_id);

    }
</script>
    @include('livewire.admin.includes.scripts_data',['on_click'=>'destroyAllData()','key'=>'all', 'title'=>''])

    @include('livewire.admin.includes.per-page-table')



