<div class="container">
    {{-- Комплексні рішення. --}}
    <h3 class="section-title text-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="500">
                @lang('custom::site.Comprehensive solutions')</h3>
            <div class="row">
                @for ($i = 1; $i <= 4; $i++)
                @if($solution1 =settingsData('main_solution_'.$i,true))
                <div class="col-xl-3 col-sm-6 mb-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                    <a class="button button-secondary button-block button-border" href="{{ settingsData('main_solution_url_'.$i,true) }}">
                        {{ $solution1 }}
                    </a>
                </div>
                @endif
                @endfor

            </div>
</div>
