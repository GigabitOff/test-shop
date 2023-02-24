<div>

    <div class="container">
        <div class="row">
            <div class="form-group">
                <label for="display_name0">@lang('custom::admin.settings.Display Name')</label>
                <input type="text" class="form-control @error('display_name') is-invalid @enderror" id="display_name0"
                    placeholder="@lang('custom::admin.settings.Display Name')" wire:model="display_name">
            </div>
            <div class="form-group">
                <label for="key0">@lang('custom::admin.settings.Key')</label>
                [<b>{{ $prefix_key }}</b>]<input type="text" class="form-control @error('key') is-invalid @enderror" id="key0"
                    placeholder="@lang('custom::admin.settings.Key')" wire:model="key">
            </div>
            <div class="form-group">
                <label for="value0">@lang('custom::admin.settings.Value')</label>
                <input type="text" class="form-control @error('value') is-invalid @enderror" id="value0"
                    placeholder="@lang('custom::admin.settings.Value')" wire:model="value">
            </div>
            <div class="form-group">
                <label for="value0">@lang('custom::admin.settings.Order_s')</label>
                <input type="text" class="form-control @error('order') is-invalid @enderror" id="value0"
                    placeholder="@lang('custom::admin.settings.Order_s')" wire:model="order">
            </div>
            @if($type == 'phone')
                <div class="form-group">
                    <label for="type0">@lang('custom::admin.settings.Category phone')</label>
                    <select class="form-control" id="category_phone{{$type}}" wire:model="category_phone">
                        <option value="">@lang('custom::admin.Select')</option>
                        @foreach (\App\Models\Setting::PHONES_STATUS as $key_t=>$item_t)
                        <option value="{{ $key_t }}">@lang('custom::admin.settings.phones_type.'.$key_t)</option>
                        @endforeach
                    </select>
                </div>
            @else
            @endif
            @if(!$page_id)

            <div class="form-group">
                <label for="type0">@lang('custom::admin.settings.Category')</label>
                    <select class="form-control" id="category0" wire:model="category">
                        <option value="">@lang('custom::admin.Select')</option>
                            @foreach ($categories as $key_cat_sel=>$item_cat_sel)
                        <option value="{{ $key_cat_sel }}">@lang('custom::admin.settings.categories.'.$key_cat_sel)</option>
                                @endforeach
                    </select>
            </div>
            @endif
            @if($type == 'file')
            @include('livewire.admin.includes.add-file',['index'=>'value'])
            @endif
            @if($type == 'img')
            @include('livewire.admin.includes.add-image',['index'=>'value'])
            @endif
            <div class="form-group">
                <label for="type0">@lang('custom::admin.settings.Type')</label>
                <select class="form-control" id="type0" wire:model="type">
                    @foreach (\App\Models\Setting::SETTINGS_TYPE as $key=>$item)
                    <option value="{{ $key }}">@lang('custom::admin.settings.type.'.$item)</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="action0" class="row">&nbsp;</label>
                <button type="button" class="btn btn-outline-dark mr-1" wire:click="SaveData(0)">
                    @lang('custom::admin.Save')
                </button>
                <button type="button" class="btn btn-outline-dark" @if(!$page_id)wire:click="$emit('StartEndAddData')" @else wire:click="$emit('resetPage')" @endif>
                    X
                </button>
            </div>
        </div>
    </div>
</div>
