<div class="modal-content modal-success" id="modal-quick-purchase-content" data-mode="{{$status}}">
    <div class="modal-header">
        <h5 class="modal-title">{{__('custom::site.quick_purchase')}}<small>{{__('custom::site.on_project_domain')}}</small></h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <p class="message">
                {{__('custom::site.info_messages.quick_purchase_success')}}
            </p>
        </div>
        <div class="mt-5">
            <button class="button button-secondary button-block button-lg success-focusable"
                    onkeyup="if(event.keyCode===13){event.target.click()}"
                    data-bs-dismiss="modal"
                    type="button">
                {{__('custom::site.close')}}
            </button>
        </div>
    </div>
</div>
