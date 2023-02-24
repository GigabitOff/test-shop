<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">{{__('custom::site.message')}}<span>{{__('custom::site.on_project_domain')}}</span>
        </h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                class="ico_close"></span></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <p class="message">
                {{__('custom::site.info_messages.quick_purchase_login_prompt')}}
            </p>
        </div>
        <div class="form-group">
            <button class="button button-secondary button-lg button-block" type="button"
                    data-dismiss="modal" data-toggle="modal" data-target="#modal-login">{{__('custom::site.to_login')}} \
                {{__('custom::site.to_register')}}
            </button>
        </div>
        <div class="mt-1">
            <button class="button button-secondary button-lg button-block"
                    wire:click="noNeedRegistration"
                    type="button">
                {{__('custom::site.continue_without_register')}}
            </button>
        </div>
    </div>
</div>
