<div>

    {{-- Livewire Item show --}}

    @include('livewire.admin.contucts.includes.show-item')

   {{-- @if(!isset($hide_butt))
    <div>
        <button class="button button-secondary" type="button" data-bs-target="#m-add-subdivision" data-bs-toggle="modal">
        @lang('custom::admin.Add subsection')</button></div>
    @endif --}}
    <div >

    @include('livewire.admin.contucts.popups.popup-contuct-create')

    @include('livewire.admin.contucts.popups.popup-contuct-edit')
    </div>

 <script>
     window.addEventListener('changeDataContuctShop', () => {
          //@this.resetDataContucts();
          setTimeout(() => {
           $('.modal-backdrop,  .modal').hide();
              @this.emit('resetAllDataAlert');
          }, 800);

         //  alert();
         });

    </script>
</div>
