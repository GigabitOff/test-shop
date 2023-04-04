
<div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text"><span>@lang('custom::admin.Service name')</span></div>
        <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Service name')" wire:model.lazy="data.{{ session('lang')}}.title">

      </div>
            @include('livewire.admin.includes.error-title')
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.SEO Url')</span></div>
            <input class="form-control" type="text" placeholder="" wire:model.lazy="slug" value="text">
      </div>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.article')</span>
        </div>
        <input class="form-control" wire:model.lazy="data.article" type="text" placeholder="" value="text">
      </div>
    </div>
    <div class="form-group">

      <div class="input-group">
        <div class="input-group-text"><span>@lang('custom::admin.hashtag')</span></div>
        @include('livewire.admin.includes.hashtag',['key_tag'=>'search_tags'])
      </div>


    </div>

    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.supplier_internal')</span>
        </div>
        @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['counterparty_id']) ? $select_data['counterparty_id']: null),
                        'select_data_array'=>$counterparties_select, 'placeholder'=>__('custom::admin.Main counterparty'),
                        'index'=>'counterparty_id',
                        'show_name'=>true
                        ])
      </div>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.age_limit')</span>
        </div>
        <input class="form-control" type="text" wire:model.lazy="data.age_limit" placeholder="" value="text">
      </div>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text"><span>@lang('custom::admin.quantity')</span></div><input class="form-control" type="text" placeholder="" wire:model.lazy="data.quantity" value="text">
      </div>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text"><span>@lang('custom::admin.Date services from to')</span></div>
        <input id="data_date_start_end" @error("data.date_start_end") style='border: 1px solid red' @enderror type="text" class="js-date-multy form-control" value="{{ isset($data['date_start']) ? $data['date_start'].' - ' : ''}}{{ isset($data['date_end']) ? $data['date_end'] : ''}}" />
        @include('livewire.admin.includes.calendar-form',['formId'=>'data_date_start_end','nameForm'=>'data.date_start_end','date_start'=>'data.date_start','date_end'=>'data.date_end','clear'=>false])
        <input type="hidden" wire:model="data.date_start">
        <input type="hidden" wire:model="data.date_end">
      </div>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text"><span>@lang('custom::admin.Unit')</span></div><input class="form-control" type="text" wire:model.lazy="data.unit" placeholder="" value="text">
      </div>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text"><span>@lang('custom::admin.Service time (average)')</span></div>
        <input class="form-control" wire:model.lazy="data.service_time" type="text" placeholder="" value="text">
      </div>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text"><span>@lang('custom::admin.Note')</span></div>
        <input class="form-control" wire:model.lazy="data.{{ session('lang') }}.note" type="text" placeholder="" value="text">
      </div>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text"><span>@lang('custom::admin.Description')</span></div><input class="form-control" type="text" placeholder=""  wire:model.lazy="data.{{ session('lang') }}.description" value="text">
      </div>
    </div>
    <h6>@lang('custom::admin.Body')</h6>
    <div class="form-group" wire:ignore wire:key="data-page-{{session('lang')}}-body">
         <textarea id="data-{{session('lang')}}-body" class="form-control" rows="3" placeholder="@lang('custom::admin.Body')"
                wire:model.lazy="data.{{session('lang')}}.body">
                @if(isset($data[session('lang')]['body']))
                {{ $data[session('lang')]['body'] }}
                @endif
        </textarea>
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'data-'.session('lang').'-body', 'nameForm'=>'data.'.session('lang').'.body'])
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text">
            <span>@lang('custom::admin.Category for filter')</span>
        </div>
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
    </div>
    <div class="form-group">
        <label class="check">
            <input class="check__input" type="checkbox" @if(!isset($data['show_calendar']) OR $data['show_calendar'] == 0)  checked="checked" @endif onclick="@this.set('data.show_calendar',{{ (!isset($data['show_calendar']) OR $data['show_calendar'] == 0) ? 1 : 0 }});" wire:model="data.show_calendar">
            <span class="check__box"></span>
            <span class="check__txt">@lang('custom::admin.show_calendar')</span>
        </label>
    </div>
    <div class="form-group">
        <label class="check">
            <input class="check__input" type="checkbox" @if(!isset($data['abonement']) OR $data['abonement'] == 0)  checked="checked" @endif onclick="@this.set('data.abonement',{{ (!isset($data['abonement']) OR $data['abonement'] == 0) ? 1 : 0 }});" wire:model="data.abonement">
            <span class="check__box"></span>
            <span class="check__txt">@lang('custom::admin.abonement')</span>
        </label>
    </div>
    <div class="row g-3 mt-3" wire:ignore>
    @include('livewire.admin.catalog.services.includes.add-products')
</div>
    {{--<div class="form-group"><label class="check">
        <input class="check__input" type="checkbox" @if(!isset($data['product_with_service']) OR $data['product_with_service'] == 0)  checked="checked" @endif onclick="@this.set('data.product_with_service',{{ (!isset($data['product_with_service']) OR $data['product_with_service'] == 0) ? 1 : 0 }});" wire:model="data.product_with_service">
        <span class="check__box"></span>
        <span class="check__txt">@lang('custom::admin.The product is used with a service')</span></label></div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-text"><span>@lang('custom::admin.Count product')</span></div><input class="form-control" wire:model.lazy="data.product_count" type="text" placeholder="" value="text">
      </div>
    </div>--}}
</div>
