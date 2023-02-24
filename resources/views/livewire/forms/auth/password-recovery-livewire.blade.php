<div class="modal-content" id="modal-password-recovery-content" data-mode="{{$mode}}">
    <div class="modal-header">
        <h5 class="modal-title">
            {{$this->getModalTitle()}}
            <small>@lang('custom::site.on_project_domain')</small>
        </h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body" data-focusable="phone">
        <form autocomplete="off" class="needs-validation" novalidate wire:submit.prevent="submit">
            <div class="form-group __show">
                <p>{!! $this->getPromptMessage() !!}</p>
            </div>

            <div class="form-group @if($this->isRecoveryMode()) __show @endif">
                <input class="form-control js-phone @error('phone') is-invalid @enderror"
                       placeholder="@lang('custom::site.phone')"
                       onchange="@this.set('phoneRaw', this.value)"
                       value="{{$phoneRaw}}"
                       name="phone" required type="text">
                <div class="invalid-feedback">@error('phone'){{$message}}@enderror</div>
            </div>
            @if($reasonMessage && $this->isRecoveryMode())
                <div class="form-group __show">
                    <p>{!! $reasonMessage !!}</p>
                </div>
            @endif

            <div class="form-group @if($this->isVerificationMode()) __show @endif">
                <input class="form-control verification-focusable  @error('code') is-invalid @enderror"
                       name="phone-verification"
                       placeholder="@lang('custom::site.password')"
                       wire:model.defer="code"
                       autocomplete="new-password"
                       required type="password"><span></span>
                <div class="password-control"></div>
                <div class="invalid-feedback">@error('code'){{$message}}@enderror</div>
            </div>

            <div class="form-group @if($this->isRecoveryMode()) __show @endif">
                <button class="button-accent w-100"
                        onclick="document.passwordRecoveryForm.submitClick(this)"
                        type="submit">@lang('custom::site.send_password')
                </button>
            </div>

            <div class="form-group @if($this->isVerificationMode()) __show @endif">
                <button class="button-accent w-100"
                        onclick="document.passwordRecoveryForm.submitClick(this)"
                        type="submit">@lang('custom::site.do_confirm')</button>
                <button class="button-outline w-100 mt-1"
                        wire:click="back()"
                        type="button">@lang('custom::site.back')</button>
            </div>
        </form>
    </div>
</div>

@push('custom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Возможность устанавливать фокус на элемент при обновлении livewire компонента
            // для этого корневого тега должен стоять аттрибут data-mode
            // а єлемента должен быть класс {mode}-focusable
            Livewire.hook('message.processed', function (message, component) {
                if ('modal-password-recovery-content' === component.el.getAttribute('id')) {
                    const $comp = $(component.el);
                    const mode = $comp.attr('data-mode')
                    if (mode !== undefined && $comp.find(`.${mode}-focusable`).length) {
                        setTimeout(() => $comp.find(`.${mode}-focusable`).eq(0).focus(), 100);
                    }
                }
            })
        });

        document.passwordRecoveryForm = {
            submitClick: (button) => {
                @this.
                set('phoneRaw', $(button).closest('form').find('input[name=phone]').val());
            }
        }

        //# sourceURL=password-recovery.js
    </script>

    <style>
        #m-password-recovery .form-group {
            display: none;
        }

        #m-password-recovery .form-group.__show {
            display: block;
        }
    </style>
@endpush
