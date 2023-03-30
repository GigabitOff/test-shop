<div class="modal fade" id="m-dialog-message-livewire" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{!! $title !!}</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"
                        wire:click="closeButtonHandler()"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p >
                    {!! $message !!}
                </p>
                <div class="row g-4 mt-0">
                    @foreach($buttons as $button)
                        <div class="{{$this->resolveColCssClass($button['width'])}}">
                            <button class="button {{$this->resolveTypeCssClass($button['type'])}} w-100"
                                    @if(!empty($button['actions']))
                                        wire:click="buttonHandler('{{$button['key']}}')"
                                    @endif
                                    type="button" data-bs-dismiss="modal">{{$button['text']}}</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
