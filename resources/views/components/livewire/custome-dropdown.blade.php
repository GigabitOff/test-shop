
{{--    Props: (string) value, (array) items, (int) modalKey, (string) placeholder    --}}

<div class="custome-dropdown custome-dropdown--arrow">
    <span class="custome-dropdown-clear icon-close @if($value) is-active @endif"
          onclick="$(this).parent().find('input').focus();@this.set('{{$modelKey}}', 0)"></span>
    <input
        class="form-control js-filterable" type="text"
        value="{{$value}}"
        placeholder="{{$placeholder}}"/>
    <div class="custome-dropdown-box">
        <div class="custome-dropdown-overflow">
            <ul>
                @foreach($items as $key => $name)
                    <li onclick="@this.set('{{$modelKey}}', {{$key}})">{{$name}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
