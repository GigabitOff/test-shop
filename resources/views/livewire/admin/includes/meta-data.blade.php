@if(!isset($hide_seo) OR $hide_seo !== true)
@if($hide_lang === 'show_in_seo')
<div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
@endif
<div class="mt-4 mb-4">
    @php($seo_url=1)
    @if(isset($seo_url))
    <div class="form-group mt-4">
        {{--<label for="seo_url-{{ $lang }}">
            @lang('custom::admin.SEO Url')
        </label>--}}
        <input type="text" class="form-control" id="seo_url-{{$lang}}" placeholder="@lang('custom::admin.SEO Url')" wire:model.lazy="data.{{$lang}}.seo_url">
        @error('data.'.$lang.'.seo_url')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    @endif
    <div class="form-group mt-4">
        {{--<label for="seo_h1-{{ $lang }}">
            @lang('custom::admin.SEO H1')
        </label>--}}
        <input type="text" class="form-control" id="seo_h1-{{$lang}}" placeholder="@lang('custom::admin.SEO H1')" wire:model.lazy="data.{{$lang}}.seo_h1">
        @error('data.'.$lang.'.seo_h1')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group mt-4">
        {{--<label for="seo_h2-{{ $lang }}">
            @lang('custom::admin.SEO H2')
        </label>--}}
        <input type="text" class="form-control" id="seo_h2-{{$lang}}" placeholder="@lang('custom::admin.SEO H2')" wire:model.lazy="data.{{$lang}}.seo_h2">
        @error('data.'.$lang.'.seo_h2')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group mt-4">
        {{--<label for="seo_h3-{{ $lang }}">
            @lang('custom::admin.SEO H3')
        </label>--}}
        <input type="text" class="form-control" id="seo_h3-{{$lang}}" placeholder="@lang('custom::admin.SEO H3')" wire:model.lazy="data.{{$lang}}.seo_h3">
        @error('data.'.$lang.'.seo_h3')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group mt-4">
       {{-- <label for="meta_title{{ $lang }}">
            @lang('custom::admin.Meta title')
        </label>--}}
        <input type="text" class="form-control" id="meta_title{{$lang}}" placeholder="@lang('custom::admin.Meta title')" wire:model.lazy="data.{{$lang}}.meta_title">
        @error('data.'.$lang.'.meta_title')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group mt-4">
        {{--<label>@lang('custom::admin.Meta Description')</label>--}}
        <input type="text" class="form-control" id="meta_description{{$lang}}" placeholder="@lang('custom::admin.Meta Description')" wire:model.lazy="data.{{$lang}}.meta_description">
    </div>
    <div class="form-group mt-4">
        <input type="text" class="form-control" id="meta_keywords{{$lang}}" placeholder="@lang('custom::admin.Meta keywords')" wire:model.lazy="data.{{$lang}}.meta_keywords">
    </div>
    <div class="form-group mt-4" >
        {{--<label>@lang('custom::admin.Meta keywords')</label>--}}
        <input type="text" class="form-control" id="seo_canonical{{$lang}}" placeholder="@lang('custom::admin.SEO cononical')" wire:model.lazy="data.{{$lang}}.seo_canonical">
    </div>
    </div>

@endif
