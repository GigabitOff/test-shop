<div class="row mt-4">
<div class="col-12">
    {{--<label>@lang('custom::admin.Title')</label>--}}
    <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">
        @include('livewire.admin.includes.error-title')

</div>
<div class="col-12 mt-4">
   {{-- <label for="menulug">Slug</label>--}}
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="menulug" placeholder="Slug" wire:model="slug">
</div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <textarea class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
            wire:model.lazy="data.{{session('lang')}}.description">
            @if(isset($data[session('lang')]['description']))
            {{ $data[session('lang')]['description'] }}
            @endif
        </textarea>
    </div>
</div>
<div class="row mt-4 textareEditor mb-4" wire:ignore>
    <div class="col-12" >
        <textarea id="page-item-data-{{session('lang')}}-body" class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                wire:model.lazy="data.{{session('lang')}}.body">
                @if(isset($data[session('lang')]['body']))
                {{ $data[session('lang')]['body'] }}
                @endif
        </textarea>
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'page-item-data-'.session('lang').'-body', 'nameForm'=>'data.'.session('lang').'.body'])
    </div>
</div>
