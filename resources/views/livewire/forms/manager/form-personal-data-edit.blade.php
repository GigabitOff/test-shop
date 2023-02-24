<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">{{__('custom::site.personal_data_edit')}}<span>{{__('custom::site.on_project_domain')}}</span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                class="ico_close"></span></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="submit" class="alert-scroll-top">
            @if(session()->has('edit_success'))
                <div class="alert alert-success" role="alert">
                    {{ session('edit_success') }}
                </div>
            @endif
            <div class="form-group">
                <div class="js-edit-img edit-img ">
                    <!--suppress CssUnknownTarget -->
                    <div class="edit-img__img"
                         style="background-image: url({{$avatar_url}})"></div>
                    <div class="edit-img__add"><input class="js-add-img" wire:model="avatar" type="file"><span
                            class="ico_plus"></span></div>
                    <div class="edit-img__action" @if($avatar_exist) style="display: block;" @endif>
                        <div class="action-group">
                            <button class="action-group-btn"
                                    style="border:none;"
                                    type="button"
                                    wire:click="removeAvatar">
                                <span class="ico_trash"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-wrap"><input class="form-control" type="text" name="fio"
                                                      wire:model.defer="name_uk"
                                                      placeholder="П.И.Б" required><span></span></div>
            </div>
            <div class="form-group">
                <div class="form-control-wrap"><input class="form-control" type="text" name="fio"
                                                      wire:model.defer="name_ru"
                                                      placeholder="Ф.И.О" required><span></span></div>
            </div>
            <div class="form-group">
                <div class="form-control-wrap"><input class="form-control" type="text" name="fio"
                                                      wire:model.defer="name_en"
                                                      placeholder="N.Sn" required><span></span></div>
            </div>
            <div class="form-group">
                <div class="form-control-wrap"><input class="js-phone form-control" type="text"
                                                      wire:model.defer="phone_raw"
                                                      name="phone" placeholder="{{__('custom::site.phone')}}"
                                                      required><span></span>
                </div>
                @error('phone')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="form-control-wrap"><input class="js-email form-control" type="text"
                                                      wire:model.defer="email"
                                                      placeholder="@lang('custom::site.Email')" name="email"
                                                      required><span></span>
                </div>
                @error('email')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-5">
                <button class="button button-secondary button-block button-lg" type="submit">
                    {{__('custom::site.save')}}
                </button>
            </div>
        </form>
    </div>
</div>
