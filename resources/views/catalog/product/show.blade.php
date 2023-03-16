<x-app-layout>
    <main class="page-main page-product">
        <x-breadcrumbs
            :list="$breadcrumbs"
            :currentName="$data->name"
        />
        <section class="section-banner --mobile">
            <div class="container-xl">
                <x-pages.product.banner-top />
            </div>
        </section>
        <div class="page-content --product @if($isThreeColumns) --product-single @endif">
            <div class="container-xl">
                <div class="row g-5">

                    @if($isThreeColumns)

                        <div class="col-xxl-4 col-lg-6">
                            <livewire:catalog.product.show-gallery-section-livewire
                                :product="$data"/>
                        </div>

                        <div class="col-xxl-4 col-lg-6">
                            <livewire:catalog.product.show-purchase-section-livewire
                                :product="$data"
                            />
                        </div>

                        <div class="col-xxl-4 col-lg-6">
                            @include('livewire.catalog.product.product-specification-livewire')
                        </div>

                        <div class="col-xxl-12 col-lg-6">
                            @include('livewire.catalog.product.product-description-livewire')
                        </div>

                    @else

                        <div class="col-xxl-5 col-md-6">
                            <livewire:catalog.product.show-gallery-section-livewire
                                :product="$data"/>
                        </div>

                        <div class="col-xxl-7 col-md-6">
                            <livewire:catalog.product.show-purchase-section-livewire
                                :product="$data"
                            />
                        </div>

                        <div class="col-12 --product-visible-md">
                            <div class="product-full-box --info-dependence"></div>
                        </div>

                        <div class="product-info-grid">
                            @include('livewire.catalog.product.product-specification-livewire')
                            @include('livewire.catalog.product.product-description-livewire')
                            <livewire:catalog.product.show-related-section-livewire :product="$data"/>
                            <livewire:widgets.catalog.review.review-show-livewire :product_id="$data->id"/>
                        </div>

                    @endif

                </div>
                <div class="row g-5">
                    <div class="col-12">
                        @if(auth()->user())
                            <livewire:customer.comparisons.product-details-livewire/>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="m-reviews2">
            <div class="modal-dialog modal-dialog-centered">
                @livewire('widgets.catalog.review.review-send-livewire', ['item_id'=>$data->id])
            </div>
        </div>

    </main>
</x-app-layout>
