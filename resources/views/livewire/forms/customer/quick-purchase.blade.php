<div class="modal-content" id="modal-quick-purchase-content" data-mode="{{$status}}">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.quick_purchase')<small>@lang('custom::site.on_project_domain')</small></h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="submit">
            @if(session()->has('fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('fail') }}
                </div>
            @endif
            <div class="form-group">
                    <input class="form-control" type="text"
                           wire:model.defer="name"
                           placeholder="@lang('custom::site.fio')" name="name"
                           required>
            </div>
            <div class="form-group">
                    <input class="js-phone form-control" type="text"
                           wire:model.defer="phone_raw"
                           onchange="@this.set('phone_raw', this.value)"
                           name="phone" placeholder="@lang('custom::site.phone')"
                           required>
                @error('phone')
                <div class="invalid-feedback" style="display:block;">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                    <textarea class="form-control"
                           wire:model.defer="comment"
                           onchange="@this.set('comment', this.value)"
                           placeholder="@lang('custom::site.Comment')" name="comment"
                    ></textarea>
            </div>
            <div class="form-group">
                <button class="button-outline w-100" type="submit">@lang('custom::site.to_order')</button>
            </div>
        </form>
    </div>
</div>

@push('custom-scripts')
    <script>
        $('#m-quick-purchase2').on('show.bs.modal', function (e) {
            $('.invalid-feedback').hide();
        });
        $('#m-quick-purchase2').on('hidden.bs.modal', function () {
            Livewire.emit('fastOrderFormClosed');
        })

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
