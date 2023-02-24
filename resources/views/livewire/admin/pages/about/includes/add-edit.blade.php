

<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link @if('main'=== $show_lang) active @endif" id="nav-main-tab" data-toggle="tab" href="#nav-main" wire:click="changeLangTab('main')" role="tab" aria-controls="nav-main" aria-selected="false" style="color: black;">
        <span class="nav-item-text">@lang('custom::admin.General data')</span>
    </a>
    <a class="nav-item nav-link @if('banners'=== $show_lang) active @endif" id="nav-banners-tab" data-toggle="tab" href="#nav-banners" wire:click="changeLangTab('banners')" role="tab" aria-controls="nav-banners" aria-selected="false" style="color: black;">
        <span class="nav-item-text">@lang('custom::admin.Banners select')</span>
    </a>
    <a class="nav-item nav-link @if('settings'=== $show_lang) active @endif" id="nav-settings-tab" data-toggle="tab" href="#nav-settings" wire:click="changeLangTab('settings')" role="tab" aria-controls="nav-settings" aria-selected="false" style="color: black;">
        <span class="nav-item-text">@lang('custom::admin.Settings select')</span>
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
            @include('livewire.admin.includes.add-image-data',
                    ['index'=>'image','itleImage'=>"Зображення глобально"])
            </div>
            <div class="form-group">
                <label for="pageTitle{{ app()->currentLocale() }}">
                    @lang('custom::admin.Title')
                </label>
                <input type="text" class="form-control @error('data.{{ app()->currentLocale() }}.title') is-invalid @enderror" id="pageTitle{{app()->currentLocale() }}" placeholder="@lang('custom::admin.Title')"
                    wire:model="data.{{ app()->currentLocale() }}.title">
            </div>
            <div class="form-group">
                <label for="menulug">Slug</label>
                <input disabled type="text" class="form-control @error('slug') is-invalid @enderror" id="menulug"
                placeholder="Slug" wire:model="slug">
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
            @endif

                <div class="form-group" wire:ignore>
                    <label>Статус</label>
                    <span onclick="@this.changeStatusAll('status');">
                        <input type="checkbox" wire:model="data.status" checked data-toggle="toggle" data-on="Активно" data-off="Не активно" data-size="sm">
                    </span>
                </div>
            </div>
        </div>
    <div class="card card-primary tab-pane fade @if('banners'=== $show_lang) show active @endif" id="nav-banners" role="tabpanel" aria-labelledby="nav-banners-tab">
        <div class="card-body col-9">
            @livewire('admin.banners.banners-item-livewire', ['page_id' => $data['id']], key(time().$data['id']))
        </div>
    </div>
    <div class="card card-primary tab-pane fade @if('settings'=== $show_lang) show active @endif" id="nav-settings" role="tabpanel" aria-labelledby="nav-settings-tab">
        <div class="card-body col-9">
          @livewire('admin.settings.setting-item-livewire', ['slug_item' => 'about','page_id' => $data['id']], key(time().'setting-item'))
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
            <label>@lang('custom::admin.Description')</label>
            <textarea class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                wire:model.lazy="data.{{$item_lang->lang}}.description">
                @if(isset($data[$item_lang->lang]['description']))
                {{ $data[$item_lang->lang]['description'] }}
                @endif
            </textarea>
        </div>
        <div class="input-group mb-2" wire:ignore>
            <div class="input-group-prepend">
                <label for="data-{{$item_lang->lang}}-body" class="input-group-text">@lang('custom::admin.Body')</label>
            </div>
            <textarea class="form-control" cols="30" rows="10" id="data-{{$item_lang->lang}}-body" data-description="@this" type="text" wire:model="data.{{$item_lang->lang}}.body">
                @if(!empty(@$data[$item_lang->lang]['body']))
                {{ $data[$item_lang->lang]['body'] }}
                @endif
            </textarea>
        </div>
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'data-'.$item_lang->lang.'-body', 'nameForm'=>'data.'.$item_lang->lang.'.body'])
        @include('livewire.admin.includes.meta-data', ['lang'=>$item_lang->lang])
    </div>
    @endforeach
    <div class="card-footer">
        <button type="button" class="btn btn-primary"
        wire:click="saveData">@lang('custom::admin.Save')</button>
    </div>
    </div>
<div class="d-flex justify-content-between">
    <div>
        <div class="button-group">
            <a class="button" href="#!" wire:click="saveData">
                @lang('custom::admin.Save')
            </a>
            <a class="button button-secondary" href="{{ route('admin.actions.index')}}">
                @lang('custom::admin.Return')
            </a>
        </div>
    </div>
</div>
