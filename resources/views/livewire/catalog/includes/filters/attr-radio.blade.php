<x-filter.item
    :title="$title"
    :collapsed="$collapsed"
    :key="$key"
>
    <div class="filter-drop-search search-item">
        <input class="js-filter-search" type="text" name="search"
               autocomplete="off"
               placeholder="@lang('custom::site.search')">
    </div>
    <ul class="filter-content-list">
        @foreach($list as $item)
            @if($item['label'] && $item['key'])
                <li class="fi-pixel" data-label="{{$item['label']}}">
                    <label class="form-check form-switch">
                        <input class="form-check-input"
                               id="cat-{{ $key }}-{{ $item['key'] }}"
                               type="checkbox" name="type"
                               onclick="@this.setFilterItemData('{{$key}}','{{ $item['key'] }}', this.checked, true)"
                               role="switch">
                        <span class="form-check-label">{{$item['label']}}</span>
                    </label>
                </li>
            @endif
        @endforeach
    </ul>
</x-filter.item>
