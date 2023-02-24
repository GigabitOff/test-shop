<div>

    @include('livewire.admin.catalog.filters.includes.additional-attributes-filter')

    @include('livewire.admin.catalog.filters.includes.popup-add-data-filter')

    <script>


    function changeStatusHtml(id,status,val_id) {


        if($('#'+val_id).val() == 1){
            $('#'+id).html("{{__('custom::admin.Offcluded')}}");
            $('#'+val_id).val(0);
        }else{
            $('#'+id).html("{{__('custom::admin.Included')}}");
            $('#'+val_id).val(1);

        }
    }
    </script>

    <script>
    function changeOrderCustomAdditional(id_s, index, values,input){


        if(values == 0)
            {
                values = 1;
                input.value = values;
            }

            if(values>{{count($data_paginate)}})
            {
                values = {{count($data_paginate)}};
                input.value = values;
              //  alert(input.value);
            }


       @this.changeSingleItem(id_s, index, values);

    }
</script>
</div>
