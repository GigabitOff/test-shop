{{-- page-product-4.html --}}
<div class="col-xxl-5 col-md-6">
    <livewire:catalog.product.show-gallery-section-livewire :product="$data"/>
</div>
<div class="col-xxl-7 col-md-6">
    <livewire:catalog.product.show-purchase-section-livewire :product="$data" :action="$action"/>
</div>
<div class="col-12 --product-visible-md">
    <div class="product-full-box --info-dependence"></div>
</div>
<div class="col-xxl-6 col-lg-6">
    <livewire:catalog.product.show-related-section-livewire :product="$data"/>
</div>
<div class="col-xxl-6 col-lg-6">
    <livewire:widgets.catalog.review.review-show-livewire :product_id="$data->id"/>
</div>
<div class="col-12">
    @include('livewire.catalog.product.product-description-livewire')
</div>
@if(!empty($data->comparisonProducts->count()))
    <div class="col-12">
        <livewire:customer.comparisons.product-details-livewire :products="$data->comparisonProducts"/>
    </div>
@endif
