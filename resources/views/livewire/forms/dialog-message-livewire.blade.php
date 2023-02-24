<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">
            {{$title}}
            <small>@lang('custom::site.on_project_domain')</small>
        </h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"
                wire:click="closeButtonHandler()"
                aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <p class="message">{!! $message !!}</p>
        </div>

        <div class="row g-4 mt-0">
            @foreach($buttons as $button)
                <div class="{{$this->resolveColCssClass($button['width'])}}">
                    <button class="{{$this->resolveTypeCssClass($button['type'])}} w-100"
                            wire:click="buttonHandler('{{$button['key']}}')"
                            type="button" data-bs-dismiss="modal">{{$button['text']}}</button>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        @if($startShow)
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                $('#m-dialog-message').modal('show')
            }, 1000)
        });
        @endif
    </script>
@endpush

