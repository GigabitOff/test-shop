<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">
            @lang('custom::site.uploading_from_file')
            <span>@lang('custom::site.on_project_domain')</span>
        </h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span class="ico_close"></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="custom-file">
                <input class="custom-file-input @error('file') is-invalid @enderror"
                       id="customFile" accept=".xls, .xlsx"
                       wire:model="file"
                       type="file">
                <label class="custom-file-label" for="customFile">
                    <span><span class="ico_upload"></span>@lang('custom::site.upload_excel')</span>
                </label>
                @error('file')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="block-info"><span class="ico_info"></span>
            <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text</p>
        </div>
        <hr>
        <h6>@lang('custom::site.packet_input')</h6>
        <p>@lang('custom::site.example_of_input_data'):</p>
        <ul>
            <li>0101164 1</li>
            <li>0101165 17</li>
            <li>0200045 25</li>
        </ul>
        <p>@lang('custom::site.info_messages.packet_input_description')</p>
        <div class="form-group">
            <div class="form-control-wrap">
                <textarea class="form-control"
                          wire:model.defer="manual"
                          name="manual"></textarea>
                <span></span>
            </div>
        </div>
        <div class="mt-4">
            <button class="button button-secondary button-block button-lg"
                    wire:click="addProductsToParse"
                    type="button">@lang('custom::site.add_products')</button></div>
    </div>

</div>

@push('custom-scripts')
    <script>
        document.addEventListener('bulkUploaderSelectorShow', function (){
            $('#modal-result-upload-file').modal('hide')
            $('#modal-bulk-upload-products').modal('show')
        })
    </script>
@endpush
