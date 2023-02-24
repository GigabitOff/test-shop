<x-app-layout body-classes="page-product">
    {{-- Product Details--}}
    @livewire('catalog.category.catalog-category-show-single-livewire',['item_id'=>$id,'data'=>$category], key('product-show-'.time()))

    {{-- Product Related--}}
    @livewire('catalog.product.catalog-product-related-show-livewire',['item_id'=>$id,'data'=>$category], key('product-related-'.time()))

@push('show-data')
    <div class="modal fade" id="modal-add-review" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            @livewire('widgets.catalog.review.review-send-livewire', ['category_id' => $category->id], key(time().'-review-send-'.$id))
        </div>
    </div>
@endpush

</x-app-layout>
