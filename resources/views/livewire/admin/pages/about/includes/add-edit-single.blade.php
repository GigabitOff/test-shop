<div class="row">
    <div class="col-6">
        <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">
        @include('livewire.admin.includes.error-title')

    </div>
    <div class="col-6"><input class="form-control" type="text" placeholder="@lang('custom::admin.Slug')" wire:model="slug" disabled></div>
</div>
<div class="row  mt-4">
    <div class="col-12">
        <input class="form-control @error('data.'.session('lang').'.subtitle') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Subtitle')" wire:model.lazy="data.{{ session('lang')}}.subtitle">
    </div>
</div>
<div class="row  mt-4" >
    <div class="col-12 textareEditor" wire:ignore>

        <textarea  class="form-control" id="data-{{session('lang')}}-description" rows="3" placeholder="@lang('custom::admin.Description')"
            wire:model.lazy="data.{{session('lang')}}.description">
            @if(isset($data[session('lang')]['description']))
            {{ $data[session('lang')]['description'] }}
            @endif
        </textarea>

        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'data-'.session('lang').'-description', 'nameForm'=>'data.'.session('lang').'.description'])

    </div>
</div>
<div class="row  mt-4">
    <div class="col-12">
        <input class="form-control @error('data.'.session('lang').'.title_description') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.title_description')" wire:model.lazy="data.{{ session('lang')}}.title_description">
    </div>
</div>
<div class="row mt-4" >
    <div class="col-12 textareEditor" wire:ignore>
        <textarea id="data-{{session('lang')}}-body" class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
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
        @include('livewire.admin.includes.image-data-grow',['index'=>'image','title'=>__('custom::admin.Banner single')])
    </div>
    <div class="col-4"></div>
</div>
<div  wire:ignore class="mt-4">

<h6>@lang('custom::admin.Benefits #1')</h6>
<div class="row mt-4">
    <div class="col-6">
        <div class="row g-3">
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => '2640',
                    'type' => 'image',
                    'title' => '',
                    'translatable' => false,
                    'key'=>'about_benefits1_image_1'
                    ], key(time().'-setting-about_benefits1_image_1'))
            </div>
            <div class="col-6">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Count'),
                    'type' => 'text',
                    'key'=>'about_benefits1_count'
                    ], key(time().'-setting-about_kompaniya_v_cifrax_1'))
            </div>
            <div class="col-6"></div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.The value of preference'),
                    'type' => 'text',
                    'key'=>'about_benefits1_title'
                    ], key(time().'-setting-about_benefits1_title'))
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row g-3">
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => '2640',
                    'type' => 'image',
                    'title' => '',
                    'translatable' => false,
                    'key'=>'about_benefits1_image_2'
                    ], key(time().'-setting-about_benefits1_image_2'))
            </div>
            <div class="col-6">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Count'),
                    'type' => 'text',
                    'key'=>'about_benefits1_count2'
                    ], key(time().'-setting-about_kompaniya_v_cifrax_2'))

            </div>
            <div class="col-6"></div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.The value of preference'),
                    'type' => 'text',
                    'key'=>'about_benefits1_title_2'
                    ], key(time().'-setting-about_benefits1_title2'))

            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-6" >
        <div class="row g-3">
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => '2640',
                    'type' => 'image',
                    'title' => '',
                    'translatable' => false,
                    'key'=>'about_benefits1_image_3'
                    ], key(time().'-setting-about_benefits1_image_3'))
            </div>
            <div class="col-6">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Count'),
                    'type' => 'text',
                    'key'=>'about_benefits1_count3'
                    ], key(time().'-setting-about_kompaniya_v_cifrax_3'))
            </div>
            <div class="col-6"></div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.The value of preference'),
                    'type' => 'text',
                    'key'=>'about_benefits1_title_3'
                    ], key(time().'-setting-about_value_title_3'))
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row g-3">
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => '2640',
                    'type' => 'image',
                    'title' => '',
                    'translatable' => false,
                    'key'=>'about_benefits1_image_4'
                    ], key(time().'-setting-about_benefits1_image_4'))
            </div>
            <div class="col-6">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Count'),
                    'type' => 'text',
                    'key'=>'about_benefits1_count4'
                    ], key(time().'-setting-about_kompaniya_v_cifrax_4'))
            </div>
            <div class="col-6"></div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.The value of preference'),
                    'type' => 'text',
                    'key'=>'about_benefits1_title_4'
                    ], key(time().'-setting-about_value_title_4'))
            </div>
        </div>
    </div>
</div>
<h6>@lang('custom::admin.Benefits #2')</h6>


    <div class="row mt-4" >
        <div class="col-6">
        <div class="row g-3">
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => '2640',
                    'type' => 'image',
                    'title' => '',
                    'translatable' => false,
                    'key'=>'about_benefits2_image_1'
                    ], key(time().'-setting-about_benefits1_image_1'))
            </div>
            <div class="col-6">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Count'),
                    'type' => 'text',
                    'key'=>'about_benefits2_count1'
                    ], key(time().'-setting-about_benefits2_count1'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.The value of preference'),
                    'type' => 'text',
                    'key'=>'about_benefits2_title_1'
                    ], key(time().'-setting-about_benefits2_title_1'))
            </div>
        </div>
    </div>
    <div class="col-6">
            <div class="row g-3">
                <div class="col-12">
                    @livewire('admin.settings.widgets.setting-single-item-livewire', [
                        'page_id' => $data['id'],
                        'placeholder' => '2640',
                        'type' => 'image',
                        'title' => '',
                        'translatable' => false,
                        'key'=>'about_benefits2_image_2'
                        ], key(time().'-setting-about_benefits1_image_2'))
                </div>
                <div class="col-6">
                    @livewire('admin.settings.widgets.setting-single-item-livewire', [
                        'page_id' => $data['id'],
                        'placeholder' => __('custom::admin.Count'),
                        'type' => 'text',
                        'key'=>'about_benefits2_count2'
                        ], key(time().'-setting-about_advantages_2'))
                </div>
                <div class="col-12">
                    @livewire('admin.settings.widgets.setting-single-item-livewire', [
                        'page_id' => $data['id'],
                        'placeholder' => __('custom::admin.The value of preference'),
                        'type' => 'text',
                        'key'=>'about_benefits2_title_2'
                        ], key(time().'-setting-about_benefits2_title_2'))
                </div>
            </div>
        </div>
        <div class="col-6">
        <div class="row g-3 mt-1">
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => '2640',
                    'type' => 'image',
                    'title' => '',
                    'translatable' => false,
                    'key'=>'about_benefits2_image_3'
                    ], key(time().'-setting-about_benefits1_image_3'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Count'),
                    'type' => 'text',
                    'key'=>'about_benefits2_count3'
                    ], key(time().'-setting-about_benefits2_count3'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.The value of preference'),
                    'type' => 'text',
                    'key'=>'about_benefits2_title_3'
                    ], key(time().'-setting-about_benefits2_title_3'))
            </div>
        </div>
        </div>
        <div class="col-6">
        <div class="row g-3  mt-1">
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => '2640',
                    'type' => 'image',
                    'title' => '',
                    'translatable' => false,
                    'key'=>'about_benefits2_image_4'
                    ], key(time().'-setting-about_benefits1_image_4'))
            </div>
            <div class="col-6">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Count'),
                    'type' => 'text',
                    'key'=>'about_benefits2_count4'
                    ], key(time().'-setting-about_advantages_4'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.The value of preference'),
                    'type' => 'text',
                    'key'=>'about_benefits2_title_4'
                    ], key(time().'-setting-about_benefits2_title_4'))
            </div>
        </div>
    </div>
    </div>
    <h6>@lang('custom::admin.How we are working')</h6>
<div class="row mt-4">
    <div class="col-12">

        <div class="row g-3">
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Title'),
                    'type' => 'text',
                    'key'=>'about_working_title'
                    ], key(time().'-setting-about_working_title'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Description'),
                    'type' => 'textarea',
                    'ckeditor' => true,
                    'key'=>'about_working_description'
                    ], key(time().'-setting-about_working_description'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => '2640',
                    'type' => 'image',
                    'title' => __('custom::admin.Image'),
                    'translatable' => false,
                    'key'=>'about_working_image'
                    ], key(time().'-setting-about_working_image'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Url YouTube'),
                    'type' => 'text',
                    'translatable' => false,
                    'key'=>'about_working_url'
                    ], key(time().'-setting-about_working_url'))
            </div>

        </div>
    </div>

</div>
<h6>@lang('custom::admin.5 block')</h6>
<div class="row mt-4">
    <div class="col-12">

        <div class="row g-3">
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Title'),
                    'type' => 'text',
                    'key'=>'about_5_block_title'
                    ], key(time().'-setting-about_5_block_title'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Description'),
                    'type' => 'textarea',
                    'ckeditor' => true,
                    'key'=>'about_5_block_description'
                    ], key(time().'-setting-about_5_block_description'))
            </div>
            <div class="col-4">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => '2640',
                    'type' => 'image',
                    'title' => __('custom::admin.Image'),
                    'translatable' => false,
                    'key'=>'about_5_block_image'
                    ], key(time().'-setting-about_5_block_image'))
            </div>
            <div class="col-4">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => 'Icon',
                    'type' => 'image',
                    'title' => __('custom::admin.Icon'),
                    'translatable' => false,
                    'key'=>'about_5_block_icon'
                    ], key(time().'-setting-about_5_block_icon'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Subtitle'),
                    'type' => 'text',
                    'key'=>'about_5_block_subtitle'
                    ], key(time().'-setting-about_5_block_subtitle'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Description'),
                    'type' => 'textarea',
                    'key'=>'about_5_block_short_description'
                    ], key(time().'-setting-about_5_block_short_description'))
            </div>

        </div>
    </div>

</div>
<h6>@lang('custom::admin.6 block')</h6>
<div class="row mt-4">
    <div class="col-12">

        <div class="row g-3">
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Title'),
                    'type' => 'text',
                    'key'=>'about_6_block_title'
                    ], key(time().'-setting-about_6_block_title'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Description'),
                    'type' => 'textarea',
                    'ckeditor' => true,
                    'key'=>'about_6_block_description'
                    ], key(time().'-setting-about_6_block_description'))
            </div>
            <div class="col-4">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => '2640',
                    'type' => 'image',
                    'title' => __('custom::admin.Image'),
                    'translatable' => false,
                    'key'=>'about_6_block_image'
                    ], key(time().'-setting-about_6_block_image'))
            </div>
            <div class="col-4">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => 'Icon',
                    'type' => 'image',
                    'title' => __('custom::admin.Icon'),
                    'translatable' => false,
                    'key'=>'about_6_block_icon'
                    ], key(time().'-setting-about_6_block_icon'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Subtitle'),
                    'type' => 'text',
                    'key'=>'about_6_block_subtitle'
                    ], key(time().'-setting-about_5_block_subtitle'))
            </div>
            <div class="col-12">
                @livewire('admin.settings.widgets.setting-single-item-livewire', [
                    'page_id' => $data['id'],
                    'placeholder' => __('custom::admin.Description'),
                    'type' => 'textarea',
                    'key'=>'about_6_block_short_description'
                    ], key(time().'-setting-about_6_block_short_description'))
            </div>

        </div>
    </div>

</div>
</div>
{{--
<div class="row mt-4">
    @include('livewire.admin.includes.meta-data', ['lang'=>session('lang')])
</div>--}}



