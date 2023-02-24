@php
    function tagFirstWord($string, $tag="b") {
    $words = explode(" ", $string);
    $words[0] = "<{$tag}>{$words[0]}</{$tag}>";

    return implode(" ", $words);
}
@endphp
<section class="section-page-title" data-aos="fade-in" data-aos-duration="500">
    <div class="container container-xl">
          <div class="row justify-content-xl-center">
            <div class="col-xl-8">
              <h1 class="page-title" data-aos="fade-right" data-aos-delay="200" data-aos-duration="500">{!! tagFirstWord($title) !!}</h1>
            </div>
          </div>
        </div>
      </section>
