<div class="modal fade" id="modal-info-message" tabindex="-1" aria-hidden="true" data-key="{{$key}}">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('custom::site.message')}}<span>@lang('custom::site.on_project_domain')</span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        class="ico_close"></span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p class="message">{{$message}}</p>
                </div>
                <div class="mt-5">
                    <button class="button button-secondary button-block button-lg" type="button"
                            onclick="modalInfoMessageConfirm()"
                            data-dismiss="modal">{{__('custom::site.close')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
    </script>
</div>


@push('custom-scripts')
    <script>
        function modalInfoMessageConfirm() {
            const key = $('#modal-info-message').attr('data-key');
            $(document).trigger('modal-info-message_confirm', key);
        }

        jQuery(document).ready(function ($) {
            setTimeout(function () {
                $('#modal-info-message').modal('show')
            }, 1000)
        });

    </script>
@endpush
