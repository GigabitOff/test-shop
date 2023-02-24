<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.Submit an application')
            <small>deks.ua</small>
        </h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="submit" enctype="multipart/form-data">
        <div class="form-group"><input class="form-control" type="text"  wire:model.lazy="fio"
                                       placeholder="@lang('custom::site.fio')" name="fio"
                                       required>
            @error('fio')
            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group"><input class="js-phone-short form-control" type="text"
                                       value="{{$phoneRaw}}"
                                       onchange="@this.set('phoneRaw', this.value)"
                                       name="phone" placeholder="@lang('custom::site.phone')" required>
            @error('phone')
            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
            @enderror

        </div>
        <div class="form-group"><input class="js-email form-control" type="text"
                                       wire:model.lazy="email"
                                       placeholder="Email"
                                       name="email" required>
            @error('email')
            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
            @enderror

        </div>
        <div class="form-group"><textarea class="form-control" type="text" type="text"
                                          wire:model.lazy="text"
                                          placeholder="@lang('custom::site.accompanying_text')"
                                          required></textarea>
            @error('text')
            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
            @enderror

        </div>
        <div class="form-group">
            <div class="upload-file-block --small">
                <div class="upload-file-block__btn"><label class="upload-file-block__label"><input
                                class="upload-file-block__input" wire:model="file"
                                id="customFile" type="file"/>

                        <div class="upload-file-block__label-content"><span
                                    class="ico_upload"></span><span>@lang('custom::site.Download resume')</span></div>
                    </label>
            @error('file')
            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
            @enderror
                </div>
                <div class="upload-file-block__box"></div>
            </div>
        </div>
        <div class="form-group">
            <button class="button-accent w-100" type="submit" wire:click="submit">@lang('custom::site.Send')</button>
        </div>
        </form>
    </div>
</div>

@push('custom-scripts')
<script>
    jQuery(document).ready(function ($) {
        window.addEventListener('clearJobApplicationForm', () => {
            $(".invalid-feedback").remove();
    });
    })
</script>
@endpush