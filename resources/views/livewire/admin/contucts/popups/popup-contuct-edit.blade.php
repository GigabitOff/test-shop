<div class="modal fade" id="m-edit-subdivision" tabindex="-1" aria-hidden="true" wire:ignore.self>
<div class="modal-dialog modal-dialog-centered">
         @if($item_id)
    <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">@lang('custom::admin.Editing a subsection')</h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

              @include('livewire.admin.contucts.includes.popup-add-edit')


          </div>

        </div>
        @endif
</div>
</div>
