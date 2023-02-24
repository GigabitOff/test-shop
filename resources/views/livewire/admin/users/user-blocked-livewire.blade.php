    <div>
    @if($data_collect) 

<div class="user-info">
    <ul class="list-info">
        <li><span>@lang('custom::admin.Last entrance')</span>
            <span class="value">
                @if($data_collect->entrances !== null AND count($data_collect->entrances)>0)
                <strong>{{ \Carbon\Carbon::parse($data_collect->entrances[0]->login_at)->format('d.m.Y') }}</strong>
                <strong>{{$data_collect->entrances[0]->IP}}</strong>
                @else
                <strong>@lang('custom::admin.No data')</strong>
                @endif
            </span>
        </li>
    </ul>
    @if($entrances !== null)
    <div class="scroll-box">
        <ul class="list-info">
            <li>
                    <span>@lang('custom::admin.History')</span>
                </li>
                @foreach ($entrances as $key_entr=>$item_entr)
                @if(isset($item_entr['login_at']))
                <li>
                    <span class="value"><strong>{{Carbon\Carbon::parse($item_entr['login_at'])->format('d.m.Y')}}</strong>
                        <strong >{{$item_entr['IP']}}</strong>
                    </span>
                </li>
                @elseif(isset($item_entr['end_time']))
                <li>
                    <span class="value"><strong>{{Carbon\Carbon::parse($item_entr['created_at'])->format('d.m.Y')}}</strong>
                        <strong @if(Carbon\Carbon::now()->format('Y-m-d H:i:s')< $item_entr['end_time']) class="id-adress --locked" onclick="@this.unblockUserIp({{$item_entr['id']}}); " @else onclick="@this.blockUserIp({{$item_entr['id']}});" class="id-adress --unlocked" @endif >{{$item_entr['IP']}}</strong>
                    </span>
                </li>
                @endif
                @endforeach
                    {{--@if($BlockIp)
                    @foreach ($BlockIp as $key_b=>$item_b)
                    <li>
                        @if($key_b == 0)<span>@lang('custom::admin.blocked')</span>@endif
                        <span class="value"><strong>{{Carbon\Carbon::parse($item_b->created_at)->format('d.m.Y')}} до {{Carbon\Carbon::parse($item_b->end_time)->format('d.m.Y H:i')}}</strong>
                            <strong>{{$item_b->ip}}</strong></span>
                    </li>

                    @endforeach
                    @endif--}}
            </ul>
        </div>
        @endif

</div>
<div class="user-info-btns">
        <div class="row g-2 mt-4">
        <div class="col-6">
            <button class="button w-100" type="button" @if($data['blocked_ip_id'] == 1) onclick="@this.unblockUser({{$data_collect['id']}})" @else onclick="@this.blockUser({{$data_collect['id']}})" @endif>{{ $data['blocked_ip_id'] == 1 ? __('custom::admin.Un Bloke user') : __('custom::admin.Bloke user') }}</button>
        </div>
        <div class="col-6">
            @if($data_collect->deleted_at)
            <button class="button button-secondary w-100" type="button" wire:click="removeUser({{ $data_collect->id }})"><i class="ico_trash"></i><span>@lang('custom::admin.Restore user')</span>
            </button>
            @else
            <button class="button button-secondary w-100" type="button"  wire:click="removeUser({{ $data_collect->id }})"><i class="ico_trash"></i><span>@lang('custom::admin.Dell user')</span>
            </button>
            @endif
        </div>
    </div>
    </div>

    @endif
    </div>
