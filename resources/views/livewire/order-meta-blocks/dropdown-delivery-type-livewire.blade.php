
        @include('livewire.includes.custome-selecttu',[
            'model'=>'deliveryTypeId',
            'value'=>$deliveryTypeName,
            'items'=>$deliveryTypeList,
            'placeholder'=>__('custom::site.Delivery method'),
        ])


