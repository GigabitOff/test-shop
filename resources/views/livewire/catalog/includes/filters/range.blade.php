<x-filter.item
    :title="$title"
    :collapsed="$collapsed"
    :key="$key"
>

    <div class="range-box" wire:ignore data-range_min="{{$list['min']}}">
        <div class="range-box-inputs">
            <input class="range-price-from" type="text"
                   id="range_price_from_{{$key}}"
                   value="0"
                   placeholder="@lang('custom::site.from')">
            <input class="range-price-to" type="text"
                   id="range_price_to_{{$key}}"
                   value="0"
                   placeholder="@lang('custom::site.to')">
        </div>
        <input class="range-price js-range-slider" data-key="{{$key}}" type="text" name="price" value="">
    </div>
    <script>
        document.rangePriceValues = @js($list);
    </script>
</x-filter.item>
