
{{--    Props: (string) model, (string) name, (array) list, (string) placeholder    --}}

<div wire:ignore>
    <select wire:model.defer="department" class="nice form-control" id="niceSelect_{{$model}}"
            onchange="@this.set('{{$model}}', this.value)"
            name="{{$name}}">
        <option value="0" @if(!$model) selected @endif>{{$placeholder}}</option>
        @foreach($list as $key => $label)
            <option value="{{$key}}" @if($model === $key) selected @endif>{{$label}}</option>
        @endforeach
    </select>
    <script>
        window.addEventListener('reset_{{$model}}_toDefault', function(){
            $('#niceSelect_{{$model}}').val(0).niceSelect('update');
        })
    </script>
</div>
