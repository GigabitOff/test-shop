<form>
    <input id="lf-phone-raw" style="display: none;" class="js-phone form-control" type="text"
           wire:model.lazy="recipientPhone"
           autocomplete="off"
           required placeholder="Phone">
</form>
<script>
    var orderForm = document.querySelector(".order-form--custome");
    var textField = orderForm.querySelector("input[type='text']");
    var formGroup = document.querySelector(".order-form");
    var uyBlock = document.getElementById("lf-phone-raw");
    var intervalMs = 200;
    var intervalId;

    const phoneNumberInput = document.querySelector('.js-phone');
    phoneNumberInput.addEventListener('blur', function () {
        const phoneNumberValue = this.value;
        console.log(`${phoneNumberValue}`);
        Livewire.emit('recipientNaUpdated', phoneNumberValue);
    });

    function checkTextField() {
        if (textField.value !== "") {
            uyBlock.style.display = 'block';
        } else {
            uyBlock.style.display = 'none';
        }
    }

    intervalId = setInterval(checkTextField, intervalMs);
</script>



