<x-app-layout body-classes="page-404">
<main class="page-main page-404">
      <div class="page-content --page-404">
        <div class="page-404-box"><img src="/assets/img/img-404.svg" alt="img-404">
          <div>
            <h1>@lang('custom::site.There is no such page on the site')</h1>
            <p>@lang('custom::site.The link may not be correct ...')</p><a class="button-outline" href="{{route('main')}}">
            @lang('custom::site.Go Home')</a>
          </div>
        </div>
      </div>
    </main>
</x-app-layout>


