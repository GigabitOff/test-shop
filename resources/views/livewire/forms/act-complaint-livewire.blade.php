<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.complaint_act')<span>@lang('custom::site.on_project_domain')</span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="ico_close"></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="act-complaint-info">
                <span>№ {{$productSKU}}</span>
                <strong>{{$productName}}</strong></div>
        </div>
        <form>
            <div class="form-group">
                <div class="form-control-wrap">
                    <textarea class="form-control" name="messages"
                              wire:model.defer="message"
                              placeholder="@lang('custom::site.message')" required></textarea><span></span>
                </div>
                @error('message')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-4 mb-4">
                <div class="upload-file-block --small">
                    <div class="upload-file-block__btn">
                        <label class="upload-file-block__label">
                            <input class="upload-file-block__input" type="file" multiple
                                   wire:model="photos"
                                   name="upload-file"/>
                            <div class="upload-file-block__label-content"><span
                                    class="ico_plus"></span><span>@lang('custom::site.add_photo')</span></div>
                        </label>
                    </div>
                    @error('photos.*')
                    <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                    @enderror
                    <div class="upload-file-block__box">
                        @foreach($uploaded as $index => $photo)
                            <div class="upload-unit --small">
                                <div class="upload-unit__label">
                                    <div class="upload-unit__info">
                                        <div class="upload-unit__title">{{$photo->getClientOriginalName()}}</div>
                                        <div class="upload-unit__trash" wire:click="removePhoto({{$index}})"><i
                                                class="ico_close"></i></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <button class="button button-secondary button-block button-lg"
                        wire:loading.attr="disabled"
                        wire:click="sendForm"
                        type="button">@lang('custom::site.send_for_review')</button>
            </div>
        </form>
    </div>
</div>
