<table>
    <thead>
    <tr>
        <th>№</th>
        <th>@lang('custom::site.sender')</th>
        <th>@lang('custom::site.message_subject')</th>
        <th data-breakpoints="xs">@lang('custom::site.last_message')</th>
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
            <td><span class="nowrap">{{$customer->name}}</span></td>
            <td><span class="nowrap">{{$chat->subject}}</span></td>
            <td>
                <div class="message">
                    <p>{!! $chat->lastMessage !!}</p>
                </div>
            </td>
            <td><span>{{formatDate($chat->updated_at)}}</span></td>
            <td class="text-end">
                <a class="button-icon ico_arrow-right"
                   href="{{route('customer.chats.show', ['chat' => $chat->id])}}"></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
