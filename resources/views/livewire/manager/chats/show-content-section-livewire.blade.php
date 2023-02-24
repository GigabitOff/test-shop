<div class="lk-message-content" wire:poll.keep-alive.10s>
    {{--<div class="lk-message-content">--}}
    <div class="lk-message-box">
        <div class="lk-message-container">
            <div class="lk-message-chat @if($newedQty) has-newed @endif">
                @foreach($messages as $message)
                    @if($message->isSelf)
                        <div class="lk-message-item lk-message-item--outbox"
                             data-id="{{$message->id}}"
                             data-viewed="{{$message->viewed}}">
                            <div class="lk-message-item__head">
                                <div class="lk-message-item__avatar">
                                    @php($avatar = $message->ownerAvatar ?: '/assets/img/avatar-2.png')
                                    <img src="{{$avatar}}" alt="avatar">
                                </div>
                                <div class="lk-message-item__name">@lang('custom::site.you')</div>
                                <div class="lk-message-item__date">{{$message->updated_at->format('d-m-Y H:i:s')}}</div>
                            </div>
                            <div class="lk-message-item__body">{!! $message->message !!}</div>
                        </div>
                    @else
                        <div class="lk-message-item lk-message-item--inbox"
                             data-id="{{$message->id}}"
                             data-viewed="{{$message->viewed}}">
                            <div class="lk-message-item__head">
                                <div class="lk-message-item__avatar">
                                    @php($avatar = $message->ownerAvatar ?: '/assets/img/avatar-1.png')
                                    <img src="{{$avatar}}" alt="avatar">
                                </div>
                                <div class="lk-message-item__name">{{$message->ownerName}}</div>
                                <div class="lk-message-item__date">{{$message->updated_at->format('d-m-Y H:i:s')}}</div>
                            </div>
                            <div class="lk-message-item__body">{!! $message->message !!}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @if($this->isChatOpen())
        <div class="lk-message-bottom">
            <div class="lk-message-container">
                <form class="form-inline" wire:submit.prevent="submitNewMessage">
                    <div class="form-group flex-grow-1">
                        <input class="form-control" name="message"
                               wire:model.defer="newText"
                               placeholder="@lang('custom::site.new_message')">
                    </div>
                    <div class="form-group ml-2">
                        <button class="button button-primary"
                                type="submit">@lang('custom::site.do_send')</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

{{--@push('custom-styles')--}}
{{--    <style>--}}
{{--        .lk-message-chat.has-newed {--}}
{{--            border-bottom: 2px solid #B72023;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endpush--}}

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {

            $('.lk-message-content .lk-message-chat')
                .on('scroll', function (e) {
                    setMessagesToViewed();
                })

            function setMessagesToViewed() {
                const items = getVisibleUnViewed();
                if (items.length) {
                @this.setViewed(items);
                }
            }

            // Считаем количество сообщений менеджеров, которые не прочитаны
            function getVisibleUnViewed() {
                const holder = $('.lk-message-content .lk-message-chat').get(0);
                return $('.lk-message-content .lk-message-item--inbox[data-viewed="0"]')
                    .map((i, el) => {
                        return document.tm.isScrollableVisible(el, holder)
                            ? $(el).data('id')
                            : 0
                    }).toArray().filter(e => e > 0);
            }

            function scrollToFirstUnViewed() {
                const holder = $('.lk-message-content .lk-message-chat').get(0);
                const $first = $('.lk-message-content .lk-message-item--inbox[data-viewed="0"]').eq(0)
                const last = $('.lk-message-content .lk-message-item').last().get(0)

                const el = $first.length ? $first.get(0) : last;

                document.tm.scrollToElement(el, holder)
            }

            // First run after load page
            scrollToFirstUnViewed()
            setMessagesToViewed()

            window.addEventListener('checkUnViewedMessages', ()=>setMessagesToViewed());

            //# sourceURL=manager_chat_show-content-section.js
        });
    </script>
@endpush
