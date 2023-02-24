<div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
<div class="row g-3">
    <div class="col-xl-6">
        <div class="form-group">
            <input class="form-control @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Title')" wire:model.lazy="data.{{ session('lang')}}.title">
                @include('livewire.admin.includes.error-title')
        </div>
        <div class="form-group">
            <input class="form-control" type="text" placeholder="@lang('custom::admin.Link')" wire:model="data.link">
        </div>
        <div class="row">
            <div class="col-6">
                @include('livewire.admin.includes.select-data-select',[
                    'select_data_input'=>(isset($select_data['page_id']) ? $select_data['page_id']: null),
                    'select_data_array'=>isset($pages_select) ? $pages_select : [],
                    'show_title'=>true,
                    'placeholder'=>__('custom::admin.Type of allocation'),
                    'index'=>'page_id',
                    'showKey' => true,
                    //'title_select' => isset($select_data['parent_id']) ? $select_data['page_id'] : null,
                    'drop_list'=>'drop-list'
                    ])

            </div>
            <div class="col-6">
                <input class="form-control" type="text" placeholder="@lang('custom::admin.Price')">
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <textarea class="form-control" name="intro" style="min-height: 100%" placeholder="@lang('custom::admin.Short description')" wire:model="data.{{ session('lang')}}.description">
        </textarea>
    </div>
    <div class="col-xl-6">
        <p>@lang('custom::admin.User type')</p>
        <ul class="list-clear">
            <li><label class="radio"><input class="radio__input" type="radio" name="cataegory-name" @if(isset($data['user_type']) == '' OR !isset($data['user_type'])) checked="checked" @endif  onclick="@this.set('data.user_type','')" /><span class="radio__box">@lang('custom::admin.All users')</span></label></li>
                <li><label class="radio"><input class="radio__input" type="radio" name="cataegory-name" @if(isset($data['user_type']) == 'registered') checked="checked" @endif onclick="@this.set('data.user_type','registered')" /><span class="radio__box">@lang('custom::admin.Registered users')</span></label></li>
                <li><label class="radio"><input class="radio__input" type="radio" name="cataegory-name"  @if(isset($data['user_type']) == 'no-registered') checked="checked" @endif  onclick="@this.set('data.user_type','no-registered')" /><span class="radio__box">@lang('custom::admin.No Registered users')</span></label></li>
            </ul>
        </div>
        <div class="col-xl-6">
            @include('livewire.admin.includes.image-data-grow',['index'=>'image','title'=>__('custom::admin.Image')])
        </div>

    <div class="col-12">
    @include('livewire.admin.includes.save-data-include',['wire_click'=>"saveData",'title_button'=>__('custom::admin.Save')])

    </div>
</div>
