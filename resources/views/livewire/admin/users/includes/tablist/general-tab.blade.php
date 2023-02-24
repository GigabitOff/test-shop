<input class="form-control" type="text" placeholder="@lang('custom::admin.Filter module name')" wire:model.lazy="data.name">
<h6>@lang('custom::admin.Filter Title')</h6>
<div class="row g-3 mt4">
    @foreach ($languages as $lang)
        <div class="col-xl-3 col-md-6">
        <div class="input-group">
            <span class="input-group-text">@lang('custom::admin.'.$lang->lang.'_short')</span>
            <input class="form-control" type="text" wire:model.lazy="data.{{$lang->lang}}.title" value="@lang('custom::admin.Title')">
        </div>
    </div>
    @endforeach
</div>
<h6>@lang('custom::admin.Filter settings for desktop')</h6>
<div class="desctop-view">
    <div class="desctop-view__box {{ $data['position'] }}" wire:ignore><span></span></div>
    <div class="desctop-view__list">
        <h6>@lang('custom::admin.Positioning')</h6>
        <ul>
            @foreach (\App\Models\Filter::POSITION_DESC as $item_pos)
            <li>
                <label class="radio">
                    <input class="radio__input" id="desctop-{{ $item_pos }}" type="radio" name="desctop-position"  onclick="@this.changeDataItem('position','{{$item_pos}}')" @if($data['position']===$item_pos) checked="checked" @endif><span class="radio__box">@lang('custom::admin.Column '.$item_pos)</span>
                </label>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<h6>@lang('custom::admin.Mobile filter settings permissions')</h6>
<ul class="list-clear my-4">
    <li>
        <div class="d-flex align-items-center">
            <img class="me-4" src="/admin/assets/img/swype.svg" alt="image"><label class="check --radio">
                <input class="check__input" type="checkbox" wire:model='data.show_mobile' />
                <span class="check__box">
                    @lang('custom::admin.Show Hide filter by swiping sideways')
                </span></label>
        </div>
    </li>
</ul>
<div class="mobile-view">
    <div class="mobile-view__box {{ $data['position_mobile'] }}" wire:ignore><span></span></div>
    <div class="mobile-view__list">
        <h6>@lang('custom::admin.Positioning')</h6>
        <ul>
            @foreach (\App\Models\Filter::POSITION_MOB as $item_pos1)
            <li>
                <label class="radio">
                    <input class="radio__input" id="desctop-position_mobile-{{ $item_pos1 }}" type="radio" name="desctop-position_mobile" onclick="@this.changeDataItem('position_mobile','{{$item_pos1}}')" @if($data['position_mobile']===$item_pos1) checked="checked" @endif><span class="radio__box">@lang('custom::admin.Column '.$item_pos1)</span>
                </label>
            </li>
            @endforeach
            </ul>
        </div>
    </div>
    <ul class="list-clear my-4">
        <li>
            <label class="check --radio" onclick="@this.changeDataItem('status','{{$data['status']==1 ? 0 : 1}}')">
                <input class="check__input" type="checkbox" @if($data['status']==1) checked @endif/>
                <span class="check__box">@lang('custom::admin.Switched on')</span>
            </label>
        </li>
    </ul>
    <div>
        @include('livewire.admin.includes.save-data-include',['wire_click'=>'saveData','title_button'=>__('custom::admin.Save')])

       {{-- <button class="button" type="button" wire:click="saveData">@if(isset($item_id)){{__('custom::admin.Save')}}@else{{__('custom::admin.Add')}}@endif</button>--}}
    </div>
