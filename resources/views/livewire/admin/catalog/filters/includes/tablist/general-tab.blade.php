<input class="form-control @error('data.name')is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Filter module name')" wire:model.lazy="data.name">
@error('data.name')
                <div class="is-invalid ">
                    {{$message}}
                </div>
                @php($error_data = true)
                @enderror
<div class="form-group mt-4 @error('category_id') is-invalid @enderror">
            @include('livewire.admin.includes.select-data-arrow',[
                'select_data_input'=>(isset($data['category_id']) AND isset($select_data['category_id'][$data['category_id']]['input']) ? $select_data['category_id'][$data['category_id']]['input']: null),
                'select_data_array'=>$select_array['category_id'],
                'placeholder'=>__('custom::admin.Category for filter'),
                'index'=>'category_id',
                'show_name' => true,
                'title_select' => (isset($data['category_id']) AND isset($select_data['category_id'][$data['category_id']]['input'])) ? $select_data['category_id'][$data['category_id']]['input'] : null,
                'drop_list'=>'drop-list'])
                  @error('category')
                  <div class="error">
                    {{ $message }}
                  </div>
                  @endif
    </div>

<h6>@lang('custom::admin.Filter Title')</h6>
<div class="row g-3 mt4">
            <input class="form-control" type="text" wire:model.lazy="data.{{session('lang')}}.title" value="@lang('custom::admin.Title')">
        </div>
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
{{--<h6>@lang('custom::admin.Mobile filter settings permissions')</h6>--}}
{{--<ul class="list-clear my-4">--}}
{{--    <li>--}}
{{--        <div class="d-flex align-items-center">--}}
{{--            <img class="me-4" src="/admin/assets/img/swype.svg" alt="image"><label class="check --radio">--}}
{{--                <input class="check__input" type="checkbox" wire:model='data.show_mobile' />--}}
{{--                <span class="check__box">--}}
{{--                    @lang('custom::admin.Show Hide filter by swiping sideways')--}}
{{--                </span></label>--}}
{{--        </div>--}}
{{--    </li>--}}
{{--</ul>--}}
{{--<div class="mobile-view">--}}
{{--    <div class="mobile-view__box {{ $data['position_mobile'] }}"><span></span></div>--}}
{{--    <div class="mobile-view__list">--}}
{{--        <h6>@lang('custom::admin.Positioning')</h6>--}}
{{--        <ul>--}}
{{--            @foreach (\App\Models\Filter::POSITION_MOB as $item_pos1)--}}
{{--            <li>--}}
{{--                <label class="radio">--}}
{{--                    <input class="radio__input" id="desctop-position_mobile-{{ $item_pos1 }}" type="radio" name="desctop-position_mobile" onclick="@this.changeDataItem('position_mobile','{{$item_pos1}}')" @if($data['position_mobile']===$item_pos1) checked="checked" @endif><span class="radio__box">@lang('custom::admin.Column '.$item_pos1)</span>--}}
{{--                </label>--}}
{{--            </li>--}}
{{--            @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}


