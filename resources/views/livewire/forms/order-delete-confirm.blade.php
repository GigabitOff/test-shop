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
                {{__('custom::site.info_messages.order-delete-confirm')}}
            </p>
        </div>
        <div class="form-group">
            <button class="button button-secondary button-lg button-block" type="button"
                    onclick="Livewire.emit('eventDeleteOrder', document.tm.orderDeleteId)"
                    data-dismiss="modal">
                {{__('custom::site.do_confirm')}}
            </button>
        </div>
        <div class="mt-5">
            <button class="button button-secondary button-lg button-block"
                    data-dismiss="modal" type="button">
                {{__('custom::site.cancel')}}
            </button>
        </div>
    </div>
</div>
