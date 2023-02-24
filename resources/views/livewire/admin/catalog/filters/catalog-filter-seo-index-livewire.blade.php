<div>
    {{-- The whole world belongs to you. --}}
<h6>@lang('custom::admin.SEO-links')</h6>
<div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
<div class="table-before-btn --small">
              <div>
                <div class="action-group" style="margin-top: -30px; margin-right: 3px">
                  <div class="action-group-btn"><span class="ico_submenu"></span></div>
                  <div class="action-group-drop">
                    <ul class="action-group-list">
                      <li><button class="button button-accent button-small button-icon ico_plus" onclick="@this.resetDataInput()" data-bs-target="#m-add-data-filter-seo" data-bs-toggle="modal"></button></li>
                        @if(isset($selectedData) AND count($selectedData)>0 )
                      <li><button class="ico_trash" type="button"  data-bs-target="#dellModeAll" data-bs-toggle="modal"></button></li>
                      @endif
                      <li><button class="js-hide-drop ico_close" type="button" ></button></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
<table class="js-table js-table_new footable">
    <thead>
        <tr class="footable-header">
            <th style="display: table-cell;" class="footable-first-visible">
                <label class="check js-select-all">
                    @if(isset($data_paginate) AND count($data_paginate)>0)
                    <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataItem('all',true)" />
                    <span class="check__box"></span></label>
                    @endif
                @lang('custom::admin.URL from site')
            </th>
            <th class="text-md-center" style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.Meta title seo')</th>
            <th data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.SEO Url')</th>
            <th class="text-end w-1 footable-last-visible" style="display: table-cell;">
            </th>
        </tr>
    </thead>
    <tbody>
    @if(isset($data_paginate) AND count($data_paginate)>0)
        @foreach ($data_paginate as $key=>$item)
        <tr>
            <td style="display: table-cell;" class="footable-first-visible">
                <div class="d-flex align-items-center">
                    <label class="check">
                        <input class="check__input" target="_blank" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.selectDataItem('{{ $item->id }}')" ><span class="check__box"></span>
                    </label>
                    @if(!empty($item->translate(session('lang'))->url))
                <a class="accent" href="{{ $item->translate(session('lang'))->url }}">{{ \Str::limit($item->translate(session('lang'))->url,50,'...') }}</a>
                @endif
                </div>
            </td>
            <td class="text-md-center" style="display: table-cell;">

                <span>{{ !empty($item->translate(session('lang'))->meta_title) ?? $item->translate(session('lang'))->meta_title }}</span>
            </td>
            <td style="display: table-cell;">
                @if(!empty($item->translate(session('lang'))->seo_url))
                <a class="accent" href="{{ $item->translate(session('lang'))->seo_url }}">{{ $item->translate(session('lang'))->seo_url }}</a>
                @endif
            </td>
            <td class="text-end w-1 footable-last-visible" style="display: table-cell;">
                      <a class="button button-small button-icon ico_edit"  data-bs-target="#m-add-data-filter-seo" onclick="@this.getFilterSeoData({{$item->id}})" data-bs-toggle="modal" type="button"></a>


            </td>
              @include('livewire.admin.includes.scripts_data',['wire_click'=>'destroyData('.$item->id.')','key'=>$item->id, 'title'=>'SEO-посилання: '.$item->meta_title])

        </tr>
        @endforeach
        @else
                <tr>
                    <td class="text-center" style="display: table-cell;" colspan="4">
                @lang('custom::admin.No data available')

                    </td>

                </tr>
    @endif
    </tbody>
</table>

@if(isset($data_paginate) AND count($data_paginate)>0)
@foreach ($data_paginate as $key=>$item)
    @include('livewire.admin.includes.scripts_data',['on_click'=>'destroyData('.$item->id.')','key'=>$item->id, 'title'=>'Сторінку: '.$item->title])
    @endforeach

        @include('livewire.admin.includes.per-page-table')

    @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])

@endif

<div>

@include('livewire.admin.catalog.filters.includes.popup-add-data-filter-seo')

</div>
</div>
