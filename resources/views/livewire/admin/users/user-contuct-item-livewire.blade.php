<div>
    <div class="table-before-btn --small" >
        <button style="margin-right: 15px;" class="button button-accent button-small button-icon ico_plus" type="button" data-bs-target="#m-add-shop" data-bs-toggle="modal"></button>
    </div>
        <table class="js-table js-table_new table-td-smal footable">
            <thead>
                <tr>

                    <th style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.Spivrobitnik')</th>
                    <th style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.Send data')</th>
                    <th style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.clients.Phone')</th>
                    <th style="display: table-cell;" data-breakpoints="xs">@lang('custom::admin.clients.E-mail')</th>
                    <th style="display: table-cell;" class="w-1 footable-last-visible" data-breakpoints="xs"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $L = 1;
                @endphp

                @if($all_data AND count($all_data)>0)
                @foreach ($all_data as $key=>$item)
                @if(isset($item['manager']['name']))
                <tr>
                    {{--<td style="display: table-cell;" class="footable-first-visible"><span>{{ (isset($dataContucts[$key]['title'])) ? $dataContucts[$key]['title'] : '' }}</span></td>--}}
                    <td style="display: table-cell;">

                            <span>{{ $item['manager']['name']}}</span>

                    </td>
                    <td style="display: table-cell; " class="text-center">

                            <label class="check">
                            <input class="check__input" type="checkbox"  @if($data[$item['manager']['id']]['send_mail'] == 1) onclick="@this.set('data.{{ $item['manager']['id']}}.send_mail',0);" checked @else onclick="@this.set('data.{{ $item['manager']['id']}}.send_mail',1);" @endif /><span class="check__box"></span>
                            </label>

                    </td>
                    <td style="display: table-cell;">

                            <span>{{ $item['manager']['phone']}}</span>

                    </td>
                    <td style="display: table-cell;">

                            <span>{{ $item['manager']['email']}}</span>

                    </td>
                    <td class="w-1 footable-last-visible" style="display: table-cell;">
                       <button class="button button-small button-icon ico_trash" type="button" onclick = "@this.destroyDataTmp({{$key}})"></button>
                    </td>
                </tr>
                @php
                    $L++;
                @endphp
                @endif
                @endforeach
                @endif

                @if($dataUserContuctTmp AND count($dataUserContuctTmp)>0)
                @foreach ($dataUserContuctTmp as $key_tmp=>$item_tmp)

                <tr>
                    {{--<td style="display: table-cell;"  class="footable-first-visible"><span>{{ $item_tmp['set_store']['name'] }}</span></td>--}}
                    <td style="display: table-cell;">

                            <span>{{ $item_tmp['name']}}</span>

                    </td>
                    <td style="display: table-cell; " class="text-center">

                            <label class="check">
                            <input class="check__input" type="checkbox" wire:model="data.{{ $item_tmp['manager']['id']}}.send_mail"  /><span class="check__box"></span>
                            </label>

                    </td>
                    <td style="display: table-cell;">

                            <span>{{ $item_tmp['manager']['phone']}}</span>

                    </td>
                    <td style="display: table-cell;">

                            <span>{{ $item_tmp['manager']['email']}}</span>

                    </td>
                    <td class="w-1 footable-last-visible" style="display: table-cell;">
                       <button class="button button-small button-icon ico_trash" type="button" onclick = "@this.destroyDataTmp('{{$key_tmp}}','tmp')"></button>
                    </td>
                </tr>

                @php
                    $L++;
                @endphp
                @endforeach

                @endif

                @if($L == 1)

                <tr>
                    <td class="text-center" style="display: table-cell;" colspan="3">
                @lang('custom::admin.No data available')

                    </td>

                </tr>
                @endif

            </tbody>
    </table>

    <div class="modal fade" id="m-add-shop" wire:ignore.self>
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">@lang('custom::admin.settings.categories.Store departments')</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            {{--<div class="form-group">
                @include('livewire.admin.includes.select-data-select',[
                    'select_data_input'=>(isset($filter['set_store']) ? $select_data['set_store'][$filter['set_store']]['name']: null),
                    'select_data_array'=>$dataContucts,
                    'placeholder'=>__('custom::admin.settings.categories.Store departments'),
                    'show_title'=>true,
                    'title_select' => isset($select_data['set_store']) ? $select_data['set_store']['name']: null,
                    'index'=>'set_store',
                    'drop_list'=>'drop-list'])

            </div>--}}
            <div class="form-group">
              <div class="row g-3 copy-block">
                  @for ($i = 1; $i <= $count; $i++)
                    <div class="col-12 copy-item --col --drop">
                    <button class="button button-icon button-small ico_plus" type="button" onclick="@this.set('count',{{$count+1}})"></button>
                    @include('livewire.admin.includes.select-data-arrow',[
                    'select_data_input'=>(isset($select_array['set_menager_'.$i]) ? $select_array['set_menager_'.$i]['name']: null),
                    'select_data_array'=>$dataManagers,
                    'placeholder'=>__('custom::admin.Manager (search by ID or full name)'),
                    'index'=>'set_menager_'.$i,
                    'for_clear_index' => ['key'=>'set_menager_','index'=>$i],
                    'title_select' => (isset($select_array['set_menager_'.$i]) ? $select_array['set_menager_'.$i]['name']: null),
                    'show_name'=>true,
                    'drop_class'=>'--search',
                    'onClick' =>'sellectFilterList',
                    'key_for_select_array'=>'hide_parent_id',
                    'classTable' => 'Attribute'])
                    @if(isset($select_data['set_menager_'.$i]) AND count($select_data['set_menager_'.$i])==1)
                        @php
                            unset($select_data['set_menager_'.$i]);
                        @endphp
                    @endif
                  </div>
                  @endfor
                </div>
              </div>
            </div>
            @if($select_data AND count($select_data)>=1 AND isset($select_data['set_menager_1']['id']))

            <div class="mt-4">
                <button class="button w-100" type="button" data-bs-dismiss="modal" wire:click="addDataTmp">@lang('custom::admin.Save')</button></div>
            @endif
        </div>
        </div>
      </div>
    </div>

