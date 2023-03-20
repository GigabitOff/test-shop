<div class="lk-page__content">
    <h1 class="lk-page__title">@lang('custom::site.message')</h1>
    <div class="lk-page__action">
        <div></div>
        <div class="lk-page__action-btns">
            <a class="button-outline" href="#m-new-message"
               data-bs-toggle="modal">@lang('custom::site.write_message')</a></div>
    </div>
    <div class="lk-page__table" wire:poll.keep-alive="checkChatsMessage">
        <div id="footable-content"
             class="footable-content @if($this->isNeedRevalidateFootable()) footable-revalidate @endif"
             style="display: none">
            @include('livewire.customer.chats.index-footable-render')
        </div>
        <table wire:ignore id="footable-holder"
               class="ftable"
               data-empty="@lang('custom::site.data_is_absent')"
               data-show-toggle="true" data-toggle-column="last">
        </table>

    </div>
    <div class="lk-page__table-after">
        <div></div>
        @include('livewire.includes.per-page-footable', ['paginator' => $chats])
    </div>
    <script>
     /*   function startAudioMessagePlayFirst() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            // запрашиваем доступ к устройству для записи звука
            navigator.mediaDevices.getUserMedia({audio: false, video: false})
                .then(function(stream) {
                // доступ к устройству получен
                // создаем AudioContext и источник аудио
                var audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                var source = audioCtx.createMediaStreamSource(stream);
                // создаем динамик и подключаем к источнику аудио
                var speaker = audioCtx.destination;
                source.connect(speaker);
                })
                .catch(function(err) {
                // доступ к устройству не получен
                //console.log('Доступ к устройству для записи звука запрещен: ' + err);
                });

            }

                startAudioMessage();

        }

        function startAudioMessage() {

            var audio = new Audio('/audio/newMessage.mp3');
            audio.play();

        }*/



        window.addEventListener('startAudioMessage', () => {

          //  startAudioMessage();

            //@this.emit('reloadChatsIndex');
            @this.reloadChatsIndex();
        });

    </script>
</div>


@push('show-data')
    <x-modal-form id="m-new-message">
        <livewire:forms.customer.chat-new-message-livewire/>
    </x-modal-form>
@endpush
