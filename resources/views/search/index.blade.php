<x-app-layout body-classes="page-catalog">
      <section class="section-page-title" data-aos="fade-in" data-aos-duration="500">
        <div class="container">
          <h1 class="page-title" data-aos="fade-right" data-aos-delay="200" data-aos-duration="500">
              @lang('custom::site.Search results')</h1>
        </div>
      </section>
      <div class="catalog-content" data-aos="fade-up" data-aos-delay="500" data-aos-duration="500">
        <div class="container container-xl">
          <div class="catalog-content__inner">
            <div class="catalog-content__sidebar">
              {{-- Filter Catalog--}}
                @livewire('catalog.catalog-filter-livewire', key('catalog-filter-'.time()))
            </div>
            {{-- Body Catalog--}}
                @livewire('catalog.catalog-search-livewire', key('catalog-search-'.time()))

          </div>
        </div>
      </div>

</x-app-layout>
