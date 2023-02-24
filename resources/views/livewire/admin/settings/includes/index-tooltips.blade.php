<p>@lang('custom::admin.settings.Your bonnus helps')</p>
<textarea class="form-control" placeholder="@lang('custom::admin.Description')"
          wire:model.lazy="data.pop_up_fields.pop_up_fields-1.{{session('lang')}}">
    {{ isset($data['pop_up_fields']['pop_up_fields-2'][session('lang')]) ? $data['pop_up_fields']['pop_up_fields-2'][session('lang')] : ''}}
            </textarea>
<p>@lang('custom::admin.settings.Bonus program (hint)')</p>
<textarea class="form-control" placeholder="@lang('custom::admin.settings.Description')"
          wire:model.lazy="data.pop_up_fields.pop_up_fields-2.{{session('lang')}}">
    {{ isset($data['pop_up_fields']['pop_up_fields-2'][session('lang')]) ? $data['pop_up_fields']['pop_up_fields-2'][session('lang')] : ''}}
            </textarea>
<p>@lang('custom::admin.settings.Minimal order price')</p>
<input class="form-control"
       type="text"
       placeholder="@lang('custom::admin.settings.Set price')"
       wire:model.lazy="data.pop_up_fields.pop_up_fields-3.{{session('lang')}}">
