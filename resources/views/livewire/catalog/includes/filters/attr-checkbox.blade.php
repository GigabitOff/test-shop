<x-filter.item
    :title="$title"
    :collapsed="$collapsed"
    :key="$key"
>
    @if($searchable)
    <div class="filter-drop-search search-item">
        <input class="js-filter-search" type="text" name="search"
               x-model="search"
               autocomplete="off"
               placeholder="@lang('custom::site.search')">
    </div>
    @endif
    <ul class="filter-content-list">
        @foreach($list as $item)
            @if($item['label'] && $item['key'])
                <li class="fi-pixel"

                    data-label="{{$item['label']}}">
                    <label class="check">
                        <input class="check__input" id="cat-{{ $key }}-{{ $item['key'] }}"
                               onclick="@this.setFilterItemData('{{$key}}','{{ $item['key'] }}', this.checked)"
                               @if($item['checked']) checked @endif
                               type="checkbox"/>
                        <span class="check__box"></span>
                        <span class="check__txt">{{$item['label']}}</span>
                    </label>
                </li>
            @endif
        @endforeach
    </ul>
</x-filter.item>
