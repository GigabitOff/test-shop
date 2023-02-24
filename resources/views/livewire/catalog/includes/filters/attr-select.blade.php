<x-filter.item
    :title="$title"
    :collapsed="$collapsed"
    :key="$key"
>
    @php
        $current = collect($list)->firstWhere('checked', true);
        $curValue = $current['label'] ?? '';
    @endphp
    <ul class="filter-content-list filter-drop-list">
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
</x-filter.item>
