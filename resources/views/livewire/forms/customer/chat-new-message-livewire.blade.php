        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @lang('custom::site.new_message')
                    <small>@lang('custom::site.on_project_domain')</small>
                </h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <div class="form-group">
                        <textarea class="form-control"
                                  wire:model.defer="newText"
                                  placeholder="@lang('custom::site.message')"></textarea>
                        @error('newText')
                        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="button-accent button-accent w-100"
                                type="submit">@lang('custom::site.to_send')</button>
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
