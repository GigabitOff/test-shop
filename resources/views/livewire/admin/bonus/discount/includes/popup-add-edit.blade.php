<div class="modal fade" id="m-add-banner" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('custom::admin.Banners')</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div wire:ignore>
                    @livewire('admin.partials.header-livewire', key(time().'header-livewire'))
                </div>
                <div id="message_banner" style="display: none; font-size: 18pt; color: red">
                    @lang('custom::admin.Data download in progress')
                </div>
                @if(session('success_add_data--hide'))
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-lable="close">
                                    <span aria-hidden="true">x</span>
                                </button>
                                {{ session()->get('success_add_data') }}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <div class="tab-content">
                        <div class="fade show active" id="banner-website" role="tabpanel" aria-labelledby="banner-all_data">
                            <div class="add-img --bottom">
                                @include('livewire.admin.includes.add-file-data',['index'=>'imageUpload'])
                                <div class="add-img__info">
                                    <div class="add-img__title">@lang('custom::admin.Banners image')</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="tab-content">
                        <div class="fade show active" id="banner-website" role="tabpanel" aria-labelledby="banner-all_data">
                            <div class="add-img --bottom">
                                @include('livewire.admin.includes.add-file-data',['index'=>'imageUploadBg'])
                                <div class="add-img__info">
                                    <div class="add-img__title">@lang('custom::admin.Banners bg')</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control  @error('data.'.session('lang').'.title') is-invalid @enderror" type="text" placeholder="@lang('custom::admin.Text')"
                           wire:model.lazy="data.{{ session('lang')}}.title">
                            @include('livewire.admin.includes.error-title')
                </div>
                <div class="form-group">
                    <textarea class="form-control"  placeholder="@lang('custom::admin.Text')"
                              wire:model.lazy="data.{{ session('lang')}}.description"></textarea>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="@lang('custom::admin.Link to go')"
                           wire:model.lazy="data.{{ session('lang')}}.url"></div>
                <div class="form-group">
                    <input class="form-control" type="number" placeholder="@lang('custom::admin.Order')"
                           wire:model.lazy="data.newOrder"></div>
                <div class="mt-4">
                    <button class="button w-100" type="button"
                          @if(!isset($error_data))  wire:click="saveData"
{{--                            @if($item_id) wire:click="updateData()" @else wire:click="createData()" @endif--}}
{{--                            onclick="changeTableFoot(0, 'table-all_data'); "--}}
                           @endif >@lang('custom::admin.Save')</button>
                </div>
            </div>
        </div>
    </div>
</div>
