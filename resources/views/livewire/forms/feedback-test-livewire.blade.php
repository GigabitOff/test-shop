<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.feedback')<small>@lang('custom::site.on_project_domain')</small></h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <form  wire:submit.prevent="submit">
            @if(session()->has('chat_message_fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('chat_message_fail') }}
                </div>
            @endif

            @if(session()->has('chat_message_success'))
                <div class="alert alert-success" role="alert">
                    {{ session('chat_message_success') }}
                </div>
            @endif
            <div class="form-group">
                <input class="form-control" type="text" name="fio"
                wire:model.defer="data.fio"
                placeholder="@lang('custom::site.fio')" required>
            </div>
                <input class="form-control" type="hidden" name="fio"
                wire:model.defer="data.popup_id"
                placeholder="popup id" required>
            <div class="form-group">
                <input class="form-control" type="text" name="email"
                    wire:model.defer="data.email"
                    name="pemail-raw" placeholder="@lang('custom::site.email')" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" type="text" name="message"
                wire:model.defer="data.message"
                placeholder="@lang('custom::site.your_question')" required>
                </textarea>
            </div>
            <div class="form-group">
                <button class="button-accent button-accent w-100" type="submit"{{-- data-bs-dismiss="modal"--}}>@lang('custom::site.Send')</button>
            </div>
        </form>
    </div>
</div>
