<div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">@lang('custom::admin.settings.Add number')</h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" onclick="@this.resetAllInputData()"></button>
          </div>
          <div class="modal-body">
        @if(isset($success))
        <script>
            $('#m-add-phone').hide();
            $('.modal-backdrop').hide();
        </script>
        @else
        <form wire:submit.prevent="createDataSend('phones_top','phone')">

             <div class="form-group">
                <input class="js-phone form-control" type="text" placeholder="@lang('custom::admin.settings.Phone')" wire:ignore  oninput="@this.set('data_phone.value',this.value)"  wire:model.lazy="data_phone.value">
            </div>
              <div class="form-group" wire:ignore.self>
                  @include('livewire.admin.includes.select-data-arrow',['select_data_input'=>(isset($select_data['category_phone']) ? $select_data['category_phone']: null),'select_data_array'=>$category_phone_all, 'placeholder'=>__('custom::admin.settings.Category phone'),'index'=>'category_phone'])
                  @error('category_phone')
                  <div class="error">
                    {{ $message }}
                  </div>
                  @endif
              </div>
              <div class="form-group">
                  @include('livewire.admin.includes.select-data-arrow',['select_data_input'=>(isset($select_data['status_phone']) ? $select_data['status_phone']: null),'select_data_array'=>\App\Models\Setting::PHONES_STATUS, 'placeholder'=>__('custom::admin.settings.Status phone'),'index'=>'status_phone'])
                  @error('status_phone')
                  <div class="error">
                    {{ $message }}
                    Спочатку створити в контактах.
                  </div>
                  @endif

              </div>

              <div class="form-group">
                <input class="form-control" type="text" placeholder="@lang('custom::admin.settings.Order')"></div>
              <div class="mt-4"><button class="button w-100" type="submit">@lang('custom::admin.Add')</button></div>
          </div>
        </form>
        @endif
        </div>
<script>
    document.addEventListener('click', function () {
        $('.js-phone').mask("+38(999) 999-99-99");
    });
</script>
</div>

