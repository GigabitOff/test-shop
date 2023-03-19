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
                    <input class="js-phone form-control @error('data.phone') is-invalid @enderror" type="text" name="phone" placeholder="@lang('custom::site.phone')" onkeypress="@this.set('data.phone',this.value)"  required>
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
                <div class="form-group"><button class="button-accent w-100" type="button" wire:click="submit" {{--data-bs-dismiss="modal" --}}>@lang('custom::site.Send')</button></div>
        </form>
    </div>
</div>
