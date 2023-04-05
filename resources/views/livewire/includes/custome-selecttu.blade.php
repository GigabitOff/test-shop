
{{--    Props:                      --}}
{{--        (string) value,         --}}
{{--        (array) items,          --}}
{{--        (int) model,            --}}
{{--        (string) placeholder    --}}
{{--        (string) class          --}}
<div>
    <div class="order-select js-select-{{$class ?? ''}}">
        <div class="order-select-current"><span>{{$value ?: $placeholder}}</span></div>
        <div class="order-select-box">
            <ul>
                @foreach($items as $key => $name)
                        <li onclick="@this.set('{{$model}}', '{{$key}}')" value="{{$key}}">{{$name}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="order-block --{{$class ?? ''}}" style="display: none;">
        <div class="order-block-value"></div>
    </div>
    @error($model)
    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
    @enderror
</div>














