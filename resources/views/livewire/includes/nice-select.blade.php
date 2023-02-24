<div>
    <div style="display: none">
        <select class="no-nice" name="{{$name}}-hidden">
            <option value="0"
                    @if(!$model_id) selected @endif>{{$placeholder}}</option>
            @foreach($model_list as $key => $model)
                <option value="{{$key}}"
                        @if($model_id === $key) selected @endif>{{$model['name']}}</option>
            @endforeach
        </select>
    </div>
    <div wire:ignore>
        <select class="nice"
                onchange="@this.set('{{$model_id}}', this.value)"
                name="{{$name}}">
            <option value="0"
                    @if(!$model_id) selected @endif>{{$placeholder}}</option>
            @foreach($model_list as $key => $model)
                <option value="{{$key}}"
                        @if($model_id === $key) selected @endif>{{$model['name']}}</option>
            @endforeach
        </select>
    </div>
</div>
