<div class="drop --search">
    <spav class="drop-clear"></spav><input class="form-control drop-input" type="text"
         placeholder="@lang('custom::site.search')"
         wire:model.debounce.700ms="search"
         onfocusout="document.customeDropdown.hideDropdown(this)"
         name="search" />
  @if(!empty($search_list))     
    <div class="drop-box" style="display:@if('search' === $mode)block @else none @endif;">
      <div class="drop-overflow">
        <ul class="drop-list">
          @foreach($search_list as $id => $item)
            <li class="drop-list-item" wire:click="setSearched({ id:{{$id}},value:'{{$item['name']}}' })"
                title="{{$item['name']}}">{{$item['name']}}
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif
</div>

