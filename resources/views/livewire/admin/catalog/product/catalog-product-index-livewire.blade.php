<div>
    <div class="container-large">
        {{-- Catalog prodact admin index livewire. --}}
        @include('livewire.admin.catalog.product.includes.filters-product')
        <div wire:ignore.self>
            @include('livewire.admin.catalog.product.includes.show-item')
        </div>
    </div>
</div>
