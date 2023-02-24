<x-filter.item-drop
    :title="$title"
>
    <div class="filter-drop-scroll">

        @php
            $current = collect($list)->firstWhere('checked', true);
            $curValue = $current['label'] ?? '';
        @endphp
        <ul class="filter-drop-list">
            <li>
                <div class="drop --select" id="drp-{{ $key }}" wire:ignore.self>
                <span class="drop-clear @if($curValue) _active @endif"
                      onclick="@this.setFilterItemData('{{$key}}','')"
                ></span>
                    <input class="form-control drop-input drop-input-hide"
                           type="text" autocomplete="off" placeholder="{{$title}}">
                    <button class="form-control drop-button"
                            type="button">{{$curValue ?: $title}}</button>
                    <div class="drop-box" wire:ignore.self>
                        <div class="drop-overflow">
                            <ul class="drop-list">
                                @foreach($list as $item)
                                    @if($item['label'] && $item['key'])
                                        <li class="drop-list-item"
                                            onclick="@this.setFilterItemData('{{$key}}','{{ $item['key'] }}', true, true)"
                                        >{{$item['label']}}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="filter-drop-footer">
        <button class="clear"
                wire:click="resetFilters({{$attrFilter['key']}})"
                type="button">@lang('custom::site.Reset')</button>
        <button class="save" type="button">Зберегти</button>
    </div>
</x-filter.item-drop>
