<div class="row gx-4 gy-3">
    <div class="col-lg-6">
        <div class="form-group">
            <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror"
                   type="text"
                   placeholder="@lang('custom::admin.Title')"
                   wire:model.lazy="data.{{ session('lang')}}.title">
            @include('livewire.admin.includes.error-title')
        </div>
        <div class="row gx-4">
            <div class="col-lg-8">
                <div class="form-group">
                    <input class="form-control @error('data.slug') is-invalid @enderror"
                           type="text"
                           wire:model="data.slug"
                           id="slug" placeholder="Slug">
                    @error('data.slug')
                    <div class="is-invalid"> {{$message}} </div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <input class="form-control" type="number"
                           wire:model.lazy="data.order"
                           placeholder="@lang('custom::admin.Order')">
                </div>
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                      wire:model.lazy="data.{{session('lang')}}.description">
            </textarea>
        </div>
        <div class="form-group">
            @include('livewire.admin.includes.image-data-grow',[
                'grow' => false,
                'index'=>'image',
//                'title_size'=>'480х300 px',
                'title'=>__('custom::admin.Image')
            ])

            @include('livewire.admin.includes.image-data-grow',[
                'grow' => false,
                'index'=>'icon',
//                'title_size'=>'480х300 px',
                'title'=>__('custom::admin.Icon')
            ])

        </div>
        <div class="form-group">
            <input class="form-control"
                   type="text"
                   placeholder="@lang('custom::admin.Link')"
                   wire:model.lazy="data.{{ session('lang')}}.url">
        </div>
    </div>
    <div class="col-lg-6 textareEditor" wire:ignore>
        <textarea
            id="page-item-data-{{session('lang')}}-body"
            class="form-control"
            rows="3"
            placeholder="@lang('custom::admin.Description')"
            wire:model.lazy="data.{{session('lang')}}.body">
                            {{ $data[session('lang')]['body'] ?? '' }}
        </textarea>
        @include('livewire.admin.includes.ckeditor-form', [
                'formId'=>'page-item-data-'.session('lang').'-body',
                'nameForm'=>'data.'.session('lang').'.body'
        ])
    </div>
</div>
