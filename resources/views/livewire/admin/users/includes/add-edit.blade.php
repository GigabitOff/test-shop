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
    <div class="card card-primary tab-pane fade @if('main'=== $show_lang) show active @endif" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab">
        <div class="card-body col-9">

        <div class="form-group">
        <label for="dataName-{{ app()->currentLocale() }}">
                    @lang('custom::admin.clients.FIO')
        </label>
        <input type="text" class="form-control @error('data.{{ app()->currentLocale() }}.name') is-invalid @enderror" id="dataName-{{app()->currentLocale() }}" placeholder="@lang('custom::admin.clients.FIO')"  wire:model="data.{{ app()->currentLocale() }}.name">
        </div>
        @if($select_pages)
            <div class="form-group row">
                <label for="forParentPage" class="col-sm-3 col-form-label">Включено в </label>
                <div class="col-sm-9">
                    <select class="form-control" id="forParentPage" wire:model="data.page_id" disabled>
                        <option value="0">обрати сторінку</option>
                        @foreach ($select_pages as $item)
                        <option value="{{ $item->id }}">{{ $item->title }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        <div class="form-group custome-dropdown custome-dropdown--arrow --empty" id="city-selector">
            @include('livewire.admin.includes.add-city-data')
        </div>
        <div class="form-group">
        <label for="dataPhone">
                    @lang('custom::admin.clients.Phone')
        </label>
        <input type="text" class="form-control @error('data.phone') is-invalid @enderror" id="dataPhone" placeholder="@lang('custom::admin.clients.Phone')"  wire:model="data.phone">
        </div>
        <div class="form-group">
        <label for="pageEmails">
            @lang('custom::admin.clients.E-mail')
        </label>
        <input type="text" class="form-control @error('data.email') is-invalid @enderror" id="pageSchedule }}" placeholder="@lang('custom::admin.clients.E-mail')"  wire:model="data.email">
        </div>
        <div class="form-group">
        <label for="pageCounterpartyId">
            @lang('custom::admin.clients.Counterparty')
        </label>
        @if($data_collect->counterparty)
        <input type="text" class="form-control @error('data.counterparty_id') is-invalid @enderror" id="pageCounterpartyId" placeholder="@lang('custom::admin.clients.Counterparty')"  value="{{ $data_collect->counterparty->name}}">
        @elseif($counterparties)
        <select class="form-control" id="forParentPage" wire:model="data.counterparty_id">
            <option value="0">обрати </option>
            @foreach ($counterparties as $item)
            <option value="{{ $item->id }}">{{ $item->name }} </option>
            @endforeach
        </select>
        </div>
        </div>
        @endif
        </div>
        @if($data['blocked_ip_id'] != 0)
        <div class="form-group" wire:ignore>
            <label>@lang('custom::admin.clients.Blocked user')</label>
            <span onclick="@this.changeStatusAll('blocked_ip_id');">
                <input type="checkbox" wire:model="data.blocked_ip_id" checked data-toggle="toggle" data-on="Так" data-off="Не Ні" data-size="sm">
            </span>
        </div>
        @endif
        <div class="form-group" wire:ignore>
            <label>@lang('custom::admin.clients.Delete user')</label>
            <span onclick="@this.removeUser('{{$data['id']}}');">
                <input type="checkbox" wire:model="status_delete" checked data-toggle="toggle" data-on="Так" data-off="Ні" data-size="sm">
            </span>
        </div>

        @if($user_groups)
            <div class="form-group row">
                <label for="forParentPage" class="col-sm-3 col-form-label">@lang('custom::admin.clients.Group admin')</label>
                <div class="col-sm-9">
                    <select class="form-control" id="forParentPage" wire:model="data.page_id">
                        <option value="0">обрати </option>
                        @foreach ($user_groups as $item)
                        <option value="{{ $item->id }}">{{ $item->title }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <div class="form-group" wire:ignore>
            <label>@lang('custom::admin.clients.Confirm number')</label>
            <span >
                <input type="checkbox" @if($data['phone_verified_at'])checked @endif data-toggle="toggle" data-on="Так" data-off="Ні" data-size="sm">
            </span>
        </div>
        <div class="form-group" wire:ignore>
            <label>@lang('custom::admin.Status')</label>
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
        @if($this->parent_id AND $this->parent_id !=0)

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
        @endif
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
