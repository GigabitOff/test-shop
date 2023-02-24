<div class="modal-content">
    @if($isUploadLazyContent)
        <div class="modal-header">
            <h5 class="modal-title">@lang('custom::site.return_product_acts')
                <span>@lang('custom::site.on_project_domain')</span>
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span class="ico_close"></span>
            </button>
        </div>
        <div class="modal-body">
            <ul class="files-list">
                @foreach($records as $document)
                    <li class="files-list__item">
                        <a class="files-list__link" href="{{$document->fileUrl}}" target="_blank">
                            <span class="files-list__title">{{$document->filename}}</span>
                            <span class="ico_downloads"></span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
