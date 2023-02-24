
<div class="row">
    <div class="col-6">
        <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">
        @include('livewire.admin.includes.error-title')

    </div>
    <div class="col-6"><input class="form-control" type="text" placeholder="@lang('custom::admin.Slug')" wire:model="slug" disabled></div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <input class="form-control @error('data.'.session('lang').'.subtitle') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Subtitle')" wire:model.lazy="data.{{ session('lang')}}.subtitle">
    </div>
</div>
<div class="row mt-4">
    <h6>@lang('custom::admin.Description')</h6>
    <div class="col-12 textareEditor" wire:ignore>
        <textarea id="data-{{session('lang')}}-description" class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                wire:model.lazy="data.{{session('lang')}}.description">
                @if(isset($data[session('lang')]['description']))
                {{ $data[session('lang')]['description'] }}
                @endif
        </textarea>
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'data-'.session('lang').'-description', 'nameForm'=>'data.'.session('lang').'.description'])
    </div>
</div>
<div class="row mt-4">
    <h6>@lang('custom::admin.Body')</h6>
    <div class="col-12 textareEditor" wire:ignore>
        <textarea id="data-{{session('lang')}}-body" class="form-control" rows="3" placeholder="@lang('custom::admin.Body')"
                wire:model.lazy="data.{{session('lang')}}.body">
                @if(isset($data[session('lang')]['body']))
                {{ $data[session('lang')]['body'] }}
                @endif
        </textarea>
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'data-'.session('lang').'-body', 'nameForm'=>'data.'.session('lang').'.body'])
    </div>
</div>
<div class="row mt-4">

    <div class="col-8">
        @include('livewire.admin.includes.image-data-grow',['index'=>'image','title'=>__('custom::admin.Banner single'),'title_size'=>'1920х321 px'])
    </div>
            <div class="col-4"></div>
</div>
<div class="row mt-4">
    <div class="col-9">
        @include('livewire.admin.includes.image-data-grow',['index'=>'image_banner','title'=>__('custom::admin.Banner on main'),'title_size'=>'1920х321 px'])
    </div>
    <div class="col-3"></div>
</div>

<div class="row mt-4 " wire:ignore>
    <div class="col-3">
        @livewire('admin.settings.widgets.setting-single-item-livewire', [
            'page_id' => $data['id'],
            'placeholder' => '2640',
            'type' => 'image',
            'translatable' => false,
            'title' => '',
            'key'=>'delivery_payment_img_1'
        ], key(time().'-setting-delivery_payment_img_1'))
    </div>
    <div class="col-9">
        @livewire('admin.settings.widgets.setting-single-item-livewire', [
            'page_id' => $data['id'],
            'placeholder' => __('custom::admin.Address delivery'),
            'type' => 'text',
            'key'=>'delivery_payment_title_1'
        ], key(time().'-setting-delivery_payment_title_1'))

        <div class="mt-4">
        @livewire('admin.settings.widgets.setting-single-item-livewire', [
            'page_id' => $data['id'],
            'placeholder' => __('custom::admin.Address delivery'),
            'type' => 'textarea',
            'ckeditor'=>true,
            'key'=>'delivery_payment_text_1'
        ], key(time().'-setting-delivery_payment_text_1'))
        </div>
    </div>
</div>
<div class="row mt-4"  wire:ignore>
    <div class="col-3">
        @livewire('admin.settings.widgets.setting-single-item-livewire', [
            'page_id' => $data['id'],
            'placeholder' => '2640',
            'translatable' => false,
            'type' => 'image',
            'title' => '',
            'key'=>'delivery_payment_img_2'
        ], key(time().'-setting-delivery_payment_img_2'))
    </div>
    <div class="col-9">
    @livewire('admin.settings.widgets.setting-single-item-livewire', [
            'page_id' => $data['id'],
            'placeholder' => __('custom::admin.Delivery service'),
            'type' => 'text',
            'key'=>'delivery_payment_title_2'
        ], key(time().'-setting-delivery_payment_title_2'))
        <div class="mt-4">

        @livewire('admin.settings.widgets.setting-single-item-livewire', [
            'page_id' => $data['id'],
            'placeholder' => __('custom::admin.Delivery service'),
            'type' => 'textarea',
            'ckeditor'=>true,
            'key'=>'delivery_payment_text_2'
        ], key(time().'-setting-delivery_payment_text_2'))
        </div>

    </div>
</div>
<div class="row mt-4"  wire:ignore>
    <div class="col-3">
        @livewire('admin.settings.widgets.setting-single-item-livewire', [
            'page_id' => $data['id'],
            'placeholder' => __('custom::admin.Delivery service'),
            'type' => 'image',
            'translatable' => false,
            'title' => '',
            'key'=>'delivery_payment_img_3'
        ], key(time().'-setting-delivery_payment_img_3'))
    </div>
    <div class="col-9">
    @livewire('admin.settings.widgets.setting-single-item-livewire', [
            'page_id' => $data['id'],
            'placeholder' => __('custom::admin.Self-pickup'),
            'type' => 'text',
            'key'=>'delivery_payment_title_3'
        ], key(time().'-setting-delivery_payment_title_3'))
        <div class="mt-4">
        <div class="mt-4">
        @livewire('admin.settings.widgets.setting-single-item-livewire', [
            'page_id' => $data['id'],
            'placeholder' => __('custom::admin.Self-pickup'),
            'type' => 'textarea',
            'ckeditor'=>true,
            'key'=>'delivery_payment_text_3'
        ], key(time().'-setting-delivery_payment_text_3'))
    </div>
    </div>
</div>

@if(isset($success))
    <div>{{ $success }}</div>
@endif

</div>

