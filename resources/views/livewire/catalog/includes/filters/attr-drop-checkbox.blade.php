<x-filter.item-drop
    :title="$title"
>
    <div class="filter-drop-scroll">
        @if($searchable)
            <form>
                <div class="filter-drop-search search-item">
                    <input class="js-filter-search" type="text" name="search"
                           x-model="search"
                           autocomplete="off"
                           placeholder="@lang('custom::site.search')">
                </div>
            </form>
        @endif

        <ul class="filter-drop-list">

            @foreach($attrFilter['values'] as $item)
                @php($key="attr_{$attrFilter['key']}")
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
    </div>
    <div class="filter-drop-footer">
        <button class="clear"
                wire:click="resetFilters({{$attrFilter['key']}})"
                type="button">@lang('custom::site.Reset')</button>
        <button class="save" type="button">Зберегти</button>
    </div>
</x-filter.item-drop>
