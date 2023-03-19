<table>
    <thead>
    <tr>
        <th>№</th>
        <th data-breakpoints="xs">@lang('custom::admin.sender')</th>
        <th>@lang('custom::admin.message_subject')</th>
        <th data-breakpoints="xs sm">@lang('custom::admin.last_message')</th>
        <th data-breakpoints="xs sm md">@lang('custom::admin.status_message')</th>
        <th data-breakpoints="xs sm md">@lang('custom::admin.date')</th>
    </tr>
    </thead>
    <tbody>
    @php($counter = $perPage)
    @foreach($chats as $chat)
    <tr>
                  <td><a href="{{route('admin.chats.show', ['chat' => $chat->id])}}">{{$loop->iteration}}</a></td>
                  <td> <span class="message-name">{{$chat->fio ? $chat->fio : $chat->customer->name}}</span></td>
                  <td> <span class="message-theme">{{$chat->subject}}</span></td>
                  <td><a class="message @if($chat->latestMessageShow()->first()->owner_id != auth()->guard('admin')->user()->id AND $chat->closed==0 )--new @endif @if($chat->closed==1) --closed @endif" href="{{route('admin.chats.show', ['chat' => $chat->id])}}">@if($chat->latestMessageShow()->first()->owner_id != auth()->guard('admin')->user()->id AND $chat->closed==0 )<span>Нове повідомлення</span>@endif<p>
                      {!! $chat->lastMessage !!}</p>
                    </a></td>
                  <td>
                    <div class="status-button status-button-{{ $chat->closed==1 ? 6 :10}}"
                       {{-- onclick="changeOwnerStatus({{$chat->id}});"--}}>{{$chat->closed==1 ? __('custom::admin.closed') : __('custom::admin.opened') }}</div>
                  </td>

                  <td> <span>{{formatDate($chat->latestMessage()->first()->updated_at,'d.m.Y')}}</span>
                    <span class="info-small">{{formatDate($chat->latestMessage()->first()->updated_at,'H:i')}}</span>
                </td>
                </tr>

    @endforeach
    </tbody>
</table>
