<div>
    {{-- Popup Alert Messages --}}
    @if($show === true)

        <div class="modal modal-message fade"
             @if($this->isTypeSuccess()) id="m-success" @else id="m-error" @endif
             tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><i class="ico_{{$type}}"></i><span>{!! $text !!}</span></p>
                    </div>
                </div>
            </div>
        </div>


    @endif
    <script>
        window.addEventListener('showPopup', (e) => {

            const show = e.detail.show || true;
            const closeTimeout = e.detail.closeTimeout || 0;
            const modalId = e.detail.modalId || 'm-success';

            $('.modal').modal('hide');
            setTimeout(() => {

                if (show) {
                    $('#' + modalId).modal('show');
                }

            }, 20);

            if (closeTimeout) {
                setTimeout(() => {
                    $('.modal').modal('hide');
                    if (show) {
                        $('#' + modalId).modal('hide');
                    }
                }, closeTimeout);
            }
        });

        //# sourceURL=widget-popup-alert-message.js
    </script>


</div>
