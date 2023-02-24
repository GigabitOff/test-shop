<div class="modal-content" id="modal-quick-purchase-content" data-mode="{{$status}}">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.quick_purchase')<span>@lang('custom::site.on_project_domain')</span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                class="ico_close"></span></button>
    </div>
    <div class="modal-body">
        <form action="javascript:void(0);" wire:submit.prevent="submit">
            @if(session()->has('fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('fail') }}
                </div>
            @endif
            <div class="form-group">
                <div class="form-control-wrap">
                    <input class="form-control" type="text"
                           wire:model.defer="name"
                           placeholder="@lang('custom::site.fio')" name="fio"
                           required><span></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-control-wrap">
                    <input class="js-phone form-control" type="text"
                           wire:model.lazy="phone_raw"
                           name="phone" placeholder="@lang('custom::site.phone')"
                           required><span></span></div>
                @error('phone')
                <div class="invalid-feedback" style="display:block;">
                    {{$message}}
                </div>
                @enderror
                @if($proposeMsg)
                <div class="invalid-feedback" style="display:block;">
                    {{$proposeMsg}} @lang('custom::site.propose') <a href="javascript:void(0);" data-dismiss="modal" data-toggle="modal" data-target="#modal-login">@lang('custom::site.to_login')</a>
                </div>
                @endif
                @if($invalidMsg)
                <div class="invalid-feedback" style="display:block;">
                    {{$invalidMsg}} @lang('custom::site.choose_another')
                </div>
                @endif
                <script>
                    $('#modal-quick-purchase-content .js-phone').mask("+38/999/ 999 99 99");
                </script>
            </div>
            <div class="form-group">
                <div class="form-control-wrap">
                    <input class="form-control" type="text"
                           wire:model.defer="company"
                           placeholder="@lang('custom::site.company_name')" name="company"
                    ><span></span></div>
            </div>
            <div class="form-group" style="display: none;">
                <div class="form-control-wrap">
                    <input class="form-control" type="text"
                           wire:model.defer="product_id"
                           name="product_id"
                    ><span></span></div>
            </div>
            <div class="mt-5">
                <button class="button button-secondary button-block button-lg" type="submit">
                    @lang('custom::site.to_order')
                </button>
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
                if ('modal-quick-purchase-content' === component.el.getAttribute('id')) {
                    const $comp = $(component.el);
                    const mode = $comp.attr('data-mode')
                    if (mode !== undefined && $comp.find(`.${mode}-focusable`).length) {
                        setTimeout(() => $comp.find(`.${mode}-focusable`).eq(0).focus(), 100);
                    }
                }
            })
        });
        //# sourceURL=purchase-success-modal.js
    </script>
@endpush
