@if($hide_lang === null)
<div wire:ignore class="row mb-3">
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
@endif
<ul class="nav nav-tabs" role="tablist">

        <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($collapse_show)  AND $collapse_show==='all-info')active @endif" type="button" role="tab"  onclick="@this.selectTab('all-info')">
            <span @if($error_data_title) style=" color: red;" @endif>
            @lang('custom::admin.General information')
            </span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($collapse_show) AND $collapse_show==='page-data')active @endif"  type="button" role="tab"  onclick="@this.selectTab('page-data')" >
            @lang('custom::admin.SEO data')
        </button>
    </li>
    </ul>
    <div class="product-info tab-content mt-4">
        <div class="tab-pane fade @if(isset($collapse_show) AND $collapse_show==='all-info')show active @endif" id="all-info" role="tabpanel">
        <div >
            <div class="row g-4">

<div class="col-md-6">
    {{--<label>@lang('custom::admin.Title')</label>--}}
    <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">
        @include('livewire.admin.includes.error-title')

</div>
<div class="col-md-6">
    <input class="form-control" type="text" placeholder="Slug"  wire:model.lazy="slug">
@error('slug')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
</div>

</div>

<div class="row mt-4 textareEditor" wire:ignore>
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
        </div>
        </div>
        <div  class="tab-pane fade @if(isset($collapse_show)  AND $collapse_show==='page-data')show active @endif" id="page-data" role="tabpanel"  >
            @if(!isset($hide_seo) )
<div class="row g-4">
    <div class="col-md-12">
    <input type="text" class="form-control @error('seo_url') is-invalid @enderror" id="menuseo_url" placeholder="@lang('custom::admin.Slug')" wire:model.lazy="data.{{session('lang')}}.seo_url">
    </div>

    <div class="col-md-12">
        <input type="text" class="form-control" id="seo_h1-{{session('lang')}}" placeholder="@lang('custom::admin.SEO H1')" wire:model.lazy="data.{{session('lang')}}.seo_h1">
        @error('data.'.session('lang').'.seo_h1')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <input type="text" class="form-control" id="seo_h2-{{session('lang')}}" placeholder="@lang('custom::admin.SEO H2')" wire:model.lazy="data.{{session('lang')}}.seo_h2">
        @error('data.'.session('lang').'.seo_h2')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <input type="text" class="form-control" id="seo_h3-{{session('lang')}}" placeholder="@lang('custom::admin.SEO H3')" wire:model.lazy="data.{{session('lang')}}.seo_h3">
        @error('data.'.session('lang').'.seo_h3')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <input type="text" class="form-control" id="meta_title{{session('lang')}}" placeholder="@lang('custom::admin.Meta title')" wire:model.lazy="data.{{session('lang')}}.meta_title">
        @error('data.'.session('lang').'.meta_title')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-12">
        <input type="text" class="form-control" id="meta_description{{session('lang')}}" placeholder="@lang('custom::admin.Meta Description')" wire:model.lazy="data.{{session('lang')}}.meta_description">
    </div>
    <div class="col-md-12">
        <input type="text" class="form-control" id="meta_keywords{{session('lang')}}" placeholder="@lang('custom::admin.Meta keywords')" wire:model.lazy="data.{{session('lang')}}.meta_keywords">
    </div>
    <div class="col-md-12">
        <input type="text" class="form-control" id="seo_canonical{{session('lang')}}" placeholder="@lang('custom::admin.SEO cononical')" wire:model.lazy="data.{{session('lang')}}.seo_canonical">
    </div>

          </div>
@endif
        </div>
    </div>




@if(isset($hide_seo) AND $hide_seo !== 'hide_button' OR !isset($hide_seo))

<div class="d-flex justify-content-between mt-4">
        @include('livewire.admin.includes.save-data-include',['wire_click'=>"saveData",'url_set'=>route('admin.shop_cities.index'),'title_button'=>__('custom::admin.Save')])
</div>
@endif
