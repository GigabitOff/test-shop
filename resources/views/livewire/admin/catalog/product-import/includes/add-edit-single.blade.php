<form action="#!">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-text">
                <span>@lang('custom::admin.product_imports.name')</span>
            </div>
            <input class="form-control"
                   placeholder="@lang('custom::admin.product_imports.name')"
                   wire:model.lazy="data.name"
                   type="text">
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <div class="input-group-text">
                <span>@lang('custom::admin.product_imports.upload_url')</span>
            </div>
            <input class="form-control"
                   placeholder="https://..."
                   wire:model.lazy="data.source_file"
                   type="text">
            @error('data.source_file')
            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <div class="input-group-text">
                <span>@lang('custom::admin.product_imports.file_type')</span>
            </div>
            <x-livewire.admin.drop-select
                model="type"
                :value="$data['type'] ?? ''"
                :list="$this->getAvailableImportTypes()"
                :placeholder="__('custom::admin.product_imports.select_file_type')">
            </x-livewire.admin.drop-select>
            @error('data.type')
            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
            @enderror
        </div>
    </div>

{{--    <div class="form-group"><label class="check"><input class="check__input" type="checkbox" /><span class="check__box"></span><span class="check__txt">Вариант по умолчанию</span></label></div>--}}

    <h6>@lang('custom::admin.product_imports.field_settings')</h6>

    @if(!empty($this->data['type']) || true)

        @foreach($this->optionSettings as $key => $option)
            <div class="form-group" id="option-{{$key}}">
                @if('string' === $option['field_type'])
                    <div class="input-group">
                        <div class="input-group-text"><span>@lang("custom::admin.product_imports.options.$key")</span>
                        </div>
                        <input class="form-control"
                               placeholder="@lang("custom::admin.product_imports.options.$key")"
                               wire:model="{{"data.options.$key"}}"
                               type="text">
                    </div>
                @elseif('bool' === $option['field_type'])
                    <div class="form-group">
                        <label class="check">
                            <input class="check__input" wire:model="{{"data.options.$key"}}" type="checkbox"/>
                            <span class="check__box"></span>
                            <span class="check__txt">@lang("custom::admin.product_imports.options.$key")</span>
                        </label>
                    </div>
                @endif
            </div>
        @endforeach

    @endif

{{--    <div class="mt-4">--}}
{{--        <div class="button-group button-group-price">--}}
{{--            <button class="button button-secondary" type="button">Импортировать товары в ручную</button>--}}
{{--            <button class="button button-danger" type="button">Удалить шаблон</button>--}}
{{--            <button class="button button-import" type="button">Импортировать</button></div>--}}
{{--    </div>--}}
</form>
