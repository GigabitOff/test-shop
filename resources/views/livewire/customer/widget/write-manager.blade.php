<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Написати нам<small>deks.ua</small></h5><button class="btn-close" type="button" data-bs-dismiss="modal"></button>
  </div>
  <div class="modal-body">
    <form wire:submit.prevent="sendData">
      <div class="form-group"><input class="form-control"  wire:model.defer="data.fio" type="text" name="fio" placeholder="ПІБ" required></div>
      <div class="form-group"><input class="form-control" wire:model.defer="data.email" type="email" name="email" placeholder="E-mail" required></div>
      <div class="form-group"><textarea  wire:model.defer="data.message" class="form-control" type="text" name="message" placeholder="Супровідний текст" required></textarea></div>
      <div class="form-group"><button class="button-accent button-accent w-100" onclick="@this.sendData();" type="submit">Надіслати</button></div>
    </form>
  </div>
</div>

