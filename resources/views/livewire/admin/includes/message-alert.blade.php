<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-lable="close">
                <span aria-hidden="true">x</span>
            </button>
            {{ $alert }}
            </div>
        </div>
    </div>
@if(isset($modal_id))
<script>
    $('#{{$modal_id}}').hide();
    $('.modal-backdrop').hide();
</script>
@endif
