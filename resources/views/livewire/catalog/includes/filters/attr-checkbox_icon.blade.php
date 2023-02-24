<x-filter.item
    :title="$title"
    :collapsed="$collapsed"
    :key="$key"
>
    <ul class="filter-content-list">
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
</x-filter.item>
