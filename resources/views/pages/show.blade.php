<x-app-layout body-classes="page-delivery">
<section class="section-page-title" data-aos="fade-in" data-aos-duration="500">
        <div class="container">
          <h1 class="page-title" data-aos="fade-right" data-aos-delay="200" data-aos-duration="500">{{ $data['title']}}</h1>
        </div>
      </section>
      <div class="page-content" data-aos="fade-up" data-aos-delay="500" data-aos-duration="500">
        <div class="container">
            {!! $data->body !!}
        </div>
      </div>
</x-app-layout>
