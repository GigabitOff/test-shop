@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
<div class="row g-3">
    <div class="col-xl-6">
        @foreach ($this->languages as $item)
        <div class="form-group">
            <div class="input-group"><span class="input-group-text">@lang('custom::admin.Option name ('.$item->lang.')')</span><input class="form-control" type="text" value="@lang('custom::admin.Option name')" wire:model="data.{{ $item->lang}}.name"></div>
        </div>
        @endforeach
        </div>
    <div class="col-xl-6"></div>

</div>
<ul class="list-clear my-4">
        <li>
            <label class="check --radio" onclick="@this.changeDataItem('basic','{{isset($data['basic']) AND $data['basic']==1 ? 0 : 1}}')">
                <input class="check__input" type="checkbox" @if(isset($data['basic']) AND $data['basic']==1) checked @endif wire:model="data.basic"/>
                <span class="check__box">@lang('custom::admin.Basic attribute')</span>
            </label>
        </li>
    </ul>
<a class="button" href="#!" wire:click="saveData">@lang('custom::admin.Save')</a>

