<div class="custome-dropdown custome-dropdown-search">
    <span class="custome-dropdown-clear icon-close @if($search_id) is-active @endif"
          onclick="$(this).parent().find('input').focus();
          $(this).parent().find('.custome-dropdown-box').remove();
          @this.resetSearch()"
          style="background-color: #e6ebee;"></span>
    <input class="form-control" type="text"
           placeholder="@lang('custom::site.search')"
           wire:model.debounce.700ms="search"
           onfocusout="document.customeDropdown.hideDropdown(this)"
           name="search"><span></span>
    @if(!empty($search_list))
        <div class="custome-dropdown-box"
             style="display:@if($search_mode)block @else none @endif ;">
            <div class="custome-dropdown-overflow">
                <ul>
                    @foreach($search_list as $id => $name)
                        <li onclick="@this.setSearched({ id:{{$id}},value:'{{$name}}' })"
                            title="{{$name}}">{{$name}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
