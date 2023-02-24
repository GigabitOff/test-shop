<x-filter.item-drop
    :title="$title"
>
    <div class="filter-drop-scroll">
        <ul class="filter-drop-list">

            @foreach($list as $item)
                @if($item['label'] && $item['key'])
                    <li>
                        <label class="check --checkbox-icon">
                            <input class="check__input" id="cat-{{ $key }}-{{ $item['key'] }}"
                                   onclick="@this.setFilterItemData('{{$key}}','{{ $item['key'] }}', this.checked)"
                                   @if($item['checked']) checked @endif
                                   type="checkbox">
                            <span class="check__box"></span>
                            <span class="check__txt">
                            <img src="/assets/img/ico-filter.svg" alt="icon">{{$item['label']}}</span>
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
