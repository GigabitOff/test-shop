<div class="modal-content">
    @if($isUploadLazyContent)
        <div class="modal-header">
            <h5 class="modal-title">@lang('custom::site.payment_type_default')<span>{{__('custom::site.on_project_domain')}}</span>
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                    class="ico_close"></span></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <p class="message">
                    @lang('custom::site.info_messages.select_payment_type_default')
                </p>
            </div>

            @foreach($paymentTypes as $paymentType)
                <div class="form-group">
                    <button class="button button-secondary button-lg button-block" type="button"
                            wire:click="setPaymentType({{$paymentType->id}})"
                            data-dismiss="modal">
                        {{$paymentType->name}}
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</div>
