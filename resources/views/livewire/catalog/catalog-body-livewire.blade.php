<div class="catalog-content">
    @include('livewire.catalog.catalog-filter-product-livewire')
    <div class="catalog-list @if(isset($_COOKIE['catalogView'])) --list @else --grid @endif" wire:ignore.self>
        @foreach ($data_paginate as $product)
            <x-product-card :product="$product" :show-intro="true"/>
        @endforeach
    </div>
    @include('livewire.includes.per-page-catalog')
    <div class="catalog-footer">
        @if($category)
            <p>{!! $category->technical_description !!}</p>
        @endif
    </div>
</div>

@push('custom-scripts')
    <script>
        breadcrumb = document.getElementsByClassName('breadcrumb-item category');
        var check_input = document.getElementsByClassName('check');

        for (var s = 0; s < breadcrumb.length; s++) {
            var cat = check_input[0].closest('.check')
                .getElementsByClassName('check__txt')[0].innerHTML;

            if (breadcrumb[s].getElementsByTagName('a')[0]
                .innerHTML === cat)
                breadcrumb[s].style.display = 'block';
        }
        document.addEventListener('click', function (e) {
            if (e.target.className == 'check__input') {
                var category = e.target.closest('.check')
                    .getElementsByClassName('check__txt')[0].innerHTML;
                for (var i = 0; i < breadcrumb.length; i++) {
                    breadcrumb[i].style.display = 'none';
                    if (breadcrumb[i].getElementsByTagName('a')[0]
                        .innerHTML == category && e.target.checked)
                        breadcrumb[i].style.display = 'block';
                }
            }
        })
    </script>
@endpush
