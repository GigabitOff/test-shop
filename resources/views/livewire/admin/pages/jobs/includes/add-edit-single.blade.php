
<div>

    <div class="row">
        <div class="col-6">
            <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">
                        @include('livewire.admin.includes.error-title')

        </div>
    <div class="col-6">
            <input class="form-control" disabled type="text" placeholder="@lang('custom::admin.Slug')" wire:model.lazy="slug">
        {{--<input class="form-control" type="text" placeholder="@lang('custom::admin.Slug')" wire:model="slug" disabled>--}}
    </div>

    </div>
    <div class="row mt-4">
        <div class="col-12">
            <input class="form-control" type="text" placeholder="@lang('custom::admin.Slogan')" wire:model.lazy="data.{{session('lang')}}.slogan">
       </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <input class="form-control" type="text" placeholder="@lang('custom::admin.Slogan description')" wire:model.lazy="data.{{session('lang')}}.slogan_description">
        </div>
    </div>
    {{--<div class="row mt-4">
        <div class="col-12">
            <input class="form-control" type="text" placeholder="@lang('custom::admin.Short description')" wire:model.lazy="data.{{session('lang')}}.description">

    </div>
    </div>--}}
    <div class="row mt-4">
    <div class="col-12">
        <input class="form-control" type="text" placeholder="@lang('custom::admin.Main block header')" wire:model.lazy="data.{{session('lang')}}.subtitle">

    </div>
    </div>
    {{--<div class="row mt-4">
    <div class="col-12" wire:ignore wire:key="-setting-job_main_block">
        @livewire('admin.settings.widgets.setting-single-item-livewire', [
                'page_id' => $data['id'],
                'placeholder' => __('custom::admin.Main block header'),
                'type' => 'text',
                'key'=>'job_title_main_block'
            ], key(time().'-setting-job_title_main_block'))
    </div>
    </div>--}}
    <div class="row mt-4">
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
        {{--<div class="col-lg-7">
            @include('livewire.admin.includes.image-data-grow',['index'=>'image_small','title'=>__('custom::admin.Image #1')])
        </div>--}}
        <div class="col-lg-7">
            @include('livewire.admin.includes.image-data-grow',['index'=>'image','title'=>__('custom::admin.Banner image')])
        </div>
       {{-- <div class="col-6" wire:ignore wire:key="-setting-job_title_image">
            <div >
        @livewire('admin.settings.widgets.setting-single-item-livewire', [
                'page_id' => $data['id'],
                'placeholder' => __('custom::admin.Image caption #2'),
                'type' => 'text',
                'key'=>'job_title_image_2'
            ], key(time().'-setting-job_title_image_2'))
            </div>

            <div class="mt-4">
        @livewire('admin.settings.widgets.setting-single-item-livewire', [
                'page_id' => $data['id'],
                'placeholder' => __('custom::admin.Image text info #2'),
                'type' => 'text',
                'key'=>'job_description_image_2'
            ], key(time().'-setting-job_description_image_2'))
            </div>
    </div>--}}
    </div>
    <div wire:ignore wire:key="-setting-block">

    @if(!$no_reset)

    @for ($i = 1; $i <= 4; $i++)
    <div class="row mt-4" >
        <div class="col-lg-4"  >
            @livewire('admin.settings.widgets.setting-single-item-livewire', [
                'page_id' => $data['id'],
                'placeholder' => __('custom::admin.Image').' '.$i,
                'type' => 'image',
                'grow' => false,
                'class' => '--vacancies',
                'title' => __('custom::admin.Image').' '.$i,
                'translatable'=>false,
                'key'=>'job_image_'.$i
            ], key(time().'-setting-job_image_'.$i))
        </div>
        <div class="col-lg-8" >
            <div class="row g-4">
                    <div class="col-12">
                    @livewire('admin.settings.widgets.setting-single-item-livewire', [
                'page_id' => $data['id'],
                'placeholder' => __('custom::admin.Title').' '.$i,
                'type' => 'text',
                'key'=>'job_title_'.$i
            ], key(time().'-setting-job_title_'.$i))
                    </div>
                    <div class="col-12">
                        @livewire('admin.settings.widgets.setting-single-item-livewire', [
                'page_id' => $data['id'],
                'placeholder' => __('custom::admin.Description').' '.$i,
                'type' => 'textarea',
                'key'=>'job_description_'.$i
                ], key(time().'-setting-job_description_'.$i))
                    </div>
                  </div>

        </div>

    </div>
    @endfor
    @endif
    </div>


</div>

