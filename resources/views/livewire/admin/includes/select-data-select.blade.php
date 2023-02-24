<div style=" @error('select_data.'.$index.'.value') border: 1px solid red; @endif">
<div class="drop --select @if(isset($title_select))_selected @endif  " wire:ignore.self>
    @if(isset($showKey))

     @php
        if(!isset($key_for_select_array))
        $key_for_select_array = $index;

    @endphp
    <span class="drop-clear @if(isset($select_data[$index]['id'])) _active @endif" onclick="@this.deleteDataList(null,'','{{$index}}')"></span>
    <input id="select_data-{{$index}}" class="form-control drop-input  @error('select_data.'.$index)is-invalid @endif drop-input-hide " type="text" autocomplete="off" placeholder="{{ $placeholder ? $placeholder : '' }}"
    @if(isset($title_select)) value="{{$title_select}}" @else wire:model.debounce.500ms="select_data.{{$index}}.input" @endif
    @if(isset($searchSelectDataArrow) AND $searchSelectDataArrow !== null) oninput="@this.searchSelectDataArrow('{{$index}}', this.value,'name', '{{$key_for_select_array}}','{{$key_for_select_array}}','{{isset($classTable) ? $classTable : 'null'}}')" @endif />


    <button class="form-control drop-button " type="button">@if(isset($select_data[$index]['input'])){{$select_data[$index]['input']}}@else{{$placeholder}}@endif</button>


    @else
    <span class="drop-clear"></span>

    <input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="{{ $placeholder ? $placeholder : '' }}"
    @if(isset($title_select)) value="{{$title_select}}"  @else wire:model.debounce.500ms="select_data.{{$index}}.input" @endif/>

    <button class="form-control drop-button" type="button">@if(isset($title_select)){{$title_select}}@else{{$placeholder}}@endif</button>
    @endif
    <div class="drop-box"> {{-- (isset($select_data[$index]['input'])){{$select_data[$index]['input']}}@else --}}
        <div class="drop-overflow">
            <ul class="drop-list">
                @if(isset($select_data_array) AND count($select_data_array)>0)
                @foreach ($select_data_array as $k_data=>$item_data)

                @if(isset($with_translation))

                @else
                    @if(isset($show_title) AND $show_title === true)
                    <li class="drop-list-item"
                    wire:click="sellectDataDropdown('{{ $item_data['id'] }}','{{($item_data AND !is_array($item_data) AND $item_data->translate(session('lang'))) ? $item_data->translate(session('lang'))->title : (isset($item_data['title']) ? $item_data['title'] : 0)}}','{{$index}}')">
                        {{($item_data AND !is_array($item_data) AND $item_data->translate(session('lang'))) ? $item_data->translate(session('lang'))->title : (isset($item_data['title']) ? $item_data['title'] : 0)}}
                    </li>
                    @elseif(isset($showKey))
                    <li class="drop-list-item" wire:click="sellectDataList('{{ $k_data }}','@lang('custom::admin.settings.'.$index.'.'.$k_data)','{{$index}}')">
                    @lang('custom::admin.settings.'.$index.'.'.$k_data)
                    </li>
                    @else
                    <li class="drop-list-item"
                    wire:click="sellectDataDropdown('{{ $item_data['id'] }}','{{isset($item_data['title']) ? $item_data['title'] : isset($item_data['name']) ? $item_data['name'] : 0}}','{{$index}}')">
                        {{$item_data['title'] ? $item_data['title'].'-' : isset($item_data['name']) ? $item_data['name'] : '000'}}
                    </li>
                    @endif
                @endif

                    @endforeach
                    @endif
            </ul>
        </div>
</div>
</div>
</div>
