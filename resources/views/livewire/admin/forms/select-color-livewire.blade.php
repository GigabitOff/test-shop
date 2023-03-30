<div class="modal fade" id="m-select-color" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-color-picker">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('custom::admin.color_selector')</h5>
                <button class="btn-close" type="button"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:ignore>
                <div class="select-color-container" id="wheelPicker">
                    <div class="select-color-nav">
                        <div class="select-color-previve" style="background: {{ $color }} ">
                            <div class="select-color-previve__inner" style="background: {{ $color }} " ></div>
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


        if (document.getElementById("wheelPicker")) {
    const wheelPicker = new iro.ColorPicker("#wheelPicker", {
      width: 250,
      color: '{{ $color }}',
      display: 'grid',
      margin: 0,
      handleRadius: 15,
      layout: [{
        component: iro.ui.Wheel
      }, {
        component: iro.ui.Slider,
        options: {
          sliderType: 'saturation',
          handleRadius: 12
        }
      }, {
        component: iro.ui.Slider,
        options: {
          sliderType: 'value',
          handleRadius: 12
        }
      }]
    });
    const colorInput = document.querySelector('.select-color-input');
    colorInput.addEventListener('change', function () {
      wheelPicker.color.hexString = this.value;
    });
    wheelPicker.on('color:change', function (color) {
      // if the first color changed
      if (color.index === 0) {
        // log the color index and hex value
        const previweColor = document.querySelector('.select-color-previve');
        const previweColorInner = document.querySelector('.select-color-previve__inner');
        const selectedColor = color.hexString;
        colorInput.value = selectedColor.toUpperCase();
        previweColor.style.background = selectedColor;
        previweColorInner.style.background = selectedColor;
      }
    });

    if (document.querySelector('.color-button')) {
      const selectColorButton = document.querySelector('.button-select-color'),
            colorButton = document.querySelector('.color-button'),
            colorPreviwe = colorButton.querySelector('.color-button__preview'),
            colorHolder = colorButton.querySelector('.color-button__color');
      selectColorButton.addEventListener('click', function () {
        colorHolder.innerHTML = wheelPicker.color.hexString.toUpperCase();
        colorPreviwe.style.background = wheelPicker.color.hexString;
      });
    }
  }
        //# sourceURL=select-color-livewire.js
    </script>
@endpush
