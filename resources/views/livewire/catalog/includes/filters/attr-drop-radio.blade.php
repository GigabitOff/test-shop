<x-filter.item-drop
    :title="$title"
>
    <div class="filter-drop-scroll">

        <ul class="filter-drop-list">

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
    </div>
    <div class="filter-drop-footer">
        <button class="clear"
                wire:click="resetFilters({{$attrFilter['key']}})"
                type="button">@lang('custom::site.Reset')</button>
        <button class="save" type="button">Зберегти</button>
    </div>
</x-filter.item-drop>
