<x-app-layout body-classes="lk-documents" :title="__('custom::site.my_documents')">
    <main class="page-main lk-documents">
      @include('livewire.customer.widget.lk-head-widget')
      <div class="lk-page --documents">
        <div class="container-xl">
          <div class="lk-page__inner">
            <div class="lk-page__sidebar">
              <livewire:widgets.cabinet.menu-widget :page_title="__('custom::site.my_documents')"/>
            </div>
                <livewire:customer.documents.index-page-main-livewire/>
          </div>
        </div>
      </div>
    </main>
</x-app-layout>
