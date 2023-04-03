{{--    Props:                          --}}
{{--        (string) name,   required   --}}
{{--        (string) model,  required   --}}
{{--        (string) mode,   required   --}}
{{--        (string) idInput,           --}}
{{--        (string) autocomplete       --}}
{{--        (string) placeholder,       --}}
{{--        (string) $class             --}}

                    <div class="drop --arrow"><span class="drop-clear"
                    onclick="$(this).parent().find('input').focus();
                    $(this).parent().find('.custome-dropdown-box').remove();
                    @this.dropFilterable('{{$name}}')"></span>
                    <input
                            id="@if(isset($idInput)){{$idInput}}@else{{$name}}@endif"
                            class="form-control drop-input" type="text"
                            placeholder="{{$placeholder ?? ''}}"
                            autocomplete="{{$autocomplete ?? 'new-password'}}"
                            wire:model.debounce.700ms="{{$name}}.value"
                            onfocusout="document.customeDropdown.hideDropdown(this)"
                            name="{{$name}}">
                    @if($model['list'])
                        <div class="drop-box" style="display:none;">
                          <div class="drop-overflow">
                            <ul class="drop-list">
                            @foreach($model['list'] as $id => $item)
                                @php($text = $item['text'] ?? $item)
                                @php($title = $item['title'] ?? '')
                                <li class="drop-list-item" @if($title) title="{{$title}}" @endif
                                    onclick="@this.setFilterable('{{$name}}', '{{$id}}', '{{$text}}')">{{$text}}</li>
                            @endforeach
                            </ul>
                          </div>
                        </div>
                    @endif
                    </div>
