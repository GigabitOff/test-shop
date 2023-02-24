<div>
    {{-- In work, do what you enjoy. --}}
    @include('livewire.admin.pages.includes.add-edit-single',['hide_lang'=>$hide_lang])

<script>
    setTimeout(() => {
 $( ".form-control" ).change(function() {
         // действия, которые будут выполнены при наступлении события...

         @if(!$canselSaveButton)
            @this.startEmmitForPopup();
        @endif
        });
    }, 2000);


       //

</script>
</div>
