<table>
    <thead>
    <tr>
        <th>№</th>
        <th>@lang('custom::site.sender')</th>
        <th data-breakpoints="xs">@lang('custom::site.last_message')</th>
        <th>@lang('custom::site.date')</th>
        <th data-breakpoints="xs"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($chats as $chat)
        @php
            $customerName = $chat->customer
                ? $chat->customer->name
                : "$chat->fio (" . formatPhoneNumber($chat->phone) . ')';
        @endphp
        <tr>
            <td><span>{{$loop->iteration}}</span></td>
            <td><span class="cell-user">{{$customerName}}</span></td>
            <td><span class="cell-massage">{!! $chat->lastMessage !!}</span></td>
            <td><span>{{formatDate($chat->updated_at)}}</span></td>
            <td><a class="cell-btn" href="{{route('manager.chats.show', ['chat' => $chat->id])}}"><span
                        class="ico_angel-r"></span></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
