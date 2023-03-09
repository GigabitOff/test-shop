{{--<div wire:ignore>--}}
{{--    @livewire('admin.catalog.catalog-search-category-livewire', [--}}
{{--        'product_id'=>$item_id ?? 0,--}}
{{--        'table_name'=>'category_product'--}}
{{--    ])--}}
{{--</div>--}}

@error('updatedCats.main')
    <div class="is-invalid d-block my-2">{{$message}}</div>
@enderror

<livewire:admin.catalog.product.category-selector-livewire :product="$dataItem" />

<div class="form-group mt-3"><span>@lang('custom::admin.Mandatory characteristics')</span></div>

<div class="form-group --specifications">
    <button class="button mb-2" type="button"
            wire:click="getCategoryAttributes">
        @lang('custom::admin.Update Category Attributes')</button>
</div>

@forelse ($basicAttrs as $attr)
    @include('livewire.admin.catalog.product.includes.add-edit-characteristic',[
        'name_characteristic'=>'',
        'name_disabled'=>true,
        'name_characteristic_value'=>$attr['attr_name'],
        'value_characteristic_wire'=>$attr['model'],
        'value_characteristic_select'=>null,
        'item_delete_wire'=>$attr['delete_click']
    ])
@empty
    <span class="text-danger">@lang('custom::admin.No characteristic available')</span>
@endforelse

<div class="page-save">
    <div></div>
    <div class="page-nav-box">
        <x-admin.page-selector
            :paginator="$basicAttrs"
            :list="[5,10,20,30,40]"
        />

        {{ $basicAttrs->links($this->paginationView())}}

    </div>
</div>

<div class="form-group mt-3"><span>@lang('custom::admin.Other characteristics')</span></div>
@forelse ($optionalAttrs as $attrItem)
    @if($attrItem['new'] ?? false)
        @include('livewire.admin.catalog.product.includes.add-edit-characteristic',[
        'name_characteristic'=>__('custom::admin.The name of the characteristic'),
        'name_disabled'=>true,
        'name_characteristic_value'=>__('custom::admin.Attribute'),
        'name_characteristic_select'=>[
            'select_data_input'=>(isset($select_data["tmp_attr-{$attrItem['index']}"]['id'])  ? true : null),
            'select_data_array'=>$selectAttrTmp[$attrItem['index']],
            'placeholder'=>__('custom::admin.Attribute'),
            'index'=>"tmp_attr-{$attrItem['index']}",
            'show_title'=>false,
            'show_name'=>true,
            ],
        'on_input' => true,
        'key_ch_tmp' => $attrItem['index'],
        'value_characteristic_wire'=>'tmpCharacteristic.'.$attrItem['index'].'.value.'.session('lang').'.name',
        'value_characteristic_select'=>null,
        // 'onchange'=>'@this.updateTarmProduct('.$item['id'].',this.value)',
        'item_delete_wire'=>"wire:click=deleteTmpCharacteristic('{$attrItem['index']}')"
        ])
    @else
        @include('livewire.admin.catalog.product.includes.add-edit-characteristic',[
            'name_characteristic'=>'',
            'name_disabled'=>true,
            'name_characteristic_value'=>
            (isset($attrItem['attribute_id']) AND isset($atributes[$attrItem['attribute_id']]['name'])) ? (isset($atributes[$attrItem['attribute_id']][session('lang')]['name']) ? $atributes[$attrItem['attribute_id']][session('lang')]['name']: $atributes[$attrItem['attribute_id']]['name']) : '',
            'value_characteristic_wire'=>'data.terms.'.$attrItem['id'].'.'.session('lang').'.name',
            'value_characteristic_select'=>null,
            //'onchange'=>'@this.updateTarmProduct('.$b_attr_item['id'].',this.value)',
            'item_delete_wire'=>"wire:click=deleteCharacteristicItemTmp({$attrItem['id']})"])
    @endif
@empty
    <span class="text-danger">@lang('custom::admin.No characteristic available')</span>
@endforelse


<div class="page-save">
    <div></div>
    <div class="page-nav-box">
        <x-admin.page-selector
            :paginator="$optionalAttrs"
            :list="[5,10,20,30,40]"
        />

        {{ $optionalAttrs->links($this->paginationView())}}

    </div>
</div>

<div class="form-group mt-4 mb-4"><button class="button" type="button" onclick="@this.addTmpCharacteristic()">@lang('custom::admin.Add a characteristic')</button></div>
{{--<div class="form-group mt-4 mb-4"><button class="button" type="button" onclick="@this.SaveCharacteristic()">@lang('custom::admin.Save characteristic')</button></div>--}}
<script>
     function showMainCat(params) {

        $('#'+params).toggleClass('is-active');
              //  $('#'+params).addClass('is-active');

            //$().addClass('is-active');
        }
</script>




