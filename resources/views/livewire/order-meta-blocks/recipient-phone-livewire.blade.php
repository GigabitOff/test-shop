
<input id="lf-phone-raw" class="js-phone form-control" type="text"
       wire:model.lazy="recipientPhone"
       placeholder="@lang('custom::site.phone')">
<script>
    const phoneInput = document.querySelector('#lf-phone-raw');
    phoneInput.addEventListener('blur', function () {
        const tel = phoneInput.value;
        Livewire.emit('recipientNaUpdated', tel);
        console.log(tel);
    });
</script>







