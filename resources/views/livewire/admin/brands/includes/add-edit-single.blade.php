<div class="row">
    <div class="col-6">
        <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text"
               placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">
        @include('livewire.admin.includes.error-title')
    </div>
    <div class="col-6">
        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="menulug" placeholder="Slug"
               wire:model="slug">
        @error('slug')
        <div class="is-invalid ">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="row mt-4">
    {{--<div class="col-6">
        <input class="form-control" type="text" placeholder="@lang('custom::admin.Description')" wire:model="data.{{ session('lang')}}.description">
    </div>--}}
    <div class="col-3">
        <input id="data_date_start_end" @error("data.create_year") style='border: 1px solid red' @enderror type="number"
               class="form-control" value="{{ isset($data['create_year']) ? $data['create_year'] : ''}}"
               placeholder="@lang('custom::admin.Create year')" wire:model="data.create_year"/>
        {{-- @include('livewire.admin.includes.calendar-form',['formId'=>'data_date_start_end','nameForm'=>'data.create_year','date_start'=>'data.create_year','single'=>'single','clear'=>false])
         <input type="hidden" wire:model="data.create_year">--}}
        @error('data.create_year')
        <div class="is-invalid ">
            @lang('custom::admin.error_messages.year format')
        </div>
        @php($error_data = true)
        @enderror
    </div>
    <div class="col-3">
        <input class="form-control" type="number"
               placeholder="@lang('custom::admin.Order')"
               wire:model="data.order">
    </div>
</div>
<div class="row mt-4">
    <div class="col-4">
        @include('livewire.admin.includes.image-data-grow',['index'=>'image_small','title'=>__('custom::admin.Preview Image'),'grow'=>false])
    </div>
    <div class="col-8">
        {{--
        @include('livewire.admin.includes.image-data-grow',['index'=>'image','title'=>__('custom::admin.Image for the card'),'title_size'=>'1920х400 px'])
        --}}
    </div>
</div>
<div class="row mt-4">
    <div class="col-12 textareEditor" wire:ignore>
        <textarea id="data-{{session('lang')}}-description" class="form-control" rows="3"
                  placeholder="@lang('custom::admin.Description')"
                  wire:model.lazy="data.{{session('lang')}}.description">
                @if(isset($data[session('lang')]['description']))
                {{ $data[session('lang')]['description'] }}
            @endif
        </textarea>
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'data-'.session('lang').'-description', 'nameForm'=>'data.'.session('lang').'.description'])
    </div>
</div>
<div class="row " wire:ignore wire:key="script-brand">
    {{--<div class="form-group col-12">
        <div class="input-group">
            <div class="input-group-text">
                <span>@lang('custom::admin.Search tags')</span></div>
                <input class="js-tags form-control"  type="text" placeholder="Text" value = "{{@$data['searches']}}">
        </div>
    </div>

       {{-- <div class="form-group mt-4"><button class="button" type="button">Добавить</button></div>--}}

    <script>
        /* ---------------------------- Tags в поле input --------------------------- */


    </script>
</div>
<div class="row mt-4">
    @include('livewire.admin.brands.includes.add-products')
</div>

@include('livewire.admin.includes.meta-data', ['lang'=>session('lang')])

