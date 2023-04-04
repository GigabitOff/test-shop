
    @include('livewire.includes.custome-select',[
    'model'=>'paymentId',
    'value'=>$paymentName,
    'items'=>$paymentList,
    'placeholder'=>('custom::site.Payment method'),
    ])


