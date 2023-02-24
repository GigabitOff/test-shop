<div class="js-dropdown dropdown">
    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">
        <span>{{ isset($title_select) AND $title_select != '0' ? $title_select : __('custom::admin.Parent category')}}</span>
    </button>


    <div class="dropdown-menu dropdown-menu-lg-end">
        <div class="drop-overflow">
            <ul class="list-clear">
                @if(isset($select_data_array))
                @foreach ($select_data_array as $k_data=>$item_data)

                @if(isset($data_type) AND $data_type=='single')
                <li class="drop-list-item" wire:click="sellectDataDropdown('{{ $k_data }}','{{isset($item_data['name']) ? $item_data['name'] : 0}}','{{$index}}')">
                    <label class="radio" @if(isset($onclick))onclick="@this.{{ $onclick['function'] }}({{$onclick['id']}},'{{$index}}','{{$k_data}}')"@endif><input class="radio__input" type="radio" name="{{$index}}_name" @if(isset($item_data['id']) AND $item_data['id'] == $select_data_input) checked="checked" @endif /><span class="radio__box">{{ isset($item_data['name']) ? $item_data['name'] : 0 }}</span></label>
                </li>
                @else
                @php
                    if(!isset($item_data['title']) AND isset($item_data['name']))
                    $item_data['title'] = $item_data['name'];
                @endphp
                <li class="drop-list-item" wire:click="sellectDataDropdown('{{ $item_data['id'] }}','{{$index}}')">
                    <label class="radio"><input class="radio__input" type="radio" name="category_name" @if($item_data['id'] == $select_data_input) checked="checked" @endif /><span class="radio__box">{{ isset($item_data['title']) ? $item_data['title'] : 0 }}</span></label>
                </li>
                @endif
                @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
