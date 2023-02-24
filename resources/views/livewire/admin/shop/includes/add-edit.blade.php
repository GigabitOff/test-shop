<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link @if('main'=== $show_lang) active @endif" id="nav-main-tab" data-toggle="tab" href="#nav-main" wire:click="changeLangTab('main')" role="tab" aria-controls="nav-main" aria-selected="false" style="color: black;">
        <span class="nav-item-text">Загальні дані</span>
    </a>
    @if($shop_id)
    <a class="nav-item nav-link @if('contucts'=== $show_lang) active @endif" id="nav-contucts-tab" data-toggle="tab" href="#nav-contucts" wire:click="changeLangTab('contucts')" role="tab" aria-controls="nav-contucts" aria-selected="false" style="color: black;">
        <span class="nav-item-text">@lang('custom::admin.Contucts select')</span>
    </a>
    @endif
    @foreach($languages as $key=>$lang)
    <a class="nav-item nav-link @if($key===$show_lang) active @endif" id="nav-{{$lang->lang}}-tab" data-toggle="tab" href="#nav-{{$lang->lang}}" wire:click="changeLangTab({{$key}},'{{ $lang->lang}}')" role="tab" aria-controls="nav-{{$lang->lang}}" aria-selected="false" style="color: black;">
        <span class="nav-item-text"> {{ $lang->name }}</span>
    </a>
    @endforeach
</div>

<div class="tab-content" id="nav-tabContent">
    <div class="card card-primary tab-pane fade @if('main'=== $show_lang) show active @endif" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab">
        <div class="card-body col-9">

        <div class="form-group">
        <label for="pageTitle{{ app()->currentLocale() }}">
                    @lang('custom::admin.Title')
        </label>
        <input type="text" class="form-control @error('data.{{ app()->currentLocale() }}.title') is-invalid @enderror" id="pageTitle{{app()->currentLocale() }}" placeholder="@lang('custom::admin.Title')"  wire:model="data.{{ app()->currentLocale() }}.title">
        </div>
        @if($select_pages)
            <div class="form-group row">
                <label for="forParentPage" class="col-sm-3 col-form-label">Включено в </label>
                <div class="col-sm-9">
                    <select class="form-control" id="forParentPage" wire:model="data.page_id">
                        <option value="0">обрати сторінку</option>
                        @foreach ($select_pages as $item)
                        <option value="{{ $item->id }}">{{ $item->title }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <div class="form-group">
        <label for="pageTitle{{ app()->currentLocale() }}">
                    @lang('custom::admin.Coords')
        </label>
        <input type="text" class="form-control @error('data.coords') is-invalid @enderror" id="pageSchedule }}" placeholder="@lang('custom::admin.Coords')"  wire:model="data.coords">
        </div>
        <div class="form-group">
        <label for="pageWhours">
                    @lang('custom::admin.Phones')
        </label>
        <input type="text" class="form-control @error('data.phones') is-invalid @enderror" id="pageSchedule }}" placeholder="@lang('custom::admin.Phones')"  wire:model="data.phones">
        </div>
        <div class="form-group">
        <label for="pageEmails">
                    @lang('custom::admin.Emails')
        </label>
        <input type="text" class="form-control @error('data.emails') is-invalid @enderror" id="pageEmails" placeholder="@lang('custom::admin.Emails')"  wire:model="data.emails">
        </div>
        <div class="form-group custome-dropdown custome-dropdown--arrow --empty" id="city-selector">
            <label for="pageAddress">
                    @lang('custom::admin.City')
            </label>
            @include('livewire.admin.includes.add-city-data')
        </div>
        <div class="form-group">
        <label for="pageAddress">
                    @lang('custom::admin.Address')
        </label>
        <input type="text" class="form-control @error('data.address') is-invalid @enderror" id="pageAddress" placeholder="@lang('custom::admin.Schedule')"  wire:model="data.address">
        </div>
        <div class="form-group">
        <label for="pageTitle{{ app()->currentLocale() }}">
                    @lang('custom::admin.Schedule')
        </label>
        <input type="text" class="form-control @error('data.schedule') is-invalid @enderror" id="pageSchedule" placeholder="@lang('custom::admin.Schedule')"  wire:model="data.schedule">
        </div>
        <div class="form-group">
        <label for="pageWhours">
                    @lang('custom::admin.Whours')
        </label>
        <input type="text" class="form-control @error('data.whours') is-invalid @enderror" id="pageSchedule }}" placeholder="@lang('custom::admin.Whours')"  wire:model="data.whours">
        </div>
        <div class="form-group">
            @include('livewire.admin.includes.add-image-data',
                    ['index'=>'image','itleImage'=>"Зображення глобально"])
        </div>
            <div class="form-group" wire:ignore>
                <label>Статус</label>
                    <span onclick="@this.changeStatusAll('status');">
                    <input type="checkbox" wire:model="data.status" checked data-toggle="toggle" data-on="Активно" data-off="Не активно" data-size="sm">
                </span>
            </div>
        </div>
    </div>
    @if($shop_id)
    <div class="card card-primary tab-pane fade @if('contucts'=== $show_lang) show active @endif" id="nav-jobs" role="tabpanel" aria-labelledby="nav-contucts-tab">
        <div class="card-body col-9">
            @livewire('admin.contucts.contuct-item-livewire', ['shop_id' => $shop_id], key(time().'contuct-item-'.isset($data['id'])? $shop_id : ''))
        </div>
    </div>
    @endif
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
        <label for="pageTitle{{ app()->currentLocale() }}">
                    @lang('custom::admin.Schedule')
        </label>
        <input type="text" class="form-control @error('data.schedule') is-invalid @enderror" id="pageSchedule }}" placeholder="@lang('custom::admin.Schedule')"  wire:model="data.schedule">
        </div>
        <div class="form-group">
        <label for="pageWhours">
                    @lang('custom::admin.Whours')
        </label>
        <input type="text" class="form-control @error('data.whours') is-invalid @enderror" id="pageSchedule }}" placeholder="@lang('custom::admin.Whours')"  wire:model="data.whours">
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
    @if(isset($action_type))
    <div class="card-footer">
        <button type="button" class="btn btn-primary"
        wire:click="{{$action_type}}">@lang('custom::admin.Save')</button>
    </div>

    @else
    <div class="card-footer">
        <button type="button" class="btn btn-primary"
        wire:click="saveData">@lang('custom::admin.Save')</button>
    </div>
    @endif
</div>
