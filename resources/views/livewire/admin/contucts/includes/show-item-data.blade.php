@php
    if(!isset($parent_data))
    $parent_data = $item->getSelf;
@endphp
              <tr>
                <td style="display: table-cell;"  class="footable-first-visible">
                    <div class="box-brand">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$item->id])) checked="checked" @endif onclick="@this.resetDataContucts(); @this.selectDataItem('{{ $item->id }}')"  />
                        <span class="check__box"></span></label>
                        <span>
                            @if(isset($editTmpData[$item->id]['data'][session('lang')]['title']))

                        {{ $editTmpData[$item->id]['data'][session('lang')]['title'] }}
                        @else
                         @if($item->translate(session('lang'))!==null AND isset($item->translate(session('lang'))->title)){{$item->translate(session('lang'))->title}}@else{{config('app.fallback_locale') }}@endif
                            @endif
                        </span>
                    </div>
                </td>
                <td class="text-md-center" style="display: table-cell;">
                    <span>

                        {{ $item->shop->getCity->title }}
                    </span>
                </td>
                <td class="text-md-center" style="display: table-cell;">
                    <span>

                        {{ $item->name }}
                    </span>
                </td>
                {{--<td class="text-md-center" style="display: table-cell;">
                    <span>

                        {{  $item->posada }}

                    </span>
                </td>
                <td class="text-md-center" style="display: table-cell;">
                    @if(isset($item->phones))
                    @php
                        $arr_phones = json_decode($item->phones,true);

                    @endphp
                    @endif
                    @if(isset($arr_phones))

                    @foreach ($arr_phones as $key_ph=>$item_ph)
                        <span>{{$item_ph}}</span>
                        @if($key_ph+1 != count($arr_phones))
                        <br>@endif
                    @endforeach
                    @endif
                </td>
                <td class="text-md-center" style="display: table-cell;">

                    @if(isset($item->emails) )
                    @php
                        $arr_emails = json_decode($item->emails,true);

                    @endphp
                    @endif

                    @if(isset($arr_emails))

                    @foreach ($arr_emails as $key_e=>$item_e)
                        <span>{{$item_e}}</span>
                        @if($key_e+1 != count($arr_emails))
                        <br>@endif
                    @endforeach
                    @endif
                </td>--}}
                <td class="text-md-center"  style="display: table-cell;">
                <label class="check eye"><input class="check__input" type="checkbox"  onclick="@this.changeStatusData({{$item->id}},'status')" @if($item->status == 0) checked="checked" @endif/><span class="check__box"></span></label>

                </td>
                <td class="text-md-center" style="display: table-cell;">
                    <input class="form-control form-xs" type="number"  value="{{ $item->order }}" onchange="changeOrderCustom({{$item->id}}, this.value, this)">
                </td>
                <td class="text-end text-md-center footable-last-visible" style="display: table-cell;">
                    <a class="button button-small button-icon ico_edit" href="{{ route('admin.contucts.edit', $item->id)}}"></a>
                    {{--<button class="button button-small button-icon ico_edit" type="button" data-bs-target="#m-edit-subdivision" data-bs-toggle="modal" onclick="@this.setItemIdEdit('{{ $item->id }}')"></button>--}}
                </td>
              </tr>
