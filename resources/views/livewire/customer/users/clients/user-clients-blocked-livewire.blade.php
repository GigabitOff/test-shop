<div>
    <div class="form-group mt-5">

        @if(count($entrances)>0)
        <p>Останній вхід:</p>
            <ul class="ip-list">
            @foreach ($entrances as $key_entr=>$item_entr)
            @if(isset($item_entr['login_at']))
            <li><span>{{$item_entr['IP']}}</span><span>{{Carbon\Carbon::parse($item_entr['login_at'])->format('d.m.Y H:m')}}</span></li>
            @elseif(isset($item_entr['end_time']))
                    {{--<span class="value"><strong>{{Carbon\Carbon::parse($item_entr['created_at'])->format('d.m.Y')}}</strong>
                        <strong @if(Carbon\Carbon::now()->format('Y-m-d H:i:s')< $item_entr['end_time']) class="id-adress --locked" onclick="@this.unblockUserIp({{$item_entr['id']}}); " @else onclick="@this.blockUserIp({{$item_entr['id']}});" class="id-adress --unlocked" @endif >{{$item_entr['IP']}}</strong>
                    </span>--}}

                @endif
            </li>
                @endforeach
                        </ul>
        @endif
                      </div>
                      @if($this->data_collect->phone_verified_at)
                      <div class="form-group">
                        <p>Номер підтверджен {{Carbon\Carbon::parse($this->data_collect->phone_verified_at)->format('d.m.Y')}}</p>
                      </div>
                      @endif
</div>
