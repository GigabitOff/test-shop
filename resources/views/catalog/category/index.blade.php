<x-app-layout body-classes="page-catalog">
@include('layouts.includes.header',['meta'=>'', 'image'=>''])
  <section class="section-page-title --catalog aos-init aos-animate" data-aos="fade-in" data-aos-duration="500">
    <div class="container container-xl">
      <div class="section-page-title--padding">
      <h1 class="page-title aos-init aos-animate" data-aos="fade-right" data-aos-delay="200" data-aos-duration="500">
          @lang('custom::site.Product catalog')</h1>
    </div>
    </div>
  </section>
  <div class="catalog-content" data-aos="fade-up" data-aos-delay="500" data-aos-duration="500">
    <div class="container container-xl">
        <div class="catalog-content__inner">
            <div class="catalog-content__sidebar">
              {{-- Filter Catalog--}}
                @livewire('catalog.catalog-filter-livewire', ['categoriesAll'=>($categories ?? $categories), 'filters_seo'=>$filters_seo],key('catalog-filter-'.time()))
            </div>
            {{-- Body Catalog--}}
                @livewire('catalog.catalog-body-livewire',['parentIdRaw'=>$parentIdRaw], key('catalog-filter-'.time()))

            </div>
        </div>
    </div>
  </div>
</x-app-layout>