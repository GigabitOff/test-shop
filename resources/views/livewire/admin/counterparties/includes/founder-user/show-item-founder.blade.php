
    <table class="js-table js-table_new footable" >
            <thead>
              <tr class="footable-header">
                <th style="display: table-cell;" class="footable-first-visible">
                    <div class="d-flex align-item_fs-center">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked @endif onclick="@this.selectDataitemCiunterparty('all','{{$key_item_f}}',true)" />
                        <span class="check__box"></span>
                    </label>
                    <span>@lang('custom::admin.Name')</span></div>
                </th>
                <th  class="text-md-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Phone')</th>

                <th  style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.Jobs')</th>
                <th  style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.E-mail')</th>
                <th class="text-end text-xl-center w-1 footable-last-visible"></th>
              </tr>
            </thead>
            <tbody>
                @php
                    $L=1;
                @endphp
            @if(isset($founder_data) AND count($founder_data)>0)
                @foreach ($founder_data as $key_f=>$item_f)

                    <tr>
                <td style="display: table-cell;"  class="footable-first-visible">
                    <label class="check">
                        <input class="check__input" type="checkbox" @if(isset($selectedData[$key_f])) checked="checked" @endif onclick="@this.selectDataitemCiunterparty('{{ $key_f }}','{{$key_item_f}}')"  />
                        <span class="check__box"></span></label>
                        <span>{{ isset($item_f['name']) ? $item_f['name'] : '' }}</span>
                </td>
                <td class="text-md-center" style="display: table-cell;"><span>{{ isset($item_f['phone']) ? clearPhoneNumber($item_f['phone']) : '' }}</span></td>
                <td class="text-md-center" style="display: table-cell;"><span>{{ isset($item_f['job']) ? $item_f['job'] : '' }}</span></td>
                <td class="text-md-center" style="display: table-cell;"><span>{{ isset($item_f['email']) ? $item_f['email'] : '' }}</span></td>
                <td class="text-end text-md-center footable-last-visible" style="display: table-cell;">
                    <button class="button button-small button-icon ico_edit" type="button" onclick="@this.editDataItem({{ $key_f }},'{{ $key_item_f }}')" data-bs-target="#m-add-edit-founder" data-bs-toggle="modal"></button>
                </td>
              </tr>
                    @php
                        $L++;
                    @endphp
                @endforeach
            @endif



             @if($L == 1)
        <tr>
                <td class="text-center" style="display: table-cell;" colspan="5">
                    @lang('custom::admin.No data available')
                </td>
            </tr>
    @endif
            </tbody>
          </table>

