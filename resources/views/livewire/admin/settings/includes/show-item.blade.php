    @if($data_show AND count($data_show)>0)
                @foreach ($data_show as $key=>$item)
                <div class="row">
                    <div class="form-group @if(!isset($edit[$key])){{'col'}}@endif">
                        <label for="key{{$key}}">@lang('custom::admin.settings.Key')</label>
                        <input @if(!isset($edit[$key]))disabled @endif type="text"
                            class="form-control @error('key') is-invalid @enderror" id="key{{$key}}"
                            placeholder="@lang('custom::admin.settings.Key')" wire:model="data.{{$key}}.key">
                        @error('key')Має бути унікальне @enderror
                    </div>
                    <div class="form-group @if(!isset($edit[$key])){{'col'}}@endif">
                        <label for="display_name{{$key}}">@lang('custom::admin.settings.Display Name')</label>
                        <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                            id="display_name{{$key}}" @if(!isset($edit[$key]))disabled @endif
                            placeholder="@lang('custom::admin.settings.Display Name')" wire:model="data.{{$key}}.display_name">
                    </div>
                    @if(isset($data_show[$key]['type']) AND $data_show[$key]['type'] == 'file')

                    @include('livewire.admin.includes.add-file',['index'=>'value','data_file'=>$data_show[$key]['value'],'disable' => (!isset($edit[$key])? true : '')])
                    @elseif(isset($data_show[$key]['type']) AND $data_show[$key]['type'] == 'img')
                    @include('livewire.admin.includes.add-image',['index'=>'value','data_file'=>$data_show[$key]['value'],'disable' => (!isset($edit[$key])? true : '')])
                    @else
                    <div class="form-group @if(!isset($edit[$key])){{'col'}}@endif">
                        <label for="value{{$key}}">@lang('custom::admin.settings.Value')</label>
                        <input type="text" class="form-control @error('data.{{$key}}.value') is-invalid @enderror"
                            @if(!isset($edit[$key]))disabled @endif id="value{{$key}}"
                            placeholder="@lang('custom::admin.settings.Value')" wire:model="data.{{$key}}.value">
                    </div>
                    @endif
                    @if(isset($edit[$key]))
                        @if($data_show[$key]['type'] == 'phone')
                        <div class="form-group">
                            <label for="type0">@lang('custom::admin.settings.Category phone')</label>
                            <select class="form-control" id="category_phone{{$key_item}}-{{$key}}" wire:model="data.{{$key}}.category_phone">
                                <option value="">@lang('custom::admin.Select')</option>
                                @foreach (\App\Models\Setting::PHONES_STATUS as $key_t=>$item_t)
                                <option value="{{ $key_t }}">@lang('custom::admin.settings.phones_type.'.$key_t)</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                        @endif

                        <div class="form-group">
                            <label for="type0">@lang('custom::admin.settings.Category')</label>
                            <select class="form-control" id="category0" wire:model="data.{{$key}}.category">
                                <option value="">@lang('custom::admin.Select')</option>
                                @foreach ($data_show as $key_cat_sel=>$item_cat_sel)
                                <option value="{{ $key_cat_sel }}">@lang('custom::admin.settings.data.'.$key_cat_sel)</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-group @if(!isset($edit[$key])){{'col'}}@endif">
                        <label for="order{{$key}}">@lang('custom::admin.settings.Order')</label>
                        <input type="text" class="form-control @error('data.{{$key}}.order') is-invalid @enderror"
                            @if(!isset($edit[$key]))disabled @endif id="order{{$key}}"
                            placeholder="@lang('custom::admin.settings.Order')" wire:model="data.{{$key}}.order">
                    </div>

                    <div class="form-group @if(!isset($edit[$key])){{'col'}}@else{{ 'col-2' }}@endif text-center">
                        <label for="action0" class="row">&nbsp;</label>
                        {{--
                        <button type="button" class="btn btn-outline-dark mr-2"
                            wire:click="StatrEndEdit({{ $item['id'] }},{{$key}})">
                            @if(!isset($edit[$key]))
                            @lang('custom::admin.Edit')
                            @else
                            @lang('custom::admin.Save')
                            @endif
                        </button>
                        --}}
                    </div>
                </div>
                @endforeach
@endif
