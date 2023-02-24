<div class="custome-table__accordion accordion">
    @foreach ($data_paginate as $key=>$item)

    <div class="custome-table__accordion-item accordion-item">
        <div class="custome-table__accordion-header accordion-header">
            <div class="custome-table__row">
                <div class="custome-table__cell">
                    <label class="check" >
                        <input class="check__input"
                               @if(isset($selectedData[$item->id])) checked="checked" @endif
                               onclick="@this.selectDataItem('{{ $item->id }}')"
                               type="checkbox">
                        <span class="check__box"></span>
                    </label>
                    <span class="number --numb-{{ $cat_level }}"></span>
                    @if($item->parentData->isNotEmpty())
                        <span class="d-flex align-items-center"
                              data-bs-toggle="collapse"
                              data-bs-target="#subcat-{{$item->parent_id}}-{{$item->id}}"
                              aria-expanded="false">
                            <span class="toggle"></span>
                            <span class="value">{{ $item->name ?? '' }}</span>
                        </span>
                    @else
                        <span class="toggle-empty"></span>
                        <span class="value">{{ $item->name ?? '' }}</span>
                    @endif
                </div>
                    <div class="custome-table__cell-group">
                        <div class="custome-table__cell">
                            <span class="mobile-title">@lang('custom::admin.Parent category')</span>
                            <span class="value">{{  $item->selfCategory !== null ? $item->selfCategory->name : 'Немає батьківської категорії' }}</span></div>
                            <div class="custome-table__cell">
                                <span class="mobile-title">@lang('custom::admin.Order')</span>
                                <input class="form-control" type="number" value="{{ $item->sort_order }}"  onchange="changeOrderCustom({{$item->id}},this.value, {{$item->parent_id}}, this)" onclick="this.select();">
                            </div>
                            <div class="custome-table__cell">
                                <a class="button button-small button-icon ico_edit" href="{{ route('admin.'. $nameLive .'.edit', [$item->id]) }}"></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      @if($item->parentData AND count($item->parentData)>0)
                      <div  class="custome-table__accordion-collapse accordion-collapse collapse" id="subcat-{{$item->parent_id}}-{{$item->id}}">
                        <div wire:ignore>

                    @livewire('admin.catalog.category.catalog-category-show-parent-livewire',['category_id'=>$item->id,'cat_level'=>$cat_level+1], key(time().'-parent_1'))
                        </div>

                      </div>
                      @endif
    </div>
    @endforeach
</div>
