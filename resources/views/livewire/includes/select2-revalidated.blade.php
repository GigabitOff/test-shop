{{--    Props:                                 --}}
{{--        (string) model,         required   --}}
{{--        (string) list,          required   --}}
{{--        (string) placeholder,   required   --}}
{{--        (string) value,                    --}}
{{--        (string) disabled,                 --}}

<div>
    @php($value = ${$model})
    <div style="display: none">
        <select name="{{$model}}-hidden"
                @if($disabled) disabled @endif
                multiple="multiple">
            @foreach($list as $id => $name)
                <option value="{{$id}}"
                        @if(in_array($id, $value)) selected @endif>{{$name}}</option>
            @endforeach
        </select>
    </div>
    <div wire:ignore>
        @php($selfKey = time())
        <select name="{{$model}}" id="select2-{{$model}}-{{$selfKey}}"
                multiple="multiple"
                data-params="{{ json_encode(['placeholder'=> $placeholder]) }}">
            @foreach($list as $id => $name)
                <option value="{{$id}}"
                        @if(in_array($id, $value)) selected @endif>{{$name}}</option>
            @endforeach
        </select>
        <script>
            @php( $funcName = "select2_{$model}_{$selfKey}")
            function f{{$funcName}}() {
                $('#select2-{{$model}}-{{$selfKey}}')
                    .select2({placeholder: '{{$placeholder}}'})
                    .on('change', function (e) {
                    @this.set('{{$model}}', $(e.target).val())
                    });
            }
            if (document.readyState === "complete") {
                f{{$funcName}}()
            } else {
                document.addEventListener("DOMContentLoaded", f{{$funcName}});
            }
            //# sourceURL=#select2-{{$model}}-{{$selfKey}}_inline.js
        </script>
    </div>

</div>
