<x-app-layout>
    <main class="page-main page-catalog">
        <x-breadcrumbs
            :list="$breadcrumbs"
            currentName="{{$category->name ?? ''}}"
        />
        @if($banner)
            <section class="section-banner --mobile">
                <div class="container-xl">
                    <div class="banner">
                        <div class="banner__box">
                            <div class="banner__desc">
                                <div class="banner__top">
                                    <a class="button-back" href="{{route('main')}}">
                                        @lang('custom::site.Come back')
                                        <i class="ico_angle-left"></i>
                                    </a>
                                    <span>@lang('custom::site.Product catalog')</span>
                                </div>
                                <h3 class="banner__title">{{$banner->title ?? ''}}</h3>
                                <p class="banner__text">{{$banner->description ?? ''}}</p>
                                <div class="banner__bottom">
                                    <div class="banner__btn">
                                        <a class="button-outline" href="{{$banner->link ?? ''}}">
                                            @lang('custom::site.Read more')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="banner__media"
                                 style="background-image: url({{\Storage::disk('public')->url($banner->image ?? '')}})"></div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <div class="page-content">
            <div class="container-xl">
                @php
                    // Warning $filter may be null
                    $position = ($filter->position ?? '');
                    $isRight = ('right' === $position);
                    $isTop = ('top' === $position);
                    $isLeft = !($isRight || $isTop);

                    $class = ($isRight ? '--right' : '');
                    $class = $class ?: ($isTop ? '--top' : '');
                @endphp
                <div class="catalog {{$class}}">
                    <div class="catalog-overlay"></div>

                    @if($isLeft || $isTop)
                        {{-- Filter Catalog--}}
                        <livewire:catalog.catalog-filter-livewire
                            :category="$category ?? null"
                            :filter-id="$filter->id ?? 0"
                        />
                    @endif

                    {{-- Body Catalog--}}
                    <livewire:catalog.catalog-body-livewire :category="$category ?? null" />

                    @if($isRight)
                        {{-- Filter Catalog--}}
                        <livewire:catalog.catalog-filter-livewire
                            :category="$category ?? null"
                            :filter-id="$filter->id ?? 0"
                        />
                    @endif
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
