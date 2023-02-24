<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link @if('main'=== $show_lang) active @endif" id="nav-main-tab" data-toggle="tab" href="#nav-main" wire:click="changeLangTab('main')" role="tab" aria-controls="nav-main" aria-selected="false" style="color: black;">
        <span class="nav-item-text">Загальні дані</span>
    </a>
    @foreach($languages as $key=>$lang)
    <a class="nav-item nav-link @if($key===$show_lang) active @endif" id="nav-{{$lang->lang}}-tab" data-toggle="tab" href="#nav-{{$lang->lang}}" wire:click="changeLangTab({{$key}},'{{ $lang->lang}}')" role="tab" aria-controls="nav-{{$lang->lang}}" aria-selected="false" style="color: black;">
        <span class="nav-item-text"> {{ $lang->name }}</span>
    </a>
    @endforeach
</div>
<div class="tab-content" id="nav-tabContent">
    <div class="card card-primary tab-pane fade @if('main'=== $show_lang) show active @endif" id="nav-0" role="tabpanel" aria-labelledby="nav-0-tab">
        <div class="card-body col-9">
            <div class="form-group">
                <label for="pageTitle{{ app()->currentLocale() }}">
                    @lang('custom::admin.Title')
                </label>
                <input type="text" class="form-control @error('data.{{ app()->currentLocale() }}.title') is-invalid @enderror" id="pageTitle{{app()->currentLocale() }}" placeholder="@lang('custom::admin.Title')"
                    wire:model="data.{{ app()->currentLocale() }}.title">
            </div>
            <div class="form-group">
                <label for="menulug">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="menulug"
                placeholder="Slug" wire:model.lazy="slug">
            </div>
            <div class="form-group">
                <label for="menulug">Позиція</label>
                <input type="number" class="form-control @error('data.order') is-invalid @enderror"
                id="menulug" placeholder="Order" wire:model="data.order">
            </div>
            @if($select_pages)
            <div class="form-group row">
                <label for="forParentPage" class="col-sm-3 col-form-label">Включено в </label>
                <div class="col-sm-9">
                    <select class="form-control" id="forParentPage" wire:model="data.parent_id">
                        <option value="0">обрати сторінку</option>
                        @foreach ($select_pages as $item)
                        <option value="{{ $item->id }}">{{ $item->title }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @elseif($parent_id !=0 AND $menu)
            <div class="form-group row">
                <label for="forParentPage" class="col-sm-3 col-form-label">Розділ </label>
                <div class="col-sm-9">
                    <select class="form-control" id="forParentPage" wire:model="data.parent_id">
                        <option value="0">обрати</option>
                        @foreach ($menu as $item)
                        <option value="{{ $item->id }}" @if($parent_id==$item->id) selected
                            @endif>{{ $item->title }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                <div class="form-group" wire:ignore>
                    <label>Статус</label>
                    <span onclick="@this.changeStatusAll('status');">
                        <input type="checkbox" wire:model="data.status" checked data-toggle="toggle" data-on="Активно" data-off="Не активно" data-size="sm">
                    </span>
                </div>
            </div>
        </div>
        @foreach($languages as $key=>$item_lang)
    <div class="tab-pane fade @if($key===$show_lang) show active @endif" id="nav-{{$item_lang->lang}}" role="tabpanel" aria-labelledby="nav-{{$item_lang->lang}}-tab">
        <div class="form-group">
            <label for="pageTitle{{$item_lang->lang}}">
                @lang('custom::admin.Title')
            </label>
            <input type="text" class="form-control @error('data.{{$item_lang->lang}}.title') is-invalid @enderror" id="pageTitle{{$item_lang->lang}}" placeholder="@lang('custom::admin.Title')"
            wire:model="data.{{$item_lang->lang}}.title">
        </div>
        <div class="form-group">
            <label for="pageH1{{$item_lang->lang}}">
                @lang('custom::admin.H1')
            </label>
            <input type="text" class="form-control" id="pageH1{{$item_lang->lang}}"
            placeholder="@lang('custom::admin.H1')" wire:model="data.{{$item_lang->lang}}.h1">
        </div>
        <div class="form-group">
            <label for="menulug">@lang('custom::admin.Url')</label>
            <input type="text" class="form-control @error('data.{{$item_lang->lang}}.url') is-invalid @enderror" id="menulug"
            placeholder="Url" wire:model="data.{{$item_lang->lang}}.url">
        </div>
        <div class="form-group">
            @include('livewire.admin.includes.add-image-data',
                    ['index'=>'image','itleImage'=>"Зображення глобально"])
        </div>
        <div class="form-group">
            <label>@lang('custom::admin.Description')</label>
            <textarea class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                wire:model.lazy="data.{{$item_lang->lang}}.description">
                @if(isset($data[$item_lang->lang]['description']))
                {{ $data[$item_lang->lang]['description'] }}
                @endif
            </textarea>
        </div>
        @include('livewire.admin.includes.meta-data', ['lang'=>$item_lang->lang])
    </div>
    @endforeach
    <div class="card-footer">
        <button type="button" class="btn btn-primary"
        wire:click="saveData">@lang('custom::admin.Save')</button>
    </div>
    </div>


