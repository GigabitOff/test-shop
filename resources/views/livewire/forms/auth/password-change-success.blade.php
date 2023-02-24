<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">{{__('custom::site.message')}}<span>{{__('custom::site.on_project_domain')}}</span></h5>
        <button class="close" type="button"
                data-dismiss="modal"
                aria-label="Close"><span
                class="ico_close"></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <p class="message">
                {{__('custom::site.password_change_success')}}
            </p>
        </div>
        <div class="mt-5">
            <button class="button button-secondary button-block button-lg"
                    wire:click="restoreForm"
                    data-dismiss="modal"
                    type="button">
                {{__('custom::site.close')}}
            </button>
        </div>
    </div>
</div>
