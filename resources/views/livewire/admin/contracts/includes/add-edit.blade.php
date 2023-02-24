<div class="row g-3">
    <div class="col-12">
        <input class="form-control"  type="text" wire:model.lazy="data.registry_no" placeholder="Номер договора   -№" >

    </div>
        <div class="col-12">
            <input class="form-control @error('data.payment_type') is-invalid @enderror"  type="text" wire:model.lazy="data.name" placeholder="Наименование договора">
        @error('data.name')
        <div class="is-invalid ">
            {{ $message }}
        </div>
        @enderror
    </div>
        <div class="col-12">
            @include('livewire.admin.includes.select-data-arrow',[
            'select_data_input'=>isset($select_data['status']) ? $select_data['status']: null,
            'select_data_array'=>(isset($select_array['status']) AND is_array($select_array['status'])) ? $select_array['status'] : [
                '0' => [
                    'id' => 0,
                    'title' => __('custom::admin.status_counterparty.0'),
                ],
                '1' => [
                    'id' => 1,
                    'title' => __('custom::admin.status_counterparty.1'),
                ],
            ],
            'placeholder'=>__('custom::admin.Status'),
            'index'=>'status',

            'show_title'=>true,

        ])
        </div>
        <div class="col-12">
            <input @error("data.valid_at") style='border: 1px solid red' @enderror type="text" class="format_date form-control" placeholder="Действует с:" value="{{ isset($data['valid_at']) ? $data['valid_at'] : ''}}"
            onclick="showMascDate(this);" onchange="@this.set('data.valid_at',this.value)" />

        </div>
        <div class="col-12">
            <input @error("data.valid_to") style='border: 1px solid red' @enderror type="text" class="format_date form-control" placeholder="Действует с:" value="{{ isset($data['valid_to']) ? $data['valid_to'] : ''}}"
            onclick="showMascDate(this);" onchange="@this.set('data.valid_to',this.value)" />
        </div>
        <div class="col-12"><input class="form-control @error('data.payment_type') is-invalid @enderror"  type="text" wire:model.lazy="data.payment_type" placeholder="Форма оплаты:">
        @error('data.payment_type')
        <div class="is-invalid ">
            {{ $message }}
        </div>
        @enderror
        </div>
        <div class="col-12">
            <textarea wire:model.lazy="data.comment" class="form-control" cols="30" rows="10" placeholder="Комментарий"></textarea></div>
        <div class="col-12">
            <input class="form-control" type="number" wire:model.lazy="data.sum" placeholder="Сумма"></div>

</div>
<div class="page-save mt-4">
    @include('livewire.admin.includes.save-data-include',[
        'wire_click'=>"saveData",
        'onclick_cansel'=>"set('swith_show','show');",
        'title_button'=>__('custom::admin.Save')
        ])
</div>

<script>
    jQuery(document).ready(function ($) {
        $('format_date').inputmask({"mask": "99.99.9999"});


        // Livewire.hook('element.updated', () => {
        //     $('.js-phone').mask("+38/999/ 999 99 99");
        // });

    });

</script>
