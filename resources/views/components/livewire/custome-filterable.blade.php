
{{--    Props:                      --}}
{{--        (int|string) key,       --}}
{{--        (array) list,           --}}
{{--        (string) name,          --}}
{{--        (string) model,         --}}
{{--        (string) placeholder,   --}}
{{--        (string) $class         --}}
{{--        (string) $type  // value of custome-dropdown--arrow|custome-dropdown-search    --}}
<div class="drop --arrow {{$type ?? 'custome-dropdown--arrow'}} {{$class ?? ''}}">
    <span class="drop-clear @if($key ?? false) is-active @endif"
          onclick="$(this).parent().find('input').focus();
          $(this).parent().find('.custome-dropdown-box').remove();
          @this.resetFilterable('{{$name}}')"></span>
    <input class="form-control drop-input" type="text"
           placeholder="{{$placeholder ?? ''}}"
           wire:model.debounce.700ms="{{$model ?? ''}}"
           onfocusout="document.customeDropdown.hideDropdown(this)"
           name="{{$name}}"><span></span>
    @if(!empty($list ?? []))
        <div class="drop-box"
             style="display:@if($edit)block @else none @endif ;">
            <div class="drop-overflow">
                <ul class="drop-list">
                    @foreach($list as $id => $title)
                        <li class="drop-list-item" onclick="@this.setFilterable('{{$name}}', '{{$id}}', '{{$title}}')">{{$title}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>