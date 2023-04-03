<x-app-layout>
@if(!empty($data->seo_canonical))
@section('canonical')
<link rel=“canonical” href=”{{$data->seo_canonical}}” />
@endsection
@endif
    <main class="page-main page-product">
        <x-breadcrumbs
            :list="$breadcrumbs"
            :currentName="$data->name"
        />
        <section class="section-banner --mobile">
            <div class="container-xl">
                <x-pages.product.banner-top/>
            </div>
        </section>
        <div class="page-content --product @if($layout['columns']==3) --info-dependence-none @endif">
            <div class="container-xl">
                <div class="row g-5">
                    @includeFirst([
                        'livewire.catalog.product.layouts.variant-' . $layout['mode'],
                        'livewire.catalog.product.layouts.variant-01111'
                    ])
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
