<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Задати питання<small>test.f-m.kiev.ua</small></h5><button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        @if(session()->has('chat_message_fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('chat_message_fail') }}
                </div>
            @endif

            @if(session()->has('chat_message_success'))
                <div class="alert alert-success" role="alert">
                    {{ session('chat_message_success') }}
                </div>
            @endif
        <form >
                <div class="form-group">
                    <input class="form-control @error('data.fio') is-invalid @enderror" type="text" name="fio" wire:model.lazy="data.fio"
                placeholder="@lang('custom::site.fio')" required>
                @error('data.fio')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <input class="form-control" type="hidden" name="popup_id"
                wire:model.defer="data.popup_id"
                placeholder="popup id" required>
                <div class="form-group"  wire:ignore wire:key="pone-product">
                    <input class="js-phone form-control @error('data.phone') is-invalid @enderror" type="text" id="dataPhone" placeholder="@lang('custom::site.phone')" onkeypress="@this.set('data.phone',this.value)"  required>
                </div>
                 @error('data.phone')
                        <div class="invalid-feedback" style="display:block;">
                            {{$message}}
                        </div>
                        @enderror
                <div class="form-group">
                    <input class="form-control @error('data.email') is-invalid @enderror" type="text" name="email"
                    wire:model.lazy="data.email" placeholder="E-mail" required>
                    @error('data.email')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="text" name="message" wire:model.lazy="data.message"
                placeholder="@lang('custom::site.text_message')" required></textarea>
                </div>
                <div class="form-group">
            <div class="upload-file-block --small">
                <div class="upload-file-block__btn"><label class="upload-file-block__label"><input
                                class="upload-file-block__input" wire:model="data.files"
                                id="customFile" type="file"/>

                        <div class="upload-file-block__label-content"><span
                                    class="ico_upload"></span><span>@lang('custom::site.Download resume')</span></div>
                    </label>
            @error('data.files')
            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
            @enderror
                </div>
                <div class="upload-file-block__box" wire:ignore></div>
            </div>
        </div>
                <div class="form-group"><button class="button-accent w-100" type="button" wire:click="submit" {{--data-bs-dismiss="modal" --}}>@lang('custom::site.Send')</button></div>
        </form>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        $(".ico_close").on('click', function(event){
            @this.set('files',null);
            //(... rest of your JS code)
        });
    });

    document.addEventListener('resetForm', event => {
        $('.js-phone').val('');

    });
    jQuery(document).ready(function ($) {
        $('body').on('change', '.product-full__counter input.input-col', function (event) {
            var minimum = parseInt($(this).attr("min") ? $(this).attr("min") : 1);
            var count = parseInt($(this).val());
            if (count < minimum) {
                $(this).val(minimum);

            } else if (count % minimum) { // РЅРµ РєСЂР°С‚РЅРѕ
                var qauntity = Math.ceil(count / minimum);
                $(this).val(minimum * qauntity);
            }
            //console.log('change number ' + minimum * qauntity);
        });
        $('body').on('click', '.product-full__counter .minus', function (event) {
            var $input = $(this).parent().find('input');
            var minimum = parseInt($input.attr("min") ? $input.attr("min") : 1);
            var count = parseInt($input.val()) - minimum;
            count = count < minimum ? minimum : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('body').on('click', '.product-full__counter .plus', function (event) {
            var $input = $(this).parent().find('input');
            var minimum = parseInt($input.attr("min") ? $input.attr("min") : 1);
            $input.val(parseInt($input.val()) + minimum);
            $input.change();
            return false;
        });
    });
    </script>
</div>
