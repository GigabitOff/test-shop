<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.new_message')
            <span>@lang('custom::site.on_project_domain')</span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                class="ico_close"></span></button>
    </div>
    <div class="modal-body" data-focusable="message">
        <form wire:submit.prevent="submit">
            <div class="form-group">
                <div class="form-control-wrap">
                    <textarea class="form-control" type="text"
                              id="chat-message"
                              wire:model.defer="newText"
                              placeholder="@lang('custom::site.message')" name="message"
                              required></textarea><span></span>
                </div>
                @error('newText')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                @include('livewire.includes.dropdown-server-filterable', [
                    'name' => 'filterableCustomer',
                    'model' => $filterableCustomer,
                    'mode' => $filterableMode,
                    'class' => 'form-control-wrap custome-dropdown--arrow --empty',
                    'placeholder' => __('custom::site.client'),
                ])
                @error('filterableCustomer.id')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-5">
                <button class="button button-secondary button-lg button-block" type="submit">
                    @lang('custom::site.save')
                </button>
            </div>
        </form>
    </div>
</div>

@push('custom-scripts')
    <script>
        Livewire.on('eventNewChatCreated', () => {
            $('#modal-new-customer-message').modal('hide');
        });
    </script>
@endpush
