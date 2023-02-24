  <x-app-layout>
    <main class="page-main lk-index">
      <div class="lk-page --lk-index">
        <div class="container-xl">
          <div class="lk-page__inner">
            <div class="lk-page__sidebar" data-aos="fade-up" data-aos-duration="500">
              <div class="lk-menu">
                <livewire:widgets.cabinet.menu-widget />
              </div>
            </div>
            <div class="lk-page__content">
              <div class="row g-5">
                <livewire:customer.widget.orders-livewire/>
                <div class="col-xl-6" data-aos="fade-left" data-aos-delay="600" data-aos-duration="500">
                  <!-- Виджет Рекомендованные к покупке -->
                  <livewire:customer.widget.recommended-widget-livewire/>
                  <!-- Виджет Бонусов -->
                  <livewire:customer.widget.bonuses-widget-livewire/>
                </div>
              </div>
              <div class="row g-5 mt-0">
              <livewire:customer.widget.debts-widget-livewire/>

                <div class="col-xl-6" data-aos="fade-left" data-aos-delay="800" data-aos-duration="500">
                   <livewire:customer.widget.favorites-widget-livewire/>
                   <livewire:customer.widget.messages-widget-livewire/>
                </div>
              </div>
              <div class="row g-5 mt-0">

             <!-- Виджет Данных покупателя -->
             <livewire:customer.widget.personal-data-widget/>

                <div class="col-xl-7 col-md-6">
                  <div class="row g-5">

                  <livewire:customer.widget.personal-manager/>

                      <div class="col-xl-6" data-aos="fade-up" data-aos-delay="600" data-aos-duration="500">
                          <div class="lk-widjet --price">
                              <div class="lk-widjet__parallax">
                                  <div class="lk-widjet__decor" data-depth="0.2"><img src="/assets/img/bg_widjet-price.png" alt=""></div>
                              </div>
                              <div class="lk-widjet__head">
                                  <h3 class="lk-widjet__title">Прайс</h3>
                              </div>
                              <div class="lk-widjet__body">
                                  <div class="drop --select --arrow w-100">
                                      <spav class="drop-clear"></spav><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="CSV" /><button class="form-control drop-button" type="button">CSV</button>
                                      <div class="drop-box">
                                          <div class="drop-overflow">
                                              <ul class="drop-list">
                                                  <li class="drop-list-item">CSV 1</li>
                                                  <li class="drop-list-item">CSV 2</li>
                                                  <li class="drop-list-item">CSV 3</li>
                                                  <li class="drop-list-item">CSV 4</li>
                                                  <li class="drop-list-item">CSV 5</li>
                                                  <li class="drop-list-item">CSV 6</li>
                                                  <li class="drop-list-item">CSV 7</li>
                                                  <li class="drop-list-item">CSV 8</li>
                                                  <li class="drop-list-item">CSV 9</li>
                                                  <li class="drop-list-item">CSV 10</li>
                                              </ul>
                                          </div>
                                      </div>
                                  </div><a class="button button-accent" href="/assets/img/exsamle.pdf" target="_blank">Завантажити прайс</a>
                              </div>
                          </div>
                      </div>


                  </div>

                  <div class="row g-5 mt-0" data-da=".lk-page.--lk-index .lk-page__content, 1199, 3">
                    <div class="col-12" data-aos="fade-up" data-aos-delay="800" data-aos-duration="500">
                        @livewire('customer.widget.banner-widget-livewire')
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
         @livewire('main-page.viewed-section-livewire')

      </div>
    </main>

  </x-app-layout>
