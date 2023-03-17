<div class="lk-page__content" wire:poll.keep-alive.1000s>
    <div class="lk-page__messages">
        <div class="lk-page__messages-list">
            <div class="lk-page__head">
                <div class="lk-page__back">
                    <a class="button-back" href="{{route('customer.chats.index')}}">
                        @lang('custom::site.return')
                        <i class="ico_angle-left"></i>
                    </a>
                </div>
                <h1 class="lk-page__title">{{$subject}}</h1>
                <div class="lk-page__empty"></div>
            </div>
            <div class="messages-box">
                <div class="messages-list-box">
                    <ul class="messages-list">
                        @foreach($messageGroups as $group)
                            @php
                                $first = $group->first();
                                $self = $first->owner->id === $customer->id;
                            @endphp
                            <li class="messages-list__item @if($self) --user @else --maneger @endif">
                                <div class="messages-list__item-avatar">
                                    @php
                                        $fallback = $self ? 'avatar-1.svg' : 'avatar-2.svg';
                                        $avatar = $first->owner->correctAvatar() ?: "/assets/img/{$fallback}";
                                    @endphp
                                    <img src="{{$avatar}}" alt="avatar">
                                </div>
                                <div class="messages-list__item-content">
                                    @foreach($group as $message)
                                        <div class="messages-list__item-text"
                                             data-id="{{$message->id}}"
                                             data-viewed="{{$message->viewed}}">
                                            {!! $message->message !!}
                                        </div>
                                    @endforeach
                                    <div class="messages-list__item-info">
                                        {{formatDateTime($message->updated_at)}}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if($this->isChatOpen())
                    <div class="messages-form-box">
                        <textarea class="form-control"
                                  wire:model.lazy="newText"
                                  placeholder="@lang('custom::site.new_message')"></textarea>
                        <button class="button-accent"
                                wire:click="submitNewMessage"
                                type="button">@lang('custom::site.to_send')</button>
                    </div>
                @endif

            </div>
        </div>
        <div class="lk-page__messages-banner">
            <div class="messages-banner">
                <div class="messages-banner__bg" style="background-image:url(/assets/img/messages-banner.jpg)">
                    <div class="messages-banner__content">
                        <div class="messages-banner__title">Modern Props от Leather Swivel Armchair ??</div>
                        <div class="messages-banner__btn"><a class="button-outline" href="#!">Детальніше ??</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

            $('.lk-page__messages-list .messages-list-box')
                .on('scroll', function (e) {
                    setMessagesToViewed();
                })

            function setMessagesToViewed() {
                const items = getVisibleUnViewed();
                if (items.length) {
                    @this.
                    setViewed(items);
                }
            }

            // Считаем количество сообщений менеджеров, которые не прочитаны
            function getVisibleUnViewed() {
                const holder = $('.lk-page__messages-list .messages-list-box').get(0);
                return $('.lk-page__messages-list .messages-list__item-text[data-viewed="0"]')
                    .map((i, el) => {
                        return document.tm.isScrollableVisible(el, holder)
                            ? $(el).data('id')
                            : 0
                    }).toArray().filter(e => e > 0);
            }

            function scrollToFirstUnViewed() {
                const holder = $('.lk-page__messages-list .messages-list-box').get(0);
                const $first = $('.lk-page__messages-list .messages-list__item-text[data-viewed="0"]').eq(0)
                const last = $('.lk-page__messages-list .messages-list__item-text').last().get(0)

                const el = $first.length ? $first.get(0) : last;

                document.tm.scrollToElement(el, holder)
            }

            // First run after load page
            scrollToFirstUnViewed()
            setMessagesToViewed()

            window.addEventListener('checkUnViewedMessages', () => setMessagesToViewed());


            //# sourceURL=customer_chat_show-content-section.js


        });

        const messageTextarea = document.querySelector('.messages-form-box textarea.form-control');
            messageTextarea.addEventListener('keypress', function(e){
                if (e.key === 'Enter' && messageTextarea.value.trim() !== '') {
                e.preventDefault();

                @this.submitNewMessage();
                }
            });

    </script>
@endpush
