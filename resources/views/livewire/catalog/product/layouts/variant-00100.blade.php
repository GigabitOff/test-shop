{{-- page-product-8.html --}}
<div class="col-xxl-4 col-md-6">
    <livewire:catalog.product.show-gallery-section-livewire :product="$data"/>
</div>
<div class="col-xxl-4 col-md-6">
    <livewire:catalog.product.show-purchase-section-livewire :product="$data"/>
</div>
<div class="col-xxl-4 col-xl-6">
    <livewire:widgets.catalog.review.review-show-livewire :product_id="$data->id"/>
</div>
<div class="col-xxl-12 col-xl-6">
    @include('livewire.catalog.product.product-description-livewire')
</div>
@if(!empty($data->comparisonProducts->count()))
    <div class="col-12">
        <livewire:customer.comparisons.product-details-livewire :products="$data->comparisonProducts"/>
    </div>
@endif
