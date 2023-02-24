<div class="modal-content">
    @if($isUploadLazyContent)
        <div class="modal-header">
            <h5 class="modal-title">@lang('custom::site.counterparties')<span>{{__('custom::site.on_project_domain')}}</span>
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                    class="ico_close"></span></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <p class="message">
                    @lang('custom::site.info_messages.counterparty_list_prompt')
                </p>
            </div>

            @foreach($counterparties as $counterparty)
                <div class="form-group">
                    <button class="button button-secondary button-lg button-block" type="button"
                            onclick="document.lazyWireModal.uploadAndShow('modal-counterparty-edit', {force:true, payload:{'customer_id':{{$customer->id}},'counterparty_id':{{$counterparty->id}}}})"
                            data-dismiss="modal">
                        {{$counterparty->name}}
                    </button>
                </div>
            @endforeach
            <br/>
            <button class="button button-secondary button-lg button-block" type="button"
                    onclick="document.lazyWireModal.uploadAndShow('modal-counterparty-create', {force:true, payload:{'customer_id': {{$customer->id}}}})"
                    data-dismiss="modal">
                @lang('custom::site.counterparty_add')
            </button>
        </div>
    @endif
</div>
