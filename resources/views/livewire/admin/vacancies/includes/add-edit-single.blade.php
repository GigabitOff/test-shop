<div class="row  g-4">
    <div class="col-12">
        <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">
                @include('livewire.admin.includes.error-title')

    </div>
</div>

<div class="row  mt-4">
    <div class="col-9">
        <input  class="form-control @error('slug')error @endif" type="text" placeholder="Slug" wire:model="slug">
        @error('slug')
        <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-3"><input class="form-control" type="number" placeholder="@lang('custom::admin.Order')" wire:model="data.order"></div>
</div>
<div class="row  mt-4">

    <div class="col-4">
        {{-- @include('livewire.admin.includes.add-city-data', [
            'select_cities'=>(isset($select_array['city_id']) AND is_array($select_array['city_id'])) ? $select_array['city_id'] : $select_cities
            ])--}}
        @include('livewire.admin.includes.select-data-arrow',[
            'select_data_input'=>isset($select_data['city_id']) ? $select_data['city_id']: null,
            'select_data_array'=>(isset($select_array['city_id']) AND is_array($select_array['city_id'])) ? $select_array['city_id'] : $select_cities,
            'placeholder'=>__('custom::admin.shop_cities'),
            'index'=>'city_id',
            'searchSelectDataArrow' => 'title',
            //'hide_clear'=>(!isset($select_data['city_id']['input']) AND !isset($select_data['city_id']['id']) ? 'true' : 'null'),
            'show_title'=>true,
           // 'title_select' =>  (isset($select_data['city_id']) AND isset($select_data['city_id']['id'])) ? $select_data['city_id']['input']: null,

        ])
    </div>
    <div class="col-4">
        <input type="text" class="form-control @error('data.schedule') is-invalid @enderror" id="pageSchedule" placeholder="@lang('custom::admin.Schedule')"  wire:model="data.{{ session('lang')}}.schedule_lang">
    </div>
    <div class="col-4">
        <input type="text" class="form-control @error('data.whours') is-invalid @enderror" id="whours_lang" placeholder="@lang('custom::admin.Whours')"  wire:model="data.{{ session('lang')}}.whours_lang">
    </div>
    {{--<div class="col-6"><input class="form-control" type="text" placeholder="@lang('custom::admin.Slug')" wire:model="slug" ></div>
    <div class="col-4">
        <input type="text" class="form-control @error('data.whours') is-invalid @enderror" id="pageSchedule }}" placeholder="@lang('custom::admin.Employment type')"  wire:model="data.{{ session('lang')}}.employment_lang">
    </div>--}}

</div>
<div class="row mt-4">
    <div class="col-12" >
        <textarea id="data-{{session('lang')}}-description" class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                wire:model.lazy="data.{{session('lang')}}.description">
                @if(isset($data[session('lang')]['description']))
                {{ $data[session('lang')]['description'] }}
                @endif
        </textarea>
    </div>
</div>
<div class="row mt-4">
    @include('livewire.admin.includes.textarea-data-editor',['index_data'=>'body'])
</div>

    @for ($i = 1; $i <= 4; $i++)
    <div class="row mt-4" >
        <div class="col-3"  >
        @include('livewire.admin.includes.image-data-grow',['index'=>'image_'.$i,'title'=>__('custom::admin.Image').' '.$i])
        </div>
        <div class="col-4" >
        <input type="text" class="form-control @error('data.'.session('lang').'.title_image_'.$i) is-invalid @enderror" id="pageSchedule" placeholder="@lang('custom::admin.Title'){{ $i }}"
        wire:model="data.{{ session('lang')}}.title_image_{{ $i }}">

        </div>
        <div class="col-5" >
<input type="text" class="form-control @error('data.'.session('lang').'.text_image_'.$i) is-invalid @enderror" id="pageSchedule" placeholder="@lang('custom::admin.Description'){{ $i }}"
        wire:model="data.{{ session('lang')}}.text_image_{{ $i }}">
        </div>
    </div>
    @endfor

