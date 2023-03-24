<div class="modal fade" id="m-select-color" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-color-picker" wire:ignore>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('custom::admin.color_selector')</h5>
                <button class="btn-close" type="button"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="select-color-container" id="wheelPicker">
                    <div class="select-color-nav">
                        <div class="select-color-previve">
                            <div class="select-color-previve__inner"></div>
                        </div>
                        <input class="select-color-input" type="text" value="{{$color}}">
                    </div>
                    <div id="wheelPickerHolder" wire:ignore></div>
                </div>
                <button class="button w-100 button-select-color" type="button"
                        onclick="Livewire.emit('eventUpdateColor', {'color': `${$(this).closest('.modal-body').find('input').val()}`})"
                        data-bs-dismiss="modal">@lang('custom::admin.apply')</button>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        window.addEventListener('setColorToPicker', function (e) {
            // Set color value to picker
            window.wheelColorPicker.color.hexString = e.detail.color;
        })

        //# sourceURL=select-color-livewire.js
    </script>
@endpush
