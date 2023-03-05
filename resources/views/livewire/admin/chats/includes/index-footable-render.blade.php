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
                  <td> <span class="nowrap">{{$chat->fio}}</span></td>
                  <td> <span class="nowrap">{{$chat->subject}}</span></td>
                  <td><a class="message --new" href="{{route('admin.chats.show', ['chat' => $chat->id])}}">@if($chat->answer_manager==0)<span>Нове повідомлення</span>@endif
                      {!! $chat->lastMessage !!}
                    </a></td>
                  <td>
                    <div class="status-button status-button-{{$chat->closed==1 ? 6 :1}}"
                        onclick="changeOwnerStatus({{$chat->id}});">{{$chat->closed==1 ? __('custom::admin.closed') : __('custom::admin.opened') }}</div>
                  </td>
                  <td> <span>{{formatDate($chat->updated_at,'d.m.Y')}}</span>
                    <span class="info-small">{{formatDate($chat->updated_at,'h:m')}}</span>
                </td>
                </tr>

    @endforeach
    </tbody>
</table>
