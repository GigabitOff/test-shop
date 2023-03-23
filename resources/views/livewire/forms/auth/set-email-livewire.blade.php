<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.enter_email')<small>@lang('custom::site.on_project_domain')</small></h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="submit" autocomplete="off">
            <input type="hidden" wire:model="user_id">
            <input type="hidden" wire:model="product_id">
            <div class="form-group">
                <p>@lang('custom::site.enter_email_tooltips')</p>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" placeholder="E-mail" wire:model="email">
            </div>
            <div class="form-group">
                <button class="button-accent w-100" type="submit">@lang('custom::site.Confirm')</button>
            </div>
        </form>
    </div>
</div>
