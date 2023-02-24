<div class="catalog-sidebar" wire:ignore.self>
    @if('top' === ($filterSettings['position'] ?? ''))
        @include('livewire.catalog.includes.filter-horizontal')
    @else
        @include('livewire.catalog.includes.filter-vertical')
    @endif
</div>

@push('custom-scripts')

    <script>

        // Обновление значений priceRangeSlider
        document.addEventListener('updatePriceRangeSlider', function (e) {
            const values = e.detail.values;

            $(".range-price").data('ionRangeSlider')
                .update({
                    min: values.min,
                    max: values.max,
                    from: values.from,
                    to: values.to
                });

            $(".range-price-from").val(values.from);
            $(".range-price-to").val(values.to);

        })

        document.addEventListener('DOMContentLoaded', function () {
            // Обработчик изменения ползунка priceRangeSlider
            $(document).on('priceRangeChanged', function (e, values) {
                console.log({'priceRangeChanged': values});
                @this.
                setFilterItemData(values.key, values.range);
            })

            // js фильтрация элементов фильтра
            $(document).on('input', '.js-filter-search', function() {
                const value = $(this).val().toLowerCase();
                $(this).closest('.filter-item, .filter-drop-scroll').find('.fi-pixel')
                    .each((i, el) => {
                        const text = $(el).attr('data-label');
                        if (text && text.toLowerCase().indexOf(value) !== -1) {
                            $(el).show();
                        } else {
                            $(el).hide();
                        }
                    });
            })
        });

        //# sourceURL=catalog-filter-livewire.js
    </script>
@endpush
