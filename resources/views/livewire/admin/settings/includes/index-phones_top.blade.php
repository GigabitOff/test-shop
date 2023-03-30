<div >
    <div class="table-before-btn --small" >
        <button style="margin-right: -4px;" class="button button-accent button-small button-icon ico_plus" type="button" data-bs-target="#m-add-phone" data-bs-toggle="modal" onclick="@this.startAddPhone()"></button></div>
    <table class="js-table js-table_new footable table-td-small" >
        <thead>
            <tr class="footable-header">
                <th class="footable-first-visible" style="display: table-cell;">@lang('custom::admin.settings.Category')</th>
                <th style="display: table-cell;">@lang('custom::admin.settings.Number')</th>
                <th style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.settings.Status')</th>
                <th class="text-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.settings.Order short')</th>
                <th class="w-1 footable-last-visible" data-breakpoints="xs" style="display: table-cell;">
                </th>
            </tr>
        </thead>
        <tbody {{--wire:sortable="updateOrder"--}}>
            @php
                $N=1;
            @endphp
        @if(isset($forOrder['phones_top']) AND count($forOrder['phones_top'])>0 AND !empty($category_phone_all ) OR isset($tmpAddData) AND count($tmpAddData)>0 AND !empty($category_phone_all ))
        @foreach ($category_phone_all as $key=>$item_t)
        @php
            $L=0;

        @endphp
        @if(isset($forOrder['phones_top'][$key]) AND count($forOrder['phones_top'][$key])>0)

        @foreach ($forOrder['phones_top'][$key] as $key_forOrder => $item_1)

            @if(isset($categories['phones_top'][$key][$key_forOrder]))
            @php($item = $categories['phones_top'][$key][$key_forOrder])

            <tr {{--wire:sortable.item="{{ $item['id'] }}" wire:key="menu-{{ $key }}-{{ $item['id'] }}"--}}>
                <td  class="footable-first-visible" style="display: table-cell;"><span class="nowrap">@if($L==0){{$category_phone_all[$item['category_phone']]['title']}}@endif</span></td>
                <td style="display: table-cell;"><span class="nowrap">{{ $item['value'] ?? $item['value']  }}</span></td>
                <td style="display: table-cell;"><span>@if(isset($item['status_phone']))@lang('custom::admin.settings.status_phone.'.$item['status_phone'])@endif</span></td>
                <td class="text-sm-center" style="display: table-cell;">
                    <input class="form-control form-xs" type="number" placeholder="1" value="{{ $item_1 }}"{{-- wire:model='data.phones_top.{{$key}}.{{$key_forOrder}}.order' --}}onchange="changeOrder('phones_top', '{{$key_forOrder}}', this.value, '{{$key}}', 'false', this,{{count($forOrder['phones_top'][$key])}})" {{--onchange="@this.changeOrderCustom('{{ $item_country['id'] }}','{{$key}}','code_country')"--}}>
                    {{--<span>{{ $item['order'] }}</span>--}}</td>
                <td class="text-end footable-last-visible" style="display: table-cell;">
                    <button class="button button-small button-icon ico_trash" type="button" onclick="@this.dellItemTmp({{$item['id']}},'phones_top','{{$item['key']}}', '{{$key}}')"></button>
                </td>
            </tr>

            @endif
                @if(isset($tmpAddData['phones_top'][$key][$key_forOrder]))
                    @php($item_tmp = $tmpAddData['phones_top'][$key][$key_forOrder])

                <tr >
                    <td class="footable-first-visible" style="display: table-cell;"><span class="nowrap">@if($L==0){{$category_phone_all[$item_tmp['category_phone']]['title']}}@endif</span></td>
                    <td  style="display: table-cell;"><span class="nowrap">{{ $item_tmp['value'] ?? $item_tmp['value']  }}</span></td>
                    <td  style="display: table-cell;"><span>@if(isset($item_tmp['status_phone']))@lang('custom::admin.settings.status_phone.'.$item_tmp['status_phone'])@endif</span></td>
                    <td class="text-sm-center" style="display: table-cell;">
                            <input class="form-control form-xs" type="number" placeholder="1" value="{{ $item_tmp['order'] }}" {{--wire:model='tmpAddData.phones_top.{{$key}}.{{$key_forOrder}}.order'--}} onchange="changeOrder('phones_top', '{{$key_forOrder}}', this.value, '{{$key}}', 'false', this,{{count($forOrder['phones_top'][$key])}})" {{--onchange="@this.changeOrderCustom('{{ $item_country['id'] }}','{{$key}}','code_country')"--}}>
                    </td>
                    <td class="text-end footable-last-visible" style="display: table-cell;">
                        <button class="button button-small button-icon ico_trash" type="button" onclick="@this.dellItemTmp(null,'phones_top','{{ $item_tmp['key'] }}','{{ $key }}');"></button></td>
                </tr>

                @endif
                @php($L++)
                @php($N++)

            @endforeach
            @endif
         @endforeach

        @endif

        @if($N==1)
        <tr>
                <td class="text-center" style="display: table-cell;" colspan="5">
                    @lang('custom::admin.No data available')
                </td>
            </tr>
        @endif

        </tbody>
    </table>

<div class="modal fade" id="m-add-phone" tabindex="-1" aria-hidden="true"  wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('custom::admin.settings.Add number')</h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" onclick="@this.resetAllInputData()"></button>
            </div>
        <div class="modal-body">
        @if(isset($success))
        <script>
            $('#m-add-phone').hide();
            $('.modal-backdrop').hide();
        </script>
        @else

            <div class="form-group">
                <input class="js-phone form-control @error('data_phone.check_phone')is-invalid @endif"  onchange="@this.set('data_phone.value',this.value)" id="data_phone-value" type="text" placeholder="@lang('custom::admin.settings.Phone')" wire:model.lazy="data_phone.value" ></div>
                <div class="form-group" wire:ignore.self>
                   {{-- @php($category_phone_all_select[0] = ['title'=>__('custom::admin.No Category')])--}}
                  @include('livewire.admin.includes.select-data-arrow',[
                    'select_data_input'=>(isset($select_data['category_phone']) ? $select_data['category_phone']: null),
                    'select_data_array'=>$category_phone_all_select,
                    'placeholder'=>__('custom::admin.settings.Category phone'),

                    'index'=>'category_phone'
                    ])
                  @error('category_phone')
                  <div class="error">
                    {{ $message }}
                  </div>
                  @endif
              </div>
              <div class="form-group">
                @include('livewire.admin.includes.select-data-select',[
                    'select_data_input'=>(isset($select_data['status_phone']) ? $select_data['status_phone']: null),
                    'select_data_array'=>\App\Models\Setting::PHONES_STATUS,
                    'placeholder'=>__('custom::admin.Show for type users'),
                    'index'=>'status_phone',
                    'drop_list'=>'drop-list',
                    'showKey' => true
                    ])
                    {{--
                  @include('livewire.admin.includes.select-data-arrow',[
                    'select_data_input'=>(isset($select_data['status_phone']) ? $select_data['status_phone']: null),
                    'select_data_array'=>\App\Models\Setting::PHONES_STATUS, 'placeholder'=>__('custom::admin.settings.Status phone'),
                    'index'=>'status_phone'])--}}
                  @error('status_phone')
                  <div class="error">
                    {{ $message }}
                    Спочатку створити в контактах.
                  </div>
                  @endif

              </div>

              <div class="form-group">
                <input class="form-control" type="number" placeholder="@lang('custom::admin.settings.Order')" wire:model.lazy="order">
            </div>


              <div class="mt-4"><button class="button w-100" @if(count($this->getErrorBag()) == 0) disabled @endif onclick="@this.createDataPhoneTmp('phones_top','phone');" @if(isset($data_phone['value']) AND isset($select_data['status_phone']['value']) AND isset($select_data['category_phone']['value'])) data-bs-dismiss="modal" @endif type="button" >@lang('custom::admin.Add')</button></div>

        @endif
          </div>
        </div>
        <script>
            document.addEventListener('click', function () {
                $('.js-phone').inputmask({"mask": "+38(999) 999-99-99"});
            });




        </script>

        <div wire:ignore>

<script>
    function changeOrder(phones_top, key_forOrder, values, key, false_1, input, arr_count){
        if(values == 0)
            {
                values = 1;
                input.value = values;
            }
            if(values>arr_count)
            {
                values = arr_count;
                input.value = values;
              //  alert(input.value);
            }
        @this.changeOrder(phones_top, key_forOrder, values, key, false_1);

    }
</script>
</div>
        </div>
            {{--@livewire('admin.settings.widgets.setting-add-phone-livewire',['categories'=>$categories],  key(time().'-setting-add-phone'))--}}
    </div>
</div>
