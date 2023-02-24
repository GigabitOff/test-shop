<div class="custom-file">
    <input class="file-input custom-file-input" id="fileEXCEL"
           accept=".xls, .xlsx"
           type="file">
    <label class="button button-primary" for="fileEXCEL">@lang('custom::site.upload_excel')</label>
    @error('file')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror

    @if($diff)
    <div class="invalid-feedback">@lang('custom::site.erroneous_sku'): {{implode(', ', $diff)}}</div>
    @endif

</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {

            $("#fileEXCEL").change(function () {
                let file = this.files[0]
                clearProgress();
                $('#modal-upload-exel').modal('show');
                // Upload a file:
                @this.upload('file', file, (uploadedFilename) => {
                    // Success callback.
                    const $err = $("#fileEXCEL").parent().find('.invalid-feedback');
                    if($err.length){
                        $('#modal-upload-exel .upload-box').append($err.get(0));
                        $('#modal-upload-exel .invalid-feedback').show();
                    } else {
                        setProgressPercent(100);
                        setTimeout(function () {
                            hideProgress();
                        }, 2000);
                    }

                }, () => {
                    // Error callback.
                    hideProgress()
                }, (event) => {
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    setProgressPercent(50);
                });

            });

            function hideProgress(){
                $('#modal-upload-exel').modal('hide');
                clearProgress();
            }

            function clearProgress(){
                $('#modal-upload-exel .invalid-feedback').remove();
                setProgressPercent(0);
            }

            function setProgressPercent(value){
                $('#modal-upload-exel .progress-bar')
                    .css("width", value + "%")
                    .text(value + "%");
            }

        })
    </script>
@endpush
