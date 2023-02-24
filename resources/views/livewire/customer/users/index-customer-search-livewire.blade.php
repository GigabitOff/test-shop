<div class="drop --search">
    <span class="drop-clear"></span><input class="form-control drop-input" type="text"
                                           placeholder="@lang('custom::site.search')"
                                           wire:model.debounce.700ms="search"
                                           onfocusout="document.customeDropdown.hideDropdown(this)"
                                           name="search"/>
    @if(!empty($search_list))
        <div class="drop-box"
             style="display:@if('search' === $mode)block @else none @endif ;">
            <div class="drop-overflow">
                <ul class="drop-list">
                    @foreach($search_list as $id => $user)
                        <li class="drop-list-item" wire:click="setFilteredSearch({ id:{{$id}},value:'{{$user['name']}}' })"
                            title="{{$user['name']}}">{{$user['name']}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
