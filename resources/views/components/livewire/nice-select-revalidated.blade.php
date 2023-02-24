
{{--    Props: (string) model, (mixed) value, (array) list, (string) placeholder    --}}

<div>
    <div style="display: none">
        <select class="no-nice" name="{{$model}}-hidden">
            <option value="0" @if(!$model) selected @endif>{{$placeholder}}</option>
            @foreach($list as $key => $label)
                <option value="{{$key}}" @if($value === $key) selected @endif>{{$label}}</option>
            <!-- {{$value}} {{$key}} -->
            @endforeach
        </select>
    </div>
    <div wire:ignore>
        @php($selfKey = time())
        <select class="nice"
                id="nice-{{$model}}-{{$selfKey}}"
                name="{{$model}}">
            <option value="0" @if(!$model) selected @endif>{{$placeholder}}</option>
            @foreach($list as $key => $label)
                <option value="{{$key}}" @if($value === $key) selected @endif>{{$label}}</option>
            @endforeach
        </select>
    </div>
    <script>
        $('select#nice-{{$model}}-{{$selfKey}}')
            .niceSelect()
            .on('change', function (e) {
            @this.set('{{$model}}', e.target.value)
            });
    </script>

</div>
