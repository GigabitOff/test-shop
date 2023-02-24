<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link @if('main'=== $show_lang) active @endif" id="nav-main-tab" data-toggle="tab" href="#nav-main" wire:click="changeLangTab('main')" role="tab" aria-controls="nav-main" aria-selected="false" style="color: black;">
        <span class="nav-item-text">Загальні дані</span>
    </a>
    <a class="nav-item nav-link @if('products'=== $show_lang) active @endif" id="nav-products-tab" data-toggle="tab" href="#nav-products" wire:click="changeLangTab('products')" role="tab" aria-controls="nav-products" aria-selected="false" style="color: black;">
        <span class="nav-item-text">@lang('custom::admin.Products select')</span>
    </a>
    @foreach($languages as $key=>$lang)
    <a class="nav-item nav-link @if($key===$show_lang) active @endif" id="nav-{{$lang->lang}}-tab" data-toggle="tab" href="#nav-{{$lang->lang}}" wire:click="changeLangTab({{$key}},'{{ $lang->lang}}')" role="tab" aria-controls="nav-{{$lang->lang}}" aria-selected="false" style="color: black;">
        <span class="nav-item-text"> {{ $lang->name }}</span>
    </a>
    @endforeach
</div>

<div class="tab-content" id="nav-tabContent">
    <div class="card card-primary tab-pane fade @if('main'=== $show_lang) show active @endif" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab">
        <div class="card-body col-9">

        <div class="form-group">
        <label for="pageTitle{{ app()->currentLocale() }}">
                    @lang('custom::admin.Title')
        </label>
        <input type="text" class="form-control @error('data.{{ app()->currentLocale() }}.title') is-invalid @enderror" id="pageTitle{{app()->currentLocale() }}" placeholder="@lang('custom::admin.Title')"  wire:model="data.{{ app()->currentLocale() }}.title">
        </div>
        <div class="form-group">
            <label for="date_start">
                @lang('custom::admin.Date start')
            </label>
            <input type="text" class="calendar_date form-control @error('data.date_start') is-invalid @enderror" id="date_start" placeholder="@lang('custom::admin.Date start')"
            wire:model="data.date_start">
        </div>
        <div class="form-group">
            <label for="date_end">
                @lang('custom::admin.Date end')
            </label>
            <input type="text" class="calendar_date form-control @error('data.date_end') is-invalid @enderror" id="date_end" placeholder="@lang('custom::admin.Date end')"
            wire:model="data.date_end">
        </div>
        <div class="form-group">
            @include('livewire.admin.includes.add-image-data',
                    ['index'=>'image','titleImage'=>"Зображення глобально"])
        </div>
        <div class="form-group">
            <label for="menulug">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="menulug"
                placeholder="Slug" wire:model="slug">
        </div>
            <div class="form-group" wire:ignore>
                <label>Статус</label>
                    <span onclick="@this.changeStatusAll('status');">
                    <input type="checkbox" wire:model="data.status" checked data-toggle="toggle" data-on="Активно" data-off="Не активно" data-size="sm">
                </span>
            </div>
        </div>
    </div>
    <div class="card card-primary tab-pane fade @if('products'=== $show_lang) show active @endif" id="nav-products" role="tabpanel" aria-labelledby="nav-products-tab">
        <div class="card-body col-9">
            @include('livewire.admin.actions.includes.add-products')
        </div>
    </div>
    @foreach($languages as $key=>$item_lang)
    <div class="tab-pane fade @if($key===$show_lang) show active @endif" id="nav-{{$item_lang->lang}}" role="tabpanel" aria-labelledby="nav-{{$item_lang->lang}}-tab">
        <div class="form-group">
            <label for="pageTitle{{$item_lang->lang}}">
                @lang('custom::admin.Title')
            </label>
            <input type="text" class="form-control @error('data.{{$item_lang->lang}}.title') is-invalid @enderror" id="pageTitle{{$item_lang->lang}}" placeholder="@lang('custom::admin.Title')"
            wire:model="data.{{$item_lang->lang}}.title">
        </div>

        <div class="form-group">
            @include('livewire.admin.includes.add-img-locale',
                    ['index'=>'img','lang'=>'{{$item_lang->lang}}','titleImage'=>"Зображення локально"])
        </div>
        <div class="form-group">
            <label>@lang('custom::admin.Description')</label>
            <textarea class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                wire:model.lazy="data.{{$item_lang->lang}}.description">
                @if(isset($data[$item_lang->lang]['description']))
                {{ $data[$item_lang->lang]['description'] }}
                @endif
            </textarea>
        </div>
        <div class="input-group mb-2" wire:ignore>
            <div class="input-group-prepend">
                <label for="data-{{$item_lang->lang}}-body" class="input-group-text">@lang('custom::admin.Body')</label>
            </div>
            <textarea class="form-control" cols="30" rows="10" id="data-{{$item_lang->lang}}-body" data-description="@this" type="text" wire:model="data.{{$item_lang->lang}}.body">
                @if(!empty(@$data[$item_lang->lang]['body']))
                {{ $data[$item_lang->lang]['body'] }}
                @endif
            </textarea>
        </div>
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'data-'.$item_lang->lang.'-body', 'nameForm'=>'data.'.$item_lang->lang.'.body'])
        @include('livewire.admin.includes.meta-data', ['lang'=>$item_lang->lang])
    </div>
    @endforeach
    <div class="card-footer">
        <button type="button" class="btn btn-primary"
        wire:click="saveData">@lang('custom::admin.Save')</button>
    </div>


</div>
<script>
    document.addEventListener('click', function () {
    $('.calendar_date').mask("00.00.0000");
    });
</script>
