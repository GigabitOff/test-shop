<div class="drop @if(isset($drop_class)) {{ $drop_class }} @else--arrow @endif"  wire:ignore.self>
    @php
        if(!isset($key_for_select_array))
        $key_for_select_array = $index;

        if(!isset($index_leng_admin_key))
        $index_leng_admin_key = 'admin.settings';
    @endphp

    @if(!isset($hide_clear))
    @if(isset($select_data[$index]['id']) OR isset($select_data[$index]['input']) AND $select_data[$index]['input'] !='' OR isset($title_select) AND $title_select !==false  )

    <span class="drop-clear  _active " onclick="@if(isset($for_clear_index)) @this.deleteDataList(null,'{{$for_clear_index['key']}}','{{ $for_clear_index['index']}}');  @else @this.deleteDataList(null,'','{{ isset($key_ch_tmp) ? $key_ch_tmp : $index}}'); @endif"></span>

    @endif
    @endif
    <input @if(isset($select_data[$index]['id'])) disabled @endif id="select_data-{{$index}} @error('data.{{$index}}') is-invalid @enderror" class="form-control drop-input @error('select_data.'.$index.'.value') is-invalid @enderror" type="text" autocomplete="off" placeholder="{{ ($placeholder AND !isset($title_select) OR $title_select === false) ? $placeholder : $title_select }}"
    @if(isset($title_select)) value="{{$title_select}}" @else @if(isset($locale)) wire:model.debounce.60ms="data.{{session('lang')}}.{{$index}}" @else wire:model.debounce.60ms="select_data.{{$index}}.input" @endif @endif
    @if(isset($searchSelectDataArrow) AND $searchSelectDataArrow !== null AND !isset($title_select) OR isset($on_input) OR isset($title_select) AND $title_select === false ) oninput="@this.searchSelectDataArrow('{{$index}}', this.value,'{{(isset($searchSelectDataArrow) AND $searchSelectDataArrow != 'name') ? $searchSelectDataArrow : 'name'}}', '{{isset($key_ch_tmp) ? $key_ch_tmp : 'null'}}','{{$key_for_select_array}}','{{isset($classTable) ? $classTable : 'null'}}')" @endif
    @if(isset($searchSelectDataArrow) AND $searchSelectDataArrow !== null AND isset($title_select) AND $title_select !='' OR  isset($disabled_select) AND isset($select_data[$index]['id'])) disabled @endif />
    <div class="drop-box" wire:ignore.self>
        <div class="drop-overflow">
            @if(isset($select_data_array) AND count($select_data_array)>0)
            <ul class="drop-list">
                @foreach ($select_data_array as $k_data=>$item_data)
                @if(!isset($dont_show_id) OR $dont_show_id != $k_data AND $dont_show_id != $item_data['parent_id'])
                @if($index == 'category_phone')
                <li class="drop-list-item" wire:click="sellectDataList('{{ $k_data }}','{{isset($item_data['title']) ? $item_data['title'] : 0}}{{(isset($item_data['shop']) AND $item_data['shop'] AND !is_array($item_data['shop']) AND $item_data['shop']->translate(session('lang'))) ? '/'. $item_data['shop']->translate(session('lang'))->title : '/'.$item_data['title'] }}','{{$index}}')">
                    @if($item_data AND !is_array($item_data) AND $item_data->translate(session('lang')))
                    {{ $item_data->translate(session('lang'))->title }}
                    @else
                    {{ isset($item_data['title']) ? $item_data['title'] : 0 }}
                    @endif
                    @if(isset($item_data['shop']))
                    /
                        @if($item_data['shop'] AND !is_array($item_data['shop']) AND $item_data['shop']->translate(session('lang')))
                        {{ $item_data['shop']->translate(session('lang'))->title }}
                        @else
                        {{ isset($item_data['shop']['title']) ? $item_data['shop']['title'] : '' }}
                        @endif
                    @endif
                </li>
                @elseif(isset($show_name) AND $show_name === true)
                <li class="drop-list-item"
                    @if(isset($onClick))
                    onclick="changeItemDataSelect('select_data-{{$index}}',this.innerHTML); @this.{{$onClick}}('{{ $index }}','{{isset($item_data['id']) ? $item_data['id'] : 0}}','{{isset($item_data['name']) ? $item_data['name'] : 0}}')"
                    @elseif(isset($onclick))
                    onclick="changeItemDataSelect('select_data-{{$index}}',this.innerHTML); @this.{{ $onclick['function'] }}({{$onclick['id']}},'{{$index}}','{{$k_data}}')"
                    @elseif($index == 'city')

                    onclick="changeItemDataSelect('select_data-{{$index}}',this.innerHTML); @this.sellectDataDropdown('{{ $item_data['id'] }}','{{isset($item_data['name_uk']) ? $item_data['name_uk'] : 0}}','{{$index}}')"
                    @else
                    onclick="changeItemDataSelect('select_data-{{$index}}',this.innerHTML); @this.sellectDataDropdown('{{ $k_data }}','{{isset($item_data['name']) ? $item_data['name'] : 0}}','{{$index}}')"
                    @endif>
                    @if($index == 'city')
                        {{ isset($item_data['name_'.session('lang')]) ? $item_data['name_'.session('lang')] : $item_data['name_uk']}}
                        @if(isset($item_data['district_'.session('lang')]))({{$item_data['district_'.session('lang')]}})@endif
                    @else
                        @if($item_data AND !is_array($item_data) AND $item_data->translate(session('lang')))
                        {{ $item_data->translate(session('lang'))->name }}
                        @elseif(isset($item_data[session('lang')]['name']))
                            {{ $item_data[session('lang')]['name'] }}
                        @else
                        {{ isset($item_data['name']) ? $item_data['name'] : '' }}
                        @endif
                       {{-- @if(isset($item_data['description']))({{$item_data['description']}})@endif--}}
                    @endif
                </li>
                @elseif(isset($show_title) AND $show_title === true)
                <li class="drop-list-item"
                wire:click="sellectDataDropdown('{{ $item_data['id'] }}','{{($item_data AND !is_array($item_data) AND $item_data->translate(session('lang'))) ? $item_data->translate(session('lang'))->title : (isset($item_data['title']) ? $item_data['title'] : 0)}}','{{$index}}')">
                    @if($item_data AND !is_array($item_data) AND !empty($item_data->translate(session('lang'))))
                    {{ $item_data->translate(session('lang'))->title }}
                    @elseif(isset($item_data[session('lang')]['title']))
                            {{ $item_data[session('lang')]['title'] }}
                    @else
                    {{ isset($item_data['title']) ? $item_data['title'] : '' }}
                    @endif
                </li>
                @elseif(isset($show_name) AND $show_name === true)
                <li class="drop-list-item" wire:click="sellectDataDropdown('{{ $k_data }}','{{isset($item_data['name']) ? $item_data['name'] : 0}}','{{$index}}')">
                    {{isset($item_data['title']) ? $item_data['title'] : 0}}
                    {{--$item_data->title--}}
                </li>
                @elseif(isset($show_no_index))
                <li class="drop-list-item" wire:click="sellectDataDropdownLocale('{{isset($item_data) ? $item_data : 0}}','{{$index}}')">
                    {{isset($item_data) ? $item_data : 0}}
                    {{--$item_data->title--}}
                </li>
                @else
                <li class="drop-list-item" wire:click="sellectDataList('{{ $k_data }}','@lang('custom::'.$index_leng_admin_key.'.'.$index.'.'.$k_data)','{{$index}}')">
                    @lang('custom::'.$index_leng_admin_key.'.'.$index.'.'.$k_data)
                </li>
                @endif
                @endif
                @endforeach
            </ul>
            @else
            <ul class="drop-list">
                <li class="drop-list-item">@lang('custom::admin.No data available')</li>
            </ul>

            @endif
        </div>
    </div>
</div>
