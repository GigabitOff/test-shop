<x-app-layout body-classes="lk-cart" :title="__('custom::site.cart')">
    <main class="page-main lk-cart">
      @include('livewire.customer.widget.lk-head-widget')
      <div class="lk-page --cart">
        <div class="container-xl">
          <div class="lk-page__inner">          
            <div class="lk-page__sidebar">
              <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.cart')" />
            </div>
              <livewire:customer.cart.page-main-livewire />
          </div>
        </div>
      </div>
    </main>
</x-app-layout>