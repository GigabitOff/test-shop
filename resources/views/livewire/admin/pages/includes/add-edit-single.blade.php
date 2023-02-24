@if($hide_lang === null)
<div wire:ignore class="row mb-3">
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
@endif

<div class="row g-4">

@if(isset($slug_select))
{{--<div class="col-12">
    <div>
        <label for="forParentPage" class="col-sm-3 col-form-label">@lang('custom::admin.Tipical slug'): </label>
        <select class="form-control" id="forParentPage" wire:model="slug_select_item">
            <option value="0">обрати</option>
            @foreach ($slug_select as $k_menu=>$item)
            <option value="{{ $k_menu }}" @if(isset($slug) AND $slug==$item) selected
            @endif>{{ $item }} </option>
            @endforeach
        </select>
    </div>
</div>--}}
@endif
<div class="col-12">
    {{--<label>@lang('custom::admin.Title')</label>--}}
    <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">
        @include('livewire.admin.includes.error-title')

</div>
<div class="col-12">
   {{-- <label for="menulug">Slug</label>--}}
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="menulug" placeholder="Slug" wire:model="slug">
</div>
</div>
@if($select_pages)
<div class="row mt-4">
    <div class="col-sm-9">
    <label for="forParentPage" class="col-sm-3 col-form-label">Включено в </label>
    </div>
    <div class="col-sm-9">
        <select class="form-control" id="forParentPage" wire:model="data.parent_id">
            <option value="0">обрати сторінку</option>
            @foreach ($select_pages as $item)
            <option value="{{ $item->id }}">{{ $item->title }} </option>
            @endforeach
        </select>
    </div>
</div>
@endif

{{--
<div class="row mt-3">

    <input type="text" class="form-control" id="pageH1{{session('lang')}}" placeholder="@lang('custom::admin.H1')" wire:model="data.{{session('lang')}}.h1">
</div>
    <div class="row  mt-3">
<div class="col-3">
    @include('livewire.admin.includes.image-data-grow',['index'=>'image','title'=>__('custom::admin.Image #1')])
</div>
</div>--}}

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
{{-- <div class="row g-4 mt-2 mb-2" wire:ignore >
    <span >
        <label class="check --radio" >
                <input class="check__input" type="checkbox" @if($data['status']==1) checked @endif
                wire:model="data.status"/>
                <span class="check__box">@lang('custom::admin.Switched on')</span>
        </label>
    </span>
</div> --}}
@if(!isset($hide_seo) OR $hide_seo === 'hide_button' ) {{-- OR $hide_seo === 'hide_button' --}}

@include('livewire.admin.includes.meta-data', ['lang'=>session('lang')])
@endif

@if(isset($hide_seo) AND $hide_seo !== 'hide_button' AND $hide_seo != 'hide_with_button' OR !isset($hide_seo))

<div class="d-flex justify-content-between mt-4">
        @include('livewire.admin.includes.save-data-include',['wire_click'=>"saveData",'title_button'=>__('custom::admin.Save')])
</div>
@endif

