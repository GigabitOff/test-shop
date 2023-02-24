<div class="drop --arrow " >
    <span class="drop-clear @if(isset($city) AND !empty($city)) _active @endif" onclick="@this.set('data.city_id', null); @this.set('city', null);"></span>
    <input id="select_data_city" class="form-control drop-input" type="text" autocomplete="off" placeholder="{{__('custom::admin.choice_city')}}"
    wire:model.debounce.500ms="city" {{$city}} />
    <div class="drop-box" >
    @if(isset($select_cities) AND count($select_cities)>0)
        <div class="drop-overflow">
            <ul class="drop-list">
                @foreach ($select_cities as $k_data=>$city)
                <li class="drop-list-item" onclick="@this.set('data.city_id', '{{$city['id']}}'); @this.set('city', '{{$city['title']}}');">
                    {{$city['title']}}
                </li>

                @endforeach
            </ul>
        </div>
    @endif
    </div>


</div>

