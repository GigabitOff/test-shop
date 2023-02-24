<div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
<div class="row gx-4 gy-3">
    <div class="col-md-6">

        <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">

            @include('livewire.admin.includes.error-title')

    </div>
    <div class="col-md-6">
        {{-- <label for="menulug">Slug</label>--}}
            <input type="text" class="form-control @error('slug') is-invalid   @enderror" id="menulug" placeholder="Slug" wire:model="slug">
            @error('slug')
                    <div class="is-invalid ">
                        {{ $message }}
                    </div>
            @enderror
    </div>
    <div class="col-md-6">
            <input class="form-control" type="text" placeholder="@lang('custom::admin.age_limit')" wire:model.lazy="data.age_limit">
    </div>
    <div class="col-md-6">
            <input class="form-control" type="text" placeholder="@lang('custom::admin.Cost')" wire:model.lazy="data.price">
    </div>
    <div class="col-md-6">
            <input class="form-control" type="text" placeholder="@lang('custom::admin.quantity')" wire:model.lazy="data.quantity">
    </div>
    <div class="col-md-6">
        <input id="data_date_start_end" @error("data.date_start_end") style='border: 1px solid red' @enderror type="text" class="js-date-multy form-control" value="{{ isset($data['date_start']) ? $data['date_start'].' - ' : ''}}{{ isset($data['date_end']) ? $data['date_end'] : ''}}" />
        @include('livewire.admin.includes.calendar-form',['formId'=>'data_date_start_end','nameForm'=>'data.date_start_end','date_start'=>'data.date_start','date_end'=>'data.date_end','clear'=>false])
        <input type="hidden" wire:model="data.date_start">
        <input type="hidden" wire:model="data.date_end">
    </div>
    <div class="col-12">
        <textarea class="form-control" name="" cols="30" rows="10" placeholder="@lang('custom::admin.Description')" wire:model.lazy="data.{{session('lang')}}.description">
            @if(isset($data[session('lang')]['description']))
                {{ $data[session('lang')]['description'] }}
                @endif
        </textarea>
    </div>
    <div class="col-12" wire:ignore wire:key="data-page-{{session('lang')}}-body">
         <textarea id="data-{{session('lang')}}-body" class="form-control" rows="3" placeholder="@lang('custom::admin.Body')"
                wire:model.lazy="data.{{session('lang')}}.body">
                @if(isset($data[session('lang')]['body']))
                {{ $data[session('lang')]['body'] }}
                @endif
        </textarea>
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'data-'.session('lang').'-body', 'nameForm'=>'data.'.session('lang').'.body'])

    </div>
    <div class="row g-4">
        <div class="col-lg-6">
        <div class="row g-4">
            <div class="col-12">

                @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($data['category_id']) AND isset($select_data['category_id'][$data['category_id']]['input']) ? $select_data['category_id'][$data['category_id']]['input']: null),
                        'select_data_array'=>$select_array['category_id'],
                        'placeholder'=>__('custom::admin.Category for filter'),
                        'index'=>'category_id',
                        'show_name' => true,
                        'searchSelectDataArrow' => true,
                        'title_select' => (isset($data['category_id']) AND isset($select_data['category_id'][$data['category_id']]['input'])) ? $select_data['category_id'][$data['category_id']]['input'] : null,
                        'drop_list'=>'drop-list'])
                        @error('category')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @endif
            </div>
            <div class="col-lg-6">
            <label class="check --radio">
                    <input class="check__input" type="checkbox" @if(!isset($data['show_calendar']) OR $data['show_calendar'] == 0)  checked="checked" @endif onclick="@this.set('data.show_calendar',{{ (!isset($data['show_calendar']) OR $data['show_calendar'] == 0) ? 1 : 0 }});" wire:model="data.show_calendar">
                    <span class="check__box">@lang('custom::admin.show_calendar')</span>
                </label>
            </div>
            <div class="col-lg-6">
            <label class="check --radio">
                    <input class="check__input" type="checkbox" @if(!isset($data['abonement']) OR $data['abonement'] == 0)  checked="checked" @endif onclick="@this.set('data.abonement',{{ (!isset($data['abonement']) OR $data['abonement'] == 0) ? 1 : 0 }});" wire:model="data.abonement">
                    <span class="check__box">@lang('custom::admin.abonement')</span>
                </label>
            </div>
        </div>
        </div>
        <div class="col-lg-6">
                <div class="services-img-group">
                    @include('livewire.admin.includes.image-data-grow',[
                        'index'=>'image',
                        'title'=>__('custom::admin.Image'),

                        'grow'=>'--square'])

                    @include('livewire.admin.includes.image-data-grow',[
                        'index'=>'image_bg',
                        'title'=>__('custom::admin.Image bg'),
                        'grow'=>'--square'])
                </div>

        </div>
    </div>

    <div class="col-12" wire:ignore>
        @livewire('admin.catalog.services.service-search-product-livewire', ['item_id'=>$item_id,'action_data'=>(isset($dataPage) ? $dataPage : null )], key(time().'-action-search-product'))

    </div>
    <div class="col-12">
        <div class="page-save mt-2">
        @include('livewire.admin.includes.save-data-include',['wire_click'=>'saveData','title_button'=>__('custom::admin.Save')])
        </div>
    </div>

</div>
