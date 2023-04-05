
<div class="add-phone">
    <div class="form-group">
        <form>
            <input id="lf-phone-raw"  class="js-phone form-control" type="text"
                   wire:model.lazy="recipientPhone"
                   placeholder="@lang('custom::site.phone')">
        </form>
    </div>
</div>
<script>
    const phoneInput = document.querySelector('#lf-phone-raw');
    phoneInput.addEventListener('blur', function() {
        const tel = phoneInput.value;
        Livewire.emit('recipientNaUpdated', tel);
    });
</script>




