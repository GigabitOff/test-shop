<table>
    <thead>
    <tr>
        <th>№</th>
        <th>@lang('custom::site.sender')</th>
        <th>@lang('custom::site.message_subject')</th>
        <th data-breakpoints="xs">@lang('custom::site.last_message')</th>
        <th data-breakpoints="xs">@lang('custom::site.status')</th>
        <th data-breakpoints="xs">@lang('custom::site.date')</th>
        <th data-breakpoints="xs"></th>
    </tr>
    </thead>
    <tbody>
    @php($counter = $this->getPerPageCounter())
    @foreach($chats as $chat)
        <tr>
            <td><a href="{{route('customer.chats.show', ['chat' => $chat->id])}}">{{$counter + $loop->iteration}}</a>
            </td>
            <td>
                <a href="{{route('customer.chats.show', ['chat' => $chat->id])}}">
                <span class="nowrap">{{$customer->name}}</span>
                </a>
            </td>
            <td>
                <a href="{{route('customer.chats.show', ['chat' => $chat->id])}}">
                <span class="nowrap">{{$chat->subject}}</span>
                </a>
            </td>
            <td>
                <a href="{{route('customer.chats.show', ['chat' => $chat->id])}}">

                <div class="message @if($chat->latestMessage()->first()->owner_id != $chat->customer_id) @endif @if($chat->closed==1)--closed @endif">
                    @if($chat->latestMessage()->first()->owner_id != $chat->customer_id)
                    <span class="new-messge-bage">NEW</span>
                    @endif
                    <p>{!! $chat->lastMessage !!}</p>
                </div>
                </a>
            </td>
            <td>
                <a href="{{route('customer.chats.show', ['chat' => $chat->id])}}">
                <div class="status --status-{{ $chat->closed==1 ? 1 : 0 }}">
                    <span class="circle"></span>
                    <span>{{ ($chat->closed==1) ? __('custom::site.chat_open') : __('custom::site.chat_close') }}</span>
                </div>
            </a>

            </td>
            <td>
                <span class="@if($chat->closed==1)--closed @endif">{{formatDate($chat->updated_at)}}</span>
                <span class="small">{{formatDate($chat->updated_at,'H:i')}}</span>
            </td>
            <td class="text-end">
                <a class="button-icon ico_arrow-right"
                   href="{{route('customer.chats.show', ['chat' => $chat->id])}}"></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
