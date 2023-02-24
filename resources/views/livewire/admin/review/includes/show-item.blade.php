

<div class="table-before-btn --small">

    <div class="action-group @if(!$selectedData OR count($selectedData)==0) invisible @endif" style="margin-right: 10px;">
        <div class="action-group-btn"><span class="ico_submenu"></span></div>
            <div class="action-group-drop">
                <ul class="action-group-list">
                    <li>
                    <button class="ico_checkmark" type="button" onclick="@this.activateAllData()" ></button>
                    </li>
                    <li>
                        <button class="ico_trash" type="button" data-bs-target="#dellModeall" data-bs-toggle="modal" ></button>
                    </li>
                    <li>
                        <button class="js-hide-drop ico_close" type="button"></button>
                    </li>

                </ul>
            </div>
        </div>
</div>

<table class="js-table js-table_new footable" >
            <thead>
              <tr class="footable-header">
                <th style="display: table-cell;" class="footable-first-visible">
                    <div class="d-flex align-items-center">
                        <label class="check js-select-all">
                            @if($data_paginate AND count($data_paginate)>0)
                            <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataItem('all',true)"/>
                            <span class="check__box"></span>
                            @endif
                        </label>
                        <span>ID</span>
                    </div>
                </th>
                <th class="text-center" style="display: table-cell;">@lang('custom::admin.By whom')</th>
                <th class="w-100" style="display: table-cell;">@lang('custom::admin.Rating / Review')</th>
                <th style="display: table-cell;">@lang('custom::admin.SKU / Item')</th>
                <th data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Status')</th>
                <th class="w-1 text-end text-md-center footable-last-visible" style="display: table-cell;" data-breakpoints="xs">
                  </th>
              </tr>
            </thead>
            <tbody  >
@if($data_paginate AND count($data_paginate)>0)
            @foreach ($data_paginate as $key=>$item)
              <tr>
                <td style="display: table-cell;" class="footable-first-visible">
                  <div class="box-services"><label class="check">
                      <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')"  />
                      <span class="check__box"></span></label><span class="accent">{{ $item->id }}</span></div>
                </td>
                <td class="text-center" style="display: table-cell;">
                    <span class="nowrap"><a class="nowrap" href="{{ route('admin.users.edit', [$item->user_id]) }}" target="_blank"> {{ isset($item->name) ? $item->name: '' }}</a></span>
                </td>
                <td style="display: table-cell;">
                  <fieldset class="rating" >
                    <div class="rating__group" style="pointer-events: none;">
                        @for ($i = 1; $i <= 5; $i++)
                        <input class="rating__input"  id="star_{{$i}}" type="radio" value="{{$i}}"  @if($item->rating >= $i) checked @endif />
                        <label  class="rating__star"  aria-label="@lang('custom::admin.rating.'.$i)"></label>
                        @endfor
                    </div>
                  </fieldset>
                  <div class="more-content js-more">

                      {{ $item->text }}

                  </div>

                  @if(strlen($item->text)>200)
                  <span class="more-show">@lang('custom::admin.All show')</span>
                  <span class="more-hide">@lang('custom::admin.All hide')</span>
                  @endif
                </td>
                <td style="display: table-cell;">
                    @if(isset($item->getProduct))
                    <a class="short-link accent" target="_blank" href="{{ route('products.show',$item->getProduct->id)}}">{{ $item->getProduct->articul }}</a>

                @endif
                </td>
                <td class="text-md-center" style="display: table-cell;">
                    <span class="icon-status ico_checkmark mx-1 @if($item->status == 1)is-active @endif"
                          onclick="@this.toggleStatus({{$item->id}})"
                        ></span>
                </td>
                <td class="w-1 text-end text-md-center footable-last-visible" style="display: table-cell;">
                    <button class="button button-small button-icon ico_edit" type="button" data-bs-toggle="modal" data-bs-target="#m-edit-review" onclick="@this.emit('showDataReview','{{ $item->id }}')"></button>
                </td>
              </tr>
            @endforeach
            @else
                <tr>
                    <td class="text-center" style="display: table-cell;" colspan="6">
                @lang('custom::admin.No data available')

                    </td>

                </tr>

    @endif
            </tbody>
          </table>


            @include('livewire.admin.includes.scripts_data',['on_click'=>'destroyAllData()','key'=>'all', 'title'=>''])

@if(!is_array($data_paginate))
          @include('livewire.admin.includes.per-page-table')
@endif
