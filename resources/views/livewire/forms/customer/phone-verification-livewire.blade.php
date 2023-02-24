<div class="modal-content" id="modal-phone-verification-content" data-mode="{{$mode}}">
    @if($isUploadLazyContent)
        <div class="modal-header">
            <h5 class="modal-title">{{__('custom::site.phone_verification')}}<span>{{__('custom::site.on_project_domain')}}</span></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                    class="ico_close"></span></button>
        </div>
        <div class="modal-body" data-focusable="phone">
            <form autocomplete="off" class="needs-validation" novalidate wire:submit.prevent="submit">
                @if(session()->has('fail'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('fail') }}
                    </div>
                @endif
                @if(session()->has('fail_customer'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('fail_customer') }}
                    </div>
                    {{-- Не отображаем содержимое окна при ошибке загрузки--}}
                @else

                    <div class="form-group">
                        <p>{{$prompt}}</p>
                    </div>
                    <div class="form-group" @if('verification' !== $mode) style="display: none" @endif>
                        <div class="form-control-wrap">
                            <input class="form-control js-input-clear verification-focusable"
                                   name="phone-verification"
                                   placeholder="{{__('custom::site.password')}}"
                                   wire:model.defer="code"
                                   autocomplete="off"
                                   required type="text"><span></span>
                        </div>
                        @error('code')
                        <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group" @if('prompt' !== $mode) style="display: none" @endif>
                        <button class="button button-secondary button-block button-lg prompt-focusable"
                                wire:click="sendCode"
                                onkeyup="if(event.keyCode===13){event.target.click()}"
                                type="button">
                            {{__('custom::site.do_confirm')}}
                        </button>
                    </div>

                    <div class="form-group" @if('verification' !== $mode) style="display: none" @endif>
                        <button class="button button-secondary button-block button-lg"
                                type="submit">
                            {{__('custom::site.do_confirm')}}
                        </button>
                    </div>
                @endif
            </form>
        </div>
    @endif
</div>

@push('custom-scripts')
    <script>
        Livewire.on('eventPersonalDataChanged', () => {
            $('#modal-phone-verification').modal('hide');
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Возможность устанавливать фокус на элемент при обновлении livewire компонента
            // для этого корневого тега должен стоять аттрибут data-mode
            // а єлемента должен быть класс {mode}-focusable
            Livewire.hook('message.processed', function (message, component) {
                if ('modal-phone-verification-content' === component.el.getAttribute('id')) {
                    const $comp = $(component.el);
                    const mode = $comp.attr('data-mode')
                    if (mode !== undefined && $comp.find(`.${mode}-focusable`).length) {
                        setTimeout(() => $comp.find(`.${mode}-focusable`).eq(0).focus(), 100);
                    }
                }
            })
        });
        //# sourceURL=phone-verification_main.js
    </script>
@endpush
