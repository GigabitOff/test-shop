<div class="form-group">
    <input class="form-control @error('data.'.session('lang').'.name') is-invalid @enderror"
           type="text"
           placeholder="@lang('custom::admin.Title')"
           wire:model.lazy="data.{{ session('lang')}}.name">
    @include('livewire.admin.includes.error-title', ['index' => 'name'])
</div>
<div class="form-group">
    <input class="form-control @error('data.slug') is-invalid @enderror"
           type="text"
           wire:model="data.slug"
           id="slug" placeholder="Slug">
    @error('data.slug')
    <div class="is-invalid"> {{$message}} </div>
    @enderror
</div>
<div class="form-group">
    <input class="form-control"
           type="text"
           wire:model="data.min"
           placeholder="@lang('custom::admin.min_value')">
</div>
<div class="form-group">
    <input class="form-control"
           type="text"
           wire:model="data.max"
           placeholder="@lang('custom::admin.max_value')">
</div>
<div class="form-group">
    <x-livewire.admin.drop-select
        model="data.basic"
        :value="$this->getBasicValue()"
        :list="$this->getBasicList()"
        :disabled="!empty($attribute)"
    >
    </x-livewire.admin.drop-select>
</div>

