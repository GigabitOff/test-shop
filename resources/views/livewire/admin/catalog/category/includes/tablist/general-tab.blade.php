
    <div class="form-group">
        <input class="form-control  @error('data.'.session('lang').'.name') is-invalid @enderror " type="text"  placeholder="@lang('custom::admin.Name category')"  wire:model.lazy="data.{{ session('lang') }}.name">
            @include('livewire.admin.includes.error-title',['index'=>'name'])

    </div>
    <div class="form-group row">
        <div class="col-10">
        <input class="form-control @error('slug') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.URL page')" wire:model="slug">
             @error('slug')
                <div class="is-invalid ">
                    {{$message}}
                </div>
                @php($error_data = true)
                @enderror

        </div>
        <div class="col-2">
            <input class="form-control" type="number" placeholder="@lang('custom::admin.The sort order')" wire:model="data.sort_order">

        </div>
    </div>
    {{--<div class="form-group">

        <input class="form-control @error('Url') is-invalid @enderror" type="text" placeholder="URL  страницы" value="{{ route('catalog.show', $slug)}}">
    <div class="form-group">
        <input class="form-control" type="text"  placeholder="@lang('custom::admin.products.Manufacture')"  wire:model="data.{{ session('lang') }}.manufacturer">
    </div>
    </div>
    --}}

    <div class="row mt-4">
    @include('livewire.admin.includes.textarea-data-editor',['placeholder'=>__('custom::admin.Tehnical Description'),'index_data'=>'technical_description'])
    </div>
    {{--<div class="row mt-4" wire:ignore>
    @include('livewire.admin.catalog.category.includes.add-related-category')
    </div>--}}

    <div class="row mt-4">
        <div class="form-group @error('parent_id') is-invalid @enderror">
            @include('livewire.admin.includes.select-data-arrow',[
                'select_data_input'=>(isset($data['parent_id']) AND isset($select_array['parent_id'][$data['parent_id']]['name'])) ? $select_array['parent_id'][$data['parent_id']]['name']: (isset($dataPage->selfCategory)  ? $dataPage->selfCategory->name : null),
                'select_data_array'=>isset($select_array['parent_id']) ? $select_array['parent_id'] : null,
                'placeholder'=>__('custom::admin.Add parent category'),
                'index'=>'parent_id',
                'title_select'=>(isset($data['parent_id']) AND isset($select_array['parent_id'][$data['parent_id']]['name'])) ? $select_array['parent_id'][$data['parent_id']]['name']: (isset($dataPage->selfCategory) AND $this->data['parent_id'] !=0 ? $dataPage->selfCategory->name : null),
                'show_name' => true,
                'dont_show_id' => isset($this->item_id)?$this->item_id:null,
                'key_for_select_array'=>'parent_id',
                'searchSelectDataArrow' => true,
                //'title_select' => (isset($data['parent_id']) AND $data['parent_id'] != 0 AND isset($allCategories[$data['parent_id']]['name'])) ? $allCategories[$data['parent_id']]['name'] :  (isset($dataPage->selfCategory) AND $data['parent_id'] != 0) ?  ($dataPage->selfCategory AND $dataPage->selfCategory->translate(session('lamg')) ? $dataPage->selfCategory->translate(session('lamg'))->name : $dataPage->selfCategory->name) : null,
                'drop_list'=>'drop-list'])
                  @error('category')
                  <div class="error">
                    {{ $message }}
                  </div>
                  @endif
    </div>
    </div>
        </div>
        <div class="form-group">
            <div class="row align-items-center">
                {{--<div class="col"><label class="check --radio" onclick="@this.changeDataItem('on_main',{{$data['on_main']!=0 ? 0 : 1}})" >
                    <input class="check__input" type="checkbox" @if(isset($data['on_main']) AND $data['on_main'] !== 0) checked="checked" @endif /><span class="check__box">@lang('custom::admin.Show to home')</span></label></div>--}}
                <div class="col">
                    <div class="form-group">
                @include('livewire.admin.includes.image-data-grow',[
                    'index'=>'image_small',
                    'title'=>__('custom::admin.Filter thumbnail'),
                    'grow'=>false,
                        'title_size' => 'svg',
                        'class'=>'--small',
                    ])
                    </div>
                </div>
                <div class="col">
                    @include('livewire.admin.includes.image-data-grow',[
                        'index'=>'image',
                        'title'=>__('custom::admin.Image to home'),
                        'grow'=>false,
                        'title_size' => 'svg',
                        'class'=>'--small',
                        ])
                </div>
            </div>
        </div>



      {{--  @include('livewire.admin.catalog.category.includes.block-social')--}}

        @include('livewire.admin.includes.meta-data', ['lang'=>session('lang')])


