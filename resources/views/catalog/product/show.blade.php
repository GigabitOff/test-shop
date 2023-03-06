<x-app-layout>
    <main class="page-main page-product">
        <x-breadcrumbs
            :list="$breadcrumbs"
            :currentName="$data->name"
        />
        <section class="section-banner --mobile">
            <div class="container-xl">
                <x-pages.product.banner-top />
            </div>
        </section>
        <div class="page-content --product">
            <div class="container-xl">
                <div class="row g-5">

                    <div class="col-xxl-5 col-md-6">
                        <livewire:catalog.product.show-gallery-section-livewire
                            :product="$data"/>
                    </div>

                    <div class="col-xxl-7 col-md-6">
                        <livewire:catalog.product.show-purchase-section-livewire
                            :product="$data"
                        />
                    </div>

                    <div class="col-12 --product-visible-md">
                        <div class="product-full-box --info-dependence"></div>
                    </div>

                    <div class="col-xxl-7 col-xl-7">
                        <div class="row g-5">
                            @include('livewire.catalog.product.product-specification-livewire')
                            <div class="da m-xl-0"></div>
                            @include('livewire.catalog.product.product-description-livewire')
                        </div>
                    </div>

                    <div class="col-xxl-5 col-xl-5">
                        <div class="row g-5">
                            <livewire:catalog.product.show-related-section-livewire :product="$data"/>

                            <livewire:widgets.catalog.review.review-show-livewire :product_id="$data->id"/>
                        </div>
                    </div>

                    <div class="col-12">
                        @if(auth()->user())
                            <div class="product-full-box --compare">
                                <div class="product-full-box__head">
                                    <div class="product-full-box__title">Порівняння товарів</div>
                                </div>
                                <div class="product-full-box__body">
                                    <div class="compare-content">
                                        <div class="row g-0">
                                            <div class="col-xl-2 --compare-hidden-md">
                                                <div class="section-compare-sidebar">
                                                    <div class="compare-sidebar">
                                                        <div class="compare-sidebar__head"></div>
                                                        <div class="compare-sidebar__body">
                                                            <ul class="compare-sidebar__list">
                                                                <li>Характеристика</li>
                                                                <li>Характеристика</li>
                                                                <li>Характеристика</li>
                                                                <li>Характеристика</li>
                                                                <li>Характеристика</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-10">
                                                <div class="section-compare-content">
                                                    <div class="js-compare-slider compare-items">
                                                        <div class="swiper">
                                                            <div class="swiper-wrapper">


                                                                <div class="swiper-slide">
                                                                    <div class="compare-item">
                                                                        <div class="compare-item__head">
                                                                            <div class="compare-item__box">
                                                                                <div class="compare-item__media">
                                                                                    <div class="compare-item__action">
                                                                                        <div
                                                                                            class="compare-item__label">
                                                                                            в наявності
                                                                                        </div>
                                                                                        <div
                                                                                            class="compare-item__brand">
                                                                                            <img
                                                                                                src="assets/img/logo-blum.svg"
                                                                                                alt="blum"></div>
                                                                                    </div>
                                                                                    <img
                                                                                        src="assets/img/product-compare.jpg"
                                                                                        alt="compare">
                                                                                </div>
                                                                                <div class="compare-item__info">
                                                                                    <div class="compare-item__number">
                                                                                        №22153231
                                                                                    </div>
                                                                                    <div class="compare-item__title"><a
                                                                                            href="page-product.html">Ручка
                                                                                            меблева GTV UA-337</a></div>
                                                                                    <div class="compare-item__price">
                                                                                        4000 ₴
                                                                                    </div>
                                                                                    <div class="compare-item__btn">
                                                                                        <button
                                                                                            class="js-add-cart button-outline button-small"
                                                                                            type="button">Придбати
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="compare-item__body">
                                                                            <ul class="compare-item__list">
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="swiper-slide">
                                                                    <div class="compare-item">
                                                                        <div class="compare-item__head">
                                                                            <div class="compare-item__box">
                                                                                <div class="compare-item__media">
                                                                                    <div class="compare-item__action">
                                                                                        <div
                                                                                            class="compare-item__label">
                                                                                            в наявності
                                                                                        </div>
                                                                                        <div
                                                                                            class="compare-item__brand">
                                                                                            <img
                                                                                                src="assets/img/logo-blum.svg"
                                                                                                alt="blum"></div>
                                                                                    </div>
                                                                                    <img
                                                                                        src="assets/img/product-compare.jpg"
                                                                                        alt="compare">
                                                                                </div>
                                                                                <div class="compare-item__info">
                                                                                    <div class="compare-item__number">
                                                                                        №22153231
                                                                                    </div>
                                                                                    <div class="compare-item__title"><a
                                                                                            href="page-product.html">Ручка
                                                                                            меблева GTV UA-337</a></div>
                                                                                    <div class="compare-item__price">
                                                                                        4000 ₴
                                                                                    </div>
                                                                                    <div class="compare-item__btn">
                                                                                        <button
                                                                                            class="js-add-cart button-outline button-small"
                                                                                            type="button">Придбати
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="compare-item__body">
                                                                            <ul class="compare-item__list">
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="swiper-slide">
                                                                    <div class="compare-item">
                                                                        <div class="compare-item__head">
                                                                            <div class="compare-item__box">
                                                                                <div class="compare-item__media">
                                                                                    <div class="compare-item__action">
                                                                                        <div
                                                                                            class="compare-item__label">
                                                                                            в наявності
                                                                                        </div>
                                                                                        <div
                                                                                            class="compare-item__brand">
                                                                                            <img
                                                                                                src="assets/img/logo-blum.svg"
                                                                                                alt="blum"></div>
                                                                                    </div>
                                                                                    <img
                                                                                        src="assets/img/product-compare.jpg"
                                                                                        alt="compare">
                                                                                </div>
                                                                                <div class="compare-item__info">
                                                                                    <div class="compare-item__number">
                                                                                        №22153231
                                                                                    </div>
                                                                                    <div class="compare-item__title"><a
                                                                                            href="page-product.html">Ручка
                                                                                            меблева GTV UA-337</a></div>
                                                                                    <div class="compare-item__price">
                                                                                        4000 ₴
                                                                                    </div>
                                                                                    <div class="compare-item__btn">
                                                                                        <button
                                                                                            class="js-add-cart button-outline button-small"
                                                                                            type="button">Придбати
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="compare-item__body">
                                                                            <ul class="compare-item__list">
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="swiper-slide">
                                                                    <div class="compare-item">
                                                                        <div class="compare-item__head">
                                                                            <div class="compare-item__box">
                                                                                <div class="compare-item__media">
                                                                                    <div class="compare-item__action">
                                                                                        <div
                                                                                            class="compare-item__label">
                                                                                            в наявності
                                                                                        </div>
                                                                                        <div
                                                                                            class="compare-item__brand">
                                                                                            <img
                                                                                                src="assets/img/logo-blum.svg"
                                                                                                alt="blum"></div>
                                                                                    </div>
                                                                                    <img
                                                                                        src="assets/img/product-compare.jpg"
                                                                                        alt="compare">
                                                                                </div>
                                                                                <div class="compare-item__info">
                                                                                    <div class="compare-item__number">
                                                                                        №22153231
                                                                                    </div>
                                                                                    <div class="compare-item__title"><a
                                                                                            href="page-product.html">Ручка
                                                                                            меблева GTV UA-337</a></div>
                                                                                    <div class="compare-item__price">
                                                                                        4000 ₴
                                                                                    </div>
                                                                                    <div class="compare-item__btn">
                                                                                        <button
                                                                                            class="js-add-cart button-outline button-small"
                                                                                            type="button">Придбати
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="compare-item__body">
                                                                            <ul class="compare-item__list">
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="swiper-slide">
                                                                    <div class="compare-item">
                                                                        <div class="compare-item__head">
                                                                            <div class="compare-item__box">
                                                                                <div class="compare-item__media">
                                                                                    <div class="compare-item__action">
                                                                                        <div
                                                                                            class="compare-item__label">
                                                                                            в наявності
                                                                                        </div>
                                                                                        <div
                                                                                            class="compare-item__brand">
                                                                                            <img
                                                                                                src="assets/img/logo-blum.svg"
                                                                                                alt="blum"></div>
                                                                                    </div>
                                                                                    <img
                                                                                        src="assets/img/product-compare.jpg"
                                                                                        alt="compare">
                                                                                </div>
                                                                                <div class="compare-item__info">
                                                                                    <div class="compare-item__number">
                                                                                        №22153231
                                                                                    </div>
                                                                                    <div class="compare-item__title"><a
                                                                                            href="page-product.html">Ручка
                                                                                            меблева GTV UA-337</a></div>
                                                                                    <div class="compare-item__price">
                                                                                        4000 ₴
                                                                                    </div>
                                                                                    <div class="compare-item__btn">
                                                                                        <button
                                                                                            class="js-add-cart button-outline button-small"
                                                                                            type="button">Придбати
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="compare-item__body">
                                                                            <ul class="compare-item__list">
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="swiper-slide">
                                                                    <div class="compare-item">
                                                                        <div class="compare-item__head">
                                                                            <div class="compare-item__box">
                                                                                <div class="compare-item__media">
                                                                                    <div class="compare-item__action">
                                                                                        <div
                                                                                            class="compare-item__label">
                                                                                            в наявності
                                                                                        </div>
                                                                                        <div
                                                                                            class="compare-item__brand">
                                                                                            <img
                                                                                                src="assets/img/logo-blum.svg"
                                                                                                alt="blum"></div>
                                                                                    </div>
                                                                                    <img
                                                                                        src="assets/img/product-compare.jpg"
                                                                                        alt="compare">
                                                                                </div>
                                                                                <div class="compare-item__info">
                                                                                    <div class="compare-item__number">
                                                                                        №22153231
                                                                                    </div>
                                                                                    <div class="compare-item__title"><a
                                                                                            href="page-product.html">Ручка
                                                                                            меблева GTV UA-337</a></div>
                                                                                    <div class="compare-item__price">
                                                                                        4000 ₴
                                                                                    </div>
                                                                                    <div class="compare-item__btn">
                                                                                        <button
                                                                                            class="js-add-cart button-outline button-small"
                                                                                            type="button">Придбати
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="compare-item__body">
                                                                            <ul class="compare-item__list">
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="swiper-slide">
                                                                    <div class="compare-item">
                                                                        <div class="compare-item__head">
                                                                            <div class="compare-item__box">
                                                                                <div class="compare-item__media">
                                                                                    <div class="compare-item__action">
                                                                                        <div
                                                                                            class="compare-item__label">
                                                                                            в наявності
                                                                                        </div>
                                                                                        <div
                                                                                            class="compare-item__brand">
                                                                                            <img
                                                                                                src="assets/img/logo-blum.svg"
                                                                                                alt="blum"></div>
                                                                                    </div>
                                                                                    <img
                                                                                        src="assets/img/product-compare.jpg"
                                                                                        alt="compare">
                                                                                </div>
                                                                                <div class="compare-item__info">
                                                                                    <div class="compare-item__number">
                                                                                        №22153231
                                                                                    </div>
                                                                                    <div class="compare-item__title"><a
                                                                                            href="page-product.html">Ручка
                                                                                            меблева GTV UA-337</a></div>
                                                                                    <div class="compare-item__price">
                                                                                        4000 ₴
                                                                                    </div>
                                                                                    <div class="compare-item__btn">
                                                                                        <button
                                                                                            class="js-add-cart button-outline button-small"
                                                                                            type="button">Придбати
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="compare-item__body">
                                                                            <ul class="compare-item__list">
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="swiper-slide">
                                                                    <div class="compare-item">
                                                                        <div class="compare-item__head">
                                                                            <div class="compare-item__box">
                                                                                <div class="compare-item__media">
                                                                                    <div class="compare-item__action">
                                                                                        <div
                                                                                            class="compare-item__label">
                                                                                            в наявності
                                                                                        </div>
                                                                                        <div
                                                                                            class="compare-item__brand">
                                                                                            <img
                                                                                                src="assets/img/logo-blum.svg"
                                                                                                alt="blum"></div>
                                                                                    </div>
                                                                                    <img
                                                                                        src="assets/img/product-compare.jpg"
                                                                                        alt="compare">
                                                                                </div>
                                                                                <div class="compare-item__info">
                                                                                    <div class="compare-item__number">
                                                                                        №22153231
                                                                                    </div>
                                                                                    <div class="compare-item__title"><a
                                                                                            href="page-product.html">Ручка
                                                                                            меблева GTV UA-337</a></div>
                                                                                    <div class="compare-item__price">
                                                                                        4000 ₴
                                                                                    </div>
                                                                                    <div class="compare-item__btn">
                                                                                        <button
                                                                                            class="js-add-cart button-outline button-small"
                                                                                            type="button">Придбати
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="compare-item__body">
                                                                            <ul class="compare-item__list">
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="swiper-slide">
                                                                    <div class="compare-item">
                                                                        <div class="compare-item__head">
                                                                            <div class="compare-item__box">
                                                                                <div class="compare-item__media">
                                                                                    <div class="compare-item__action">
                                                                                        <div
                                                                                            class="compare-item__label">
                                                                                            в наявності
                                                                                        </div>
                                                                                        <div
                                                                                            class="compare-item__brand">
                                                                                            <img
                                                                                                src="assets/img/logo-blum.svg"
                                                                                                alt="blum"></div>
                                                                                    </div>
                                                                                    <img
                                                                                        src="assets/img/product-compare.jpg"
                                                                                        alt="compare">
                                                                                </div>
                                                                                <div class="compare-item__info">
                                                                                    <div class="compare-item__number">
                                                                                        №22153231
                                                                                    </div>
                                                                                    <div class="compare-item__title"><a
                                                                                            href="page-product.html">Ручка
                                                                                            меблева GTV UA-337</a></div>
                                                                                    <div class="compare-item__price">
                                                                                        4000 ₴
                                                                                    </div>
                                                                                    <div class="compare-item__btn">
                                                                                        <button
                                                                                            class="js-add-cart button-outline button-small"
                                                                                            type="button">Придбати
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="compare-item__body">
                                                                            <ul class="compare-item__list">
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="swiper-slide">
                                                                    <div class="compare-item">
                                                                        <div class="compare-item__head">
                                                                            <div class="compare-item__box">
                                                                                <div class="compare-item__media">
                                                                                    <div class="compare-item__action">
                                                                                        <div
                                                                                            class="compare-item__label">
                                                                                            в наявності
                                                                                        </div>
                                                                                        <div
                                                                                            class="compare-item__brand">
                                                                                            <img
                                                                                                src="assets/img/logo-blum.svg"
                                                                                                alt="blum"></div>
                                                                                    </div>
                                                                                    <img
                                                                                        src="assets/img/product-compare.jpg"
                                                                                        alt="compare">
                                                                                </div>
                                                                                <div class="compare-item__info">
                                                                                    <div class="compare-item__number">
                                                                                        №22153231
                                                                                    </div>
                                                                                    <div class="compare-item__title"><a
                                                                                            href="page-product.html">Ручка
                                                                                            меблева GTV UA-337</a></div>
                                                                                    <div class="compare-item__price">
                                                                                        4000 ₴
                                                                                    </div>
                                                                                    <div class="compare-item__btn">
                                                                                        <button
                                                                                            class="js-add-cart button-outline button-small"
                                                                                            type="button">Придбати
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="compare-item__body">
                                                                            <ul class="compare-item__list">
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="swiper-slide">
                                                                    <div class="compare-item">
                                                                        <div class="compare-item__head">
                                                                            <div class="compare-item__box">
                                                                                <div class="compare-item__media">
                                                                                    <div class="compare-item__action">
                                                                                        <div
                                                                                            class="compare-item__label">
                                                                                            в наявності
                                                                                        </div>
                                                                                        <div
                                                                                            class="compare-item__brand">
                                                                                            <img
                                                                                                src="assets/img/logo-blum.svg"
                                                                                                alt="blum"></div>
                                                                                    </div>
                                                                                    <img
                                                                                        src="assets/img/product-compare.jpg"
                                                                                        alt="compare">
                                                                                </div>
                                                                                <div class="compare-item__info">
                                                                                    <div class="compare-item__number">
                                                                                        №22153231
                                                                                    </div>
                                                                                    <div class="compare-item__title"><a
                                                                                            href="page-product.html">Ручка
                                                                                            меблева GTV UA-337</a></div>
                                                                                    <div class="compare-item__price">
                                                                                        4000 ₴
                                                                                    </div>
                                                                                    <div class="compare-item__btn">
                                                                                        <button
                                                                                            class="js-add-cart button-outline button-small"
                                                                                            type="button">Придбати
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="compare-item__body">
                                                                            <ul class="compare-item__list">
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="swiper-slide">
                                                                    <div class="compare-item">
                                                                        <div class="compare-item__head">
                                                                            <div class="compare-item__box">
                                                                                <div class="compare-item__media">
                                                                                    <div class="compare-item__action">
                                                                                        <div
                                                                                            class="compare-item__label">
                                                                                            в наявності
                                                                                        </div>
                                                                                        <div
                                                                                            class="compare-item__brand">
                                                                                            <img
                                                                                                src="assets/img/logo-blum.svg"
                                                                                                alt="blum"></div>
                                                                                    </div>
                                                                                    <img
                                                                                        src="assets/img/product-compare.jpg"
                                                                                        alt="compare">
                                                                                </div>
                                                                                <div class="compare-item__info">
                                                                                    <div class="compare-item__number">
                                                                                        №22153231
                                                                                    </div>
                                                                                    <div class="compare-item__title"><a
                                                                                            href="page-product.html">Ручка
                                                                                            меблева GTV UA-337</a></div>
                                                                                    <div class="compare-item__price">
                                                                                        4000 ₴
                                                                                    </div>
                                                                                    <div class="compare-item__btn">
                                                                                        <button
                                                                                            class="js-add-cart button-outline button-small"
                                                                                            type="button">Придбати
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="compare-item__body">
                                                                            <ul class="compare-item__list">
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="compare-item__item">
                                                                                        <span
                                                                                            class="lbl">Характеристика</span><span
                                                                                            class="value">Характеристика</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="swiper-nav --section-slider-nav">
                                                            <div class="swiper-button-prev"></div>
                                                            <div class="swiper-pagination"></div>
                                                            <div class="swiper-button-next"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="m-reviews2">
            <div class="modal-dialog modal-dialog-centered">
                @livewire('widgets.catalog.review.review-send-livewire', ['item_id'=>$data->id])
            </div>
        </div>

    </main>
</x-app-layout>
