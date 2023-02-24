{{--    Props:                          --}}
{{--        (string) name,   required   --}}
{{--        (string) model,  required   --}}
{{--        (string) idInput,           --}}
{{--        (string) placeholder        --}}
{{--        (string) autocomplete       --}}
{{--        (string) class              --}}
{{--        (string) static             --}}

<div class="custome-dropdown custome-dropdown--arrow  {{$class ?? ''}}">
    <span class="custome-dropdown-clear icon-close @if($model['id'] ?? false) is-active @endif"
          onclick="$(this).parent().find('input').focus();
              $(this).parent().find('.custome-dropdown-box').show();
              @this.dropFilterable('{{$name}}')"></span>
    <input
        id="@if(isset($idInput)){{$idInput}}@else{{$name}}@endif"
        class="form-control js-filterable" type="text"
        value="{{$model['value']}}"
        autocomplete="{{$autocomplete ?? 'new-password'}}"
        placeholder="{{$placeholder ?? ''}}"
        onfocusout="document.customeDropdown.hideDropdown(this)"
        name="{{$name}}"/>
    <div class="custome-dropdown-box" style="display:@if($filterableMode === $name)block @else none @endif ;">
        <div class="custome-dropdown-overflow">
            <ul>
                @if(isset($static))
                    <li class="js-filterable-off"
                        onclick="@this.setFilterable('{{$name}}', 'static', '{{$static}}')">{{$static}}</li>
                @endif
                @foreach($model['list'] as $id => $item)
                    @php($text = $item['text'] ?? $item)
                    @php($title = $item['title'] ?? '')
                    <li @if($title) title="{{$title}}" @endif
                    onclick="@this.setFilterable('{{$name}}', '{{$id}}', '{{$text}}')">{{$text}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
