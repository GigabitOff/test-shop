<div>
    {{-- contucts livewire -- Акціїї управління --}}
    <div class="container">
        @include('livewire.admin.includes.head_button',['route'=>'admin.contucts.create','lang'=>'admin.Add'])
    </div>
    <div class="container">
        @include('livewire.admin.includes.search')
    </div>
    <div class="container">
        @include('livewire.admin.contucts.includes.show-item')
    </div>
</div>
