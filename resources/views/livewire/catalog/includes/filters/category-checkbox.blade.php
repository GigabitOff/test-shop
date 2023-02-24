<x-filter.item
    :title="$title"
    :collapsed="$collapsed"
    :key="$key"
>
    @if($parentCategoryId != 0)
        <a class="filter-back ico_angle-left" href="{{route('catalog.index')}}">@lang('custom::site.back')</a>
    @endif
    <div class="filter-content-overflow">
        <ul class="filter-content-list">
            @foreach($list as $item)
                @if($item['label'] && $item['key'])
                    <li>
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
</x-filter.item>
