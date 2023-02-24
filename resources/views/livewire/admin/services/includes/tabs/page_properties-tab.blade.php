<div class="row g-4">
    <div class="col-12">
        <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror"
               type="text"
               placeholder="@lang('custom::admin.Title')"
               wire:model.lazy="data.{{ session('lang')}}.title">
        @include('livewire.admin.includes.error-title')
    </div>
    <div class="col-12">
        <textarea class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                  wire:model.lazy="data.{{session('lang')}}.description">
            @if(isset($data[session('lang')]['description']))
                {{ $data[session('lang')]['description'] }}
            @endif
        </textarea>
    </div>
    <div class="col-12" wire:ignore>
        <textarea id="page-item-data-{{session('lang')}}-body" class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                  wire:model.lazy="data.{{session('lang')}}.body">
                @if(isset($data[session('lang')]['body']))
                {{ $data[session('lang')]['body'] }}
            @endif
        </textarea>
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'page-item-data-'.session('lang').'-body', 'nameForm'=>'data.'.session('lang').'.body'])
    </div>
</div>
