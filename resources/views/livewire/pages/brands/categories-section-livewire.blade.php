<div>
    <div class="row g-5">
        @foreach($categories as $category)
            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-right"
                 data-aos-delay="{{$loop->iteration * 100}}" data-aos-duration="500">
                <div class="news-card">
                    <div class="news-card__box">
                        <div class="news-card__media">
                            <a href="{{route('catalog.show', $category->slug)}}">
                                <img src="{{$category->imageSrc}}" alt="{{$category->name}}"/></a></div>
                        <div class="news-card__info">
                            <div class="news-card__title">
                                <a href="{{route('catalog.show', $category->slug)}}">{{$category->name}}</a></div>
                            <div class="news-card__text">
                                <p>{!! $category->technical_description !!}</p>
                            </div>
                            <div class="news-card__bottom">
                                {{--                        // hide product counter--}}
                                {{--                        @php($text = numericCasesLang($category->products_count, 'custom::site.product') )--}}
                                {{--                        <div class="news-card__numb text-lowercase">{{$category->products_count}} {{$text}}</div>--}}
                                <div class="news-card__numb"></div>
                                <div class="news-card__btn">
                                    <a class="button-more" href="{{route('catalog.show', $category->slug)}}"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="page-pagination mb-0">
        @if($categories->hasPages())
            {{ $categories->links() }}
        @endif
    </div>
</div>
