<div class="form-group">
    <div class="row g-3">
        <div class="col-md col-12">
            <div class="input-group --small" wire:ignore.self>
                <span class="input-group-text">@lang('custom::admin.The name of the characteristic')</span>
                @if(isset($name_characteristic_select) AND $name_characteristic_select !== null)
                    @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>$name_characteristic_select['select_data_input'],
                        'select_data_array'=>$name_characteristic_select['select_data_array'],
                        'placeholder'=>$name_characteristic_select['placeholder'],
                        'index'=>$name_characteristic_select['index'],
                        'show_title'=>$name_characteristic_select['show_title'],
                        'show_name'=>$name_characteristic_select['show_name']])
                @else
                    <input class="form-control" type="text" autocomplete="off" placeholder="Text" @if(isset($name_characteristic_value)) value="{{ $name_characteristic_value }}" @endif
                    {{ $name_disabled === true ? 'disabled' : ''}} />
                @endif
            </div>
        </div>
        <div class="col-md col-12">
            <div class="input-group --small">
                <span class="input-group-text">@lang('custom::admin.Values')</span>
                @if(isset($value_characteristic_select) AND $value_characteristic_select !== null)
                @php($this->select_data[$value_characteristic_select['index']]['input']=$value_characteristic_select['select_data_input'])
                @php($this->select_data[$value_characteristic_select['index']]['id']=$value_characteristic_select['select_data_id'])
                    @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_array'=>$value_characteristic_select['select_data_array'],
                        'placeholder'=>$value_characteristic_select['placeholder'],
                        'index'=>$value_characteristic_select['index'],
                        'show_title'=>$value_characteristic_select['show_title']])
                @else
                {{-- value_characteristic value="{{ $value_characteristic }}" --}}
                {{-- value_characteristic_wire {{ isset($value_characteristic_wire) ? 'wire:model.lazy='.$value_characteristic_wire : ''}} --}}
                <input class="form-control" type="text" autocomplete="off" placeholder="Text" @if(isset($onchange))onchange="{{$onchange}}" @endif @if(isset($value_characteristic_wire)) wire:model.debounce.750ms="{{$value_characteristic_wire}}" @endif/>
                @endif
            </div>
        </div>
        <div class="col-1 text-end"><button class="button button-icon ico_trash" @if(isset($item_delete_wire)){{ $item_delete_wire }}  @endif></button></div>
    </div>
</div>
