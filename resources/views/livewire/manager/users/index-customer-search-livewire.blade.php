<div class="custome-dropdown custome-dropdown--arrow --empty">
    <input class="form-control" type="text"
           placeholder="@lang('custom::site.customer_filter')"
           wire:model.debounce.700ms="search"
           onfocusout="document.customeDropdown.hideDropdown(this)"
           name="customer_filter" autocomplete="off"/>
    @if(!empty($search_list))
        <div class="custome-dropdown-box"
             style="display:@if('search' === $mode)block @else none @endif ;">
            <div class="custome-dropdown-overflow">
                <ul>
                    @foreach($search_list as $id => $user)
                        <li wire:click="setFilteredSearch({ id:{{$id}},value:'{{$user['name']}}' })"
                            title="{{$user['name']}}">{{$user['name']}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>

