<div wire:ignore>
    @livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
<div class="row g-3">
    <div class="col-xl-6">
        <div class="form-group">
            <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text"
                   placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">
            @include('livewire.admin.includes.error-title')
        </div>
        <div class="form-group">
            <input class="form-control" type="text" placeholder="@lang('custom::admin.Link')" wire:model="data.link">
        </div>
        <div class="row">

            <div class="col-6">
                @include('livewire.admin.includes.select-data-select',[
                    'select_data_input'=>($select_data['page_location_id'] ?? null),
                    'select_data_array'=> $pages_select ?? [],
                    'show_title'=>true,
                    'placeholder'=>__('custom::admin.Type of allocation'),
                    'index'=>'page_location_id',
                    'showKey' => true,
                    //'title_select' => isset($select_data['parent_id']) ? $select_data['page_id'] : null,
                    'drop_list'=>'drop-list'
                    ])

                @if($locationBannerBusyMsg)
                    <div class="is-invalid" style="display:block;">{{$locationBannerBusyMsg}}</div>
                @endif
            </div>
            <div class="col-6">
                <input class="form-control" type="text" placeholder="@lang('custom::admin.Price')">
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <textarea class="form-control" name="intro" style="min-height: 100%"
                  placeholder="@lang('custom::admin.Short description')"
                  wire:model="data.{{ session('lang')}}.description">
        </textarea>
    </div>
    <div class="col-xl-6">
        <p>@lang('custom::admin.User type')</p>
        <ul class="list-clear">
            @foreach(\App\Models\Banner::USER_TYPES as $userType)
            <li>
                <label class="radio">
                    <input class="radio__input" type="radio" name="category-name"
                           wire:model="data.user_type"
                           value="{{$userType}}"
                    />
                    <span class="radio__box">@lang("custom::admin.role.{$userType}")</span>
                </label>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="col-xl-6">
        @include('livewire.admin.includes.image-data-grow',['index'=>'image','title'=>__('custom::admin.Image')])
    </div>

    <div class="col-12">
        @include('livewire.admin.includes.save-data-include',['wire_click'=>"saveData",'title_button'=>__('custom::admin.Save')])

    </div>
</div>
