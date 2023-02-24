<x-app-layout body-classes="lk-orders" :title="__('custom::site.orders')">
    <main class="page-main lk-orders">
      @include('livewire.customer.widget.lk-head-widget')
      <div class="lk-page --orders">
        <div class="container-xl">
          <div class="lk-page__inner">
            <div class="lk-page__sidebar">
                <livewire:widgets.cabinet.menu-widget/>
            </div>
            <!-- Компонет таблицы заказов -->
            <livewire:customer.orders.index-table-section-livewire/>
          </div>
        </div>
      </div>
    </main>
</x-app-layout>
