{{-- page-product-11.html --}}
<div class="col-xxl-4 col-md-6">
    <livewire:catalog.product.show-gallery-section-livewire :product="$data"/>
</div>
<div class="col-xxl-4 col-md-6">
    <livewire:catalog.product.show-purchase-section-livewire :product="$data" :action="$action"/>
</div>
<div class="col-xxl-4 col-xl-6">
    <div class="product-full-box --specification --specification-single">
      <div class="product-full-box__head">
        <div class="product-full-box__title">Специфікація</div>
      </div>
      <div class="product-full-box__body --overflow">
        <ul class="specification-list">
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
          <li><span>Характеристика</span><strong>Характеристика</strong></li>
        </ul>
      </div>
    </div>
</div>
<div class="col-xxl-12 col-xl-6">
    <div class="product-full-box --reviews">
      <div class="product-full-box__head">
        <div>
          <div class="product-full-box__title">Відгуки</div>
          <div class="reviews-col">23</div>
          <div class="reviews-stars">
            <fieldset class="rating">
              <div class="rating__group"><input class="rating__input" id="review-1" type="radio" name="review" value="1" /><label class="rating__star" for="review-1" aria-label="Ужасно"></label><input class="rating__input" id="review-2" type="radio" name="review" value="2" /><label class="rating__star" for="review-2" aria-label="Сносно"></label><input class="rating__input" id="review-3" type="radio" name="review" value="3" /><label class="rating__star" for="review-3" aria-label="Нормально"></label><input class="rating__input" id="review-4" type="radio" name="review" value="4" checked="" /><label class="rating__star" for="review-4" aria-label="Хорошо"></label><input class="rating__input" id="review-5" type="radio" name="review" value="5" /><label class="rating__star" for="review-5" aria-label="Отлично"></label></div>
            </fieldset>
          </div>
        </div>
        <div><button class="add-review ico_plus" type="button" data-bs-toggle="modal" data-bs-target="#m-reviews2"></button></div>
      </div>
      <div class="product-full-box__body --overflow">
        <ul class="reviews-list">
          <li class="reviews-list__item">
            <div class="reviews-list__name">Анатолий Деркач</div>
            <div class="reviews-list__text">There are many variations of passages of Lorem Ipsum available, but the majority have sufferedhich don't look even slightly believable.</div>
          </li>
          <li class="reviews-list__item">
            <div class="reviews-list__name">Максим</div>
            <div class="reviews-list__text">There are many variations majority have suffered alteration</div>
          </li>
          <li class="reviews-list__item">
            <div class="reviews-list__name">Анатолий Деркач</div>
            <div class="reviews-list__text">There are many variations of passages of Lorem Ipsum available, but the majority have sufferedhich don't look even slightly believable. There are many variations of passages of Lorem Ipsum available, but the majority have...</div>
          </li>
          <li class="reviews-list__item">
            <div class="reviews-list__name">Максим</div>
            <div class="reviews-list__text">There are many variations of passages of Lorem Ipsum available, but the majority have sufferedhich don't look even slightly believable. There are many variations of passages of</div>
          </li>
          <li class="reviews-list__item">
            <div class="reviews-list__name">Анатолий Деркач</div>
            <div class="reviews-list__text">There are many variations of passages of Lorem Ipsum available, but the majority have sufferedhich don't look even slightly believable.</div>
          </li>
          <li class="reviews-list__item">
            <div class="reviews-list__name">Максим</div>
            <div class="reviews-list__text">There are many variations majority have suffered alteration</div>
          </li>
          <li class="reviews-list__item">
            <div class="reviews-list__name">Анатолий Деркач</div>
            <div class="reviews-list__text">There are many variations of passages of Lorem Ipsum available, but the majority have sufferedhich don't look even slightly believable. There are many variations of passages of Lorem Ipsum available, but the majority have...</div>
          </li>
          <li class="reviews-list__item">
            <div class="reviews-list__name">Максим</div>
            <div class="reviews-list__text">There are many variations of passages of Lorem Ipsum available, but the majority have sufferedhich don't look even slightly believable. There are many variations of passages of</div>
          </li>
        </ul>
      </div>
    </div>
</div>
@if(!empty($data->comparisonProducts->count()))
    <div class="col-12">
        <livewire:customer.comparisons.product-details-livewire :products="$data->comparisonProducts"/>
    </div>
@endif
