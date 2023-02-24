<div class="modal fade" id="modal-prompt" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('custom::site.message')<span>@lang('custom::site.on site')</span>
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        class="ico_close"></span></button>
            </div>
            <div class="modal-body mt-3">
                <div class="row">
                    <div class="col-12">
                        <p class="prompt-message"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button class="button button-secondary button-block button-lg" type="button"
                                onclick="document.modalPrompt.clickConfirm()"
                                data-dismiss="modal">@lang('custom::site.yes')
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="button button-secondary button-block button-lg" type="button"
                                onclick="document.modalPrompt.clickReject()"
                                data-dismiss="modal">@lang('custom::site.no')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        /**
         * To dispatch event from js
         * document.dispatchEvent( new CustomEvent('showModalPrompt', {detail: {prompt:"Any Object Here"}}));
         *
         */
        document.modalPrompt = {
            detail: {
                prompt: '',
                emitYes: '',
                emitNo: '',
                payload: ''
            },
            init: () => {
                document.addEventListener('showModalPrompt', (e) => {
                    this.detail = {
                        prompt: e.detail.prompt || '',
                        emitYes: e.detail.emitYes || '',
                        emitNo: e.detail.emitNo || '',
                        payload: e.detail.payload || ''
                    }

                    if(this.detail.prompt){
                        $('#modal-prompt .prompt-message').html(this.detail.prompt)
                        $('#modal-prompt').modal('show')
                    } else {
                        console.error('Prompt is empty')
                    }
                })
            },
            clickConfirm: () => {
                if (this.detail.emitYes){
                    Livewire.emit(this.detail.emitYes, this.detail.payload)
                }
            },
            clickReject: () => {
                if (this.detail.emitNo){
                    Livewire.emit(this.detail.emitNo, this.detail.payload)
                }
            }
        }
        document.modalPrompt.init()

    </script>
@endpush
