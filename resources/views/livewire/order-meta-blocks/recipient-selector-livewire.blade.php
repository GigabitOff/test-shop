<div class="drop --arrow"><span class="drop-clear"></span>
    <input class="form-control drop-input" type="text"
           placeholder="@lang('custom::site.recipient')" name="recipient"
           wire:model.debounce.700ms="recipientName"
           onfocusout="document.customeDropdown.hideDropdown(this); setTimeout(()=>{@this.setName()},200)"
           autocomplete="off">
    @if(!empty($recipients))
        <div class="drop-box" style="display:@if($isOpen)block @else none @endif ;">
            <div class="drop-overflow">
                <ul class="drop-list">
                    @foreach($recipients as $id => $name)
                        <li class="drop-list-item" onclick="@this.setClient({{$id}}, '{{$name}}')"
                                >{{$name}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>