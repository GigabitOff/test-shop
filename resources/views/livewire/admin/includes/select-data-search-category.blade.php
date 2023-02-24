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
    @if(isset($title_select)) value="{{$title_select}}" @else wire:model="select_data.{{$index}}.input" @endif
    @if(isset($searchSelectDataArrow) AND $searchSelectDataArrow !== null AND !isset($title_select) OR isset($on_input) OR isset($title_select) AND $title_select === false ) oninput="@this.searchSelectDataArrow('{{$index}}', this.value,'{{(isset($searchSelectDataArrow) AND $searchSelectDataArrow != 'name') ? $searchSelectDataArrow : 'name'}}', '{{isset($key_ch_tmp) ? $key_ch_tmp : 'null'}}','{{$key_for_select_array}}','{{isset($classTable) ? $classTable : 'null'}}')" @endif
    @if(isset($searchSelectDataArrow) AND $searchSelectDataArrow !== null AND isset($title_select) AND $title_select !='' OR  isset($disabled_select) AND isset($select_data[$index]['id'])) disabled @endif />
    <div class="drop-box"  wire:ignore.self>
        <div class="drop-overflow">

            @if(isset($select_data_array) AND count($select_data_array)>0)
            <ul class="drop-list">
                @foreach ($select_data_array as $k_data=>$item_data)
                @if(!isset($dont_show_id) OR $dont_show_id != $k_data AND $dont_show_id != $item_data['parent_id'])
                @if(isset($show_name) AND $show_name === true)
                <li class="drop-list-item"

                    onclick="changeItemDataSelect('select_data-{{$index}}',this.innerHTML); @this.sellectDataDropdown('{{ $item_data['id'] }}','{{isset($item_data['name']) ? $item_data['name'] : 0}}','{{$index}}')"
                    >
                    @if($item_data AND !is_array($item_data) AND $item_data->translate(session('lang')))
                    {{ $item_data->translate(session('lang'))->name }}
                    @else
                    {{ isset($item_data['name']) ? $item_data['name'] : 0 }}
                    @endif

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
