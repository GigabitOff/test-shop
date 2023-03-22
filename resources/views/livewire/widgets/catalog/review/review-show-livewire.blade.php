    <div class="product-full-box --reviews">
        <div class="product-full-box__head">
            <div>
                <div class="product-full-box__title">@lang('custom::site.Reviews')</div>
                <div class="reviews-col">{{count($reviews)}}</div>
                <div class="reviews-stars">
                    <fieldset class="rating">
                        <div class="rating__group">
                            @for ($i = 1; $i <= 5; $i++)
                                <input class="rating__input" id="review-{{$i}}" type="radio" name="review"
                                       value="{{$i}}"
                                       @if($rating>=$i) checked @endif/>
                                <label class="rating__star" for="review-{{$i}}"
                                       aria-label="@lang('custom::site.rating_stars.' . $i)"></label>
                            @endfor
                        </div>
                    </fieldset>
                </div>
            </div>

            <div>
                @auth()
                    <button class="add-review ico_plus" type="button" data-bs-toggle="modal"
                            data-bs-target="#m-reviews2"></button>
                @endif
            </div>
        </div>
        <div class="product-full-box__body --overflow">
            <ul class="reviews-list">
                @forelse($reviews as $review)
                    <li class="reviews-list__item">
                        <div class="reviews-list__name">{{ $review->name }}</div>
                        <div class="reviews-list__text">{{ $review->text }}</div>
                    </li>
                @empty
                    <div class="reviews-empty">
                        <p>@lang('custom::site.reviews_empty')</p>
                        @guest
                            <p>@lang('custom::site.login_to_make_review')</p>
                            <a class="button-outline" href="#m-login" data-bs-toggle="modal">{{__('custom::site.authorize')}}</a>
                        @endguest
                    </div>
                @endforelse
            </ul>
        </div>
    </div>
