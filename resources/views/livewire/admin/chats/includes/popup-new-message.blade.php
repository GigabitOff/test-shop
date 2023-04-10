<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::admin.new_message_to_manager'):
    </div>
    <div class="modal-body" data-focusable="message">
        <form wire:submit.prevent="submitPopup">
            <div class="form-group @error('data.owner_id') is-invalid @enderror"">
                @include('livewire.admin.includes.select-data-arrow',[
            'select_data_input'=>(isset($select_data['owner_id']) ? $select_data['owner_id']: null),
            'select_data_array'=>(isset($select_array['owner_id']) ? $select_array['owner_id'] : null),
            'placeholder'=>__('custom::admin.User message'),
            'index'=>'owner_id',
            'show_name'=>true
        ])
            @error('data.owner_id')
            <div class="is-invalid">{{$message}}</div>
            @enderror
            </div>
           {{-- <div class="form-group">
                <div class="drop --select --arrow"><span class="drop-clear"></span><input class="form-control drop-input drop-input-hide" type="text" autocomplete="off" placeholder="Адресант" /><button class="form-control drop-button" type="button">Адресант</button>
                  <div class="drop-box">
                    <div class="drop-overflow">
                      <ul class="drop-list">
                        <li class="drop-list-item">Адресант 1</li>
                        <li class="drop-list-item">Адресант 2</li>
                        <li class="drop-list-item">Адресант 3</li>
                        <li class="drop-list-item">Адресант 4</li>
                        <li class="drop-list-item">Адресант 5</li>
                        <li class="drop-list-item">Адресант 6</li>
                        <li class="drop-list-item">Адресант 7</li>
                        <li class="drop-list-item">Адресант 8</li>
                        <li class="drop-list-item">Адресант 9</li>
                        <li class="drop-list-item">Адресант 10</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>--}}
            <div class="form-group">
                <input type="text" class="form-control" placeholder="@lang('custom::admin.subject')" wire:model.defer="newSubject">
            </div>
            <div class="form-group">
                <div class="form-control-wrap">
                    <textarea class="form-control @error('newText') is-invalid @enderror" type="text"
                              wire:model.defer="newText"
                              placeholder="@lang('custom::admin.message')" name="message" required></textarea><span></span>
                </div>
                @error('newText')
                <div class="is-invalid">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <button class="button w-100" type="submit">
                    @lang('custom::admin.Send')
                </button>
            </div>

        </form>
    </div>
</div>

@push('custom-scripts')
    <script>
        Livewire.on('eventNewChatCreated', () => {
            $('#m-new-message').modal('hide');
        });
    </script>
@endpush
