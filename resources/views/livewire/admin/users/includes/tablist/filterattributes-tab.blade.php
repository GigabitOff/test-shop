@if(isset($item_id))
<div wire:ignore>
    @livewire('admin.catalog.filters.catalog-filter-attribute-livewire', ['item_id' => $item_id], key(time().'-filter-attribute-livewire'))
</div>
@endif
