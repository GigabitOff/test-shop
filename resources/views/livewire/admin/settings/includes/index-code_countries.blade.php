<div class="row">
    <div class="col-6">
        <div class="form-group">
            <input class="form-control @if(isset($error_data['code_country'])) is-invalid @endif" id="code_country"
                   type="text" placeholder="@lang('custom::admin.settings.categories.code_country')"
                   wire:model="data.code_country_tmp">
            @if(isset($error_data['code_country']))
                <div class="is-invalid">{{ $error_data['code_country'] }}</div>
            @endif
        </div>
        <div>
            <button class="button" type="button"
                    @if(isset($data['code_country_tmp']) AND !isset($error_data['code_country'])) onclick="@this.createDataTmp('code_country', @js($data['code_country_tmp']),'code_country_tmp',{{count($categories['code_country'])>0 ? end($categories['code_country'])['order'] : 0}});"
                    @else disabled
                @endif
            >@lang('custom::admin.Add')</button>
        </div>

    </div>
    <div class="col-6">
        <table
            class="js-table_new js-table mb-0 footable footable-2 footable-paging footable-paging-right breakpoint-lg">
            <tbody {{-- wire:sortable="updateOrder"--}}>
            @php($L=1)
            @if(isset($forOrder['code_country']) AND count($forOrder['code_country'])>0)

                @foreach ($forOrder['code_country'] as $key=>$item_order)
                    @if(isset($categories['code_country'][$key]))
                        @php($item_country = $categories['code_country'][$key])
                        <tr {{--wire:sortable.item="{{ $item_country['id'] }}" wire:key="code_country-{{ $item_country['id'] }}"--}}>
                            <td class="footable-first-visible" style="display: table-cell;">
                                <span>{{ $item_country['value'] }}</span></td>
                            <td class="text-center" style="display: table-cell;">
                                <input class="form-control form-xs" type="number" placeholder="1"
                                       value="{{ $item_country['order'] }}"
                                       wire:model.lazy='data.code_country.{{$key}}.order'
                                       onchange="@this.changeOrder('code_country', '{{$key}}', this.value)" {{--onchange="@this.changeOrderCustom('{{ $item_country['id'] }}','{{$key}}','code_country')"--}}>
                            </td>
                            <td class="w-1 text-end footable-last-visible" style="display: table-cell;">
                                @if($item_country['value'] != "+38")
                                    <button class="button button-small button-icon ico_trash" type="button"
                                            onclick="@this.dellItemTmp({{ $item_country['id'] }},'code_country','{{ $key }}')"></button>
                                @endif
                            </td>
                        </tr>
                    @endif
                    @if(isset($tmpAddData['code_country'][$key]))
                        @php($item_country2 = $tmpAddData['code_country'][$key])

                        <tr>
                            <td class="footable-first-visible" style="display: table-cell;">
                                <span>{{ $item_country2['value'] }}</span></td>
                            <td class="text-center" style="display: table-cell;"><input class="form-control form-xs"
                                                                                        type="text" placeholder="1"
                                                                                        value="{{ $item_country2['order'] }}"
                                                                                        wire:model.lazy='tmpAddData.code_country.{{$key}}.order'
                                                                                        onchange="@this.changeOrder('code_country', '{{$key}}', this.value)">
                            </td>
                            <td class="w-1 text-end footable-last-visible" style="display: table-cell;">
                                <button class="button button-small button-icon ico_trash" type="button"
                                        onclick="@this.dellItemTmp(null,'code_country','{{ $key }}')"></button>
                            </td>
                        </tr>
                    @endif
                    @php($L++)
                @endforeach
            @else
                <tr>
                    <td class="text-center" style="display: table-cell;" colspan="3">
                        @lang('custom::admin.No data available')

                    </td>

                </tr>
            @endif
            {{-- @if(isset($tmpAddData['code_country']) AND count($tmpAddData['code_country'])>0)

                     @foreach ($tmpAddData['code_country'] as $key=>$item_country)

                     @endforeach

             @endif--}}
            </tbody>
        </table>

    </div>
</div>
