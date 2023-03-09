<div class="container-large" wire:poll.keep-alive.1000s>
    <a class="page-back" href="{{ route('admin.chats.index')}}"><button class="button button-accent button-small button-icon ico_arrow-left" type="button"></button>@lang('custom::admin.Return to list')</a>
    <div class="message-head">
            <h4 class="text-center text-lg-start">№ {{ $chat->id}} / {{isset($subject) ? $subject : $chat->subject }}</h4>
            @if($this->isChatOpen())
          <a class="button" href="#" onclick="@this.setCloseItem({{$chat->id}});">@lang('custom::admin.Close dialog')</a>
        @endif
          </div>

          <div class="mt-3">
            <div class="messages-box">
              <div class="messages-list-box">

                    <ul class="messages-list">

                        @foreach($messageGroups as $group)
                            @php

                                $self = null;
                                $first = $group->first();
                                if(!empty($customer) AND $first->owner)
                                $self = $first->owner->id === $customer->id;
                            @endphp
                            <li class="messages-list__item @if($self) --user @else --maneger @endif">
                                <div class="messages-list__item-avatar">
                                    @php
                                        $fallback = $self ? 'avatar-1.svg' : 'avatar-2.svg';
                                        $avatar = "/assets/img/{$fallback}";

                                        if($first->owner)
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
                                        <div class="messages-list__item-info">

                                        {{formatDateTime($message->created_at,'d.m.Y H:i')}}
                                         </div>
                                    @endforeach

                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>


            </div>
            @if($this->isChatOpen())
                    <div class="messages-form-box">
                        <textarea class="form-control"
                                  wire:model.defer="newText"
                                  placeholder="@lang('custom::admin.new_message')"></textarea>
                        <button class="button"
                                wire:click="submitNewMessage"
                                type="button">@lang('custom::admin.to_send')</button>
                    </div>
                @endif
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

            $('.messages-list-box')
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
                const holder = $('.messages-list-box').get(0);
                return $('.messages-list__item-text[data-viewed="0"]')
                    .map((i, el) => {
                        return document.tm.isScrollableVisible(el, holder)
                            ? $(el).data('id')
                            : 0
                    }).toArray().filter(e => e > 0);
            }

            function scrollToFirstUnViewed() {
                const holder = $('.messages-list-box').get(0);
                const $first = $('.messages-list__item-text[data-viewed="0"]').eq(0)
                const last = $('.messages-list__item-text').last().get(0)

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
