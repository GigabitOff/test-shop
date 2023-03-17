<div class="shop-action-item --cart" wire:poll.keep-alive="checkChatsMessage">
<a class="shop-action-item__link"

 @auth()

       @if(auth()->user()->isCustomer)
       href="{{ route('customer.cart')}}"

       @elseif(auth()->user()->isManager)
       href="{{ route('manager.cart')}}"

       @else
       href="javascript:void(0);"

       @endif

       @endauth

       @guest()
        href="#" data-bs-toggle="modal" data-bs-target="#m-login" data-bs-dismiss="modal"
       @endguest >
    <div class="shop-action-item__icon ico_cart"></div>
    <div class="shop-action-item__col">{{$quantity}}</div>
  </a>
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

            @this.emit('reloadChatsIndex');
        });

    </script>
</div>
