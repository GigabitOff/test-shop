 <div class="dropify-group">
                    <div>
                      <h6>@lang('custom::admin.settings.images_icons_logo')</h6>
                      <div class="--square">
                        @include('livewire.admin.includes.add-file-data',['index'=>'image_logo','ext_check'=>['svg']])
                    </div>
                    </div>
                    <div>
                      <h6>@lang('custom::admin.settings.images_icons_favico')</h6>
                      <div class="--square">
                    @include('livewire.admin.includes.add-file-data',['index'=>'image_favico','ext_check'=>['svg']])
                  </div>
                  </div>
                  <div>
                <h6>@lang('custom::admin.settings.images_icons_preloader')</h6>
                      <div class="--square">
                    @include('livewire.admin.includes.add-file-data',['index'=>'image_preloader','ext_check'=>['svg']])
                  </div>
                    </div>
                  </div>
