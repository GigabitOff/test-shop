<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.notification')<span>@lang('custom::site.on_project_domain')</span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                class="ico_close"></span></button>
    </div>
    <div class="modal-body">
        <form>
            @if($notification)
                <div class="overflow-box">
                    <div class="js-copy-trading-point-fields">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <div>
                                    {{$notification->message}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                @if($this->hasTwoButtons())
                                    <div class="col-6">
                                        <button class="button button-secondary button-block button-lg" type="button"
                                                wire:click="onUserAction(true)"
                                                data-dismiss="modal">{{$buttonYes}}</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="button button-secondary button-block button-lg" type="button"
                                                wire:click="onUserAction(false)"
                                                data-dismiss="modal">{{$buttonNo}}</button>
                                    </div>
                                @else
                                    <div class="col-12">
                                        <button class="button button-secondary button-block button-lg" type="button"
                                                wire:click="onUserAction(true)"
                                                data-dismiss="modal">{{$buttonYes}}</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        setTimeout(function () {
                            $('#modal-user-notification').modal('show')
                        }, 3000)
                    });
                </script>
            @endif
        </form>
    </div>
</div>

