<x-app-layout body-classes="lk-waiting" :title="__('custom::site.orders')">
    <main class="page-main lk-waiting">

      @include('livewire.customer.widget.lk-head-widget')
      <div class="lk-page --orders">
        <div class="container-xl">
          <div class="lk-page__inner">
            <div class="lk-page__sidebar">
                <livewire:widgets.cabinet.menu-widget/>
            </div>
            <!-- Компонет таблицы Лист очікування -->
                @livewire('customer.waiting.customer-waiting-index-livewire')
          </div>
        </div>
      </div>
    </main>
</x-app-layout>
