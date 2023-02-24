<div wire:ignore>
    @livewire('admin.catalog.catalog-search-product-livewire', [
        'cur_product_id'=>$item_id,
        'table_name'=>'product_varieties',
        'target'=>'variations',
        'type_show'
    ])
</div>

<div class="row mb-3">
    <div class="col-lg-3 col-5">
        <div class="form-group">
            <x-admin.check-labeled
                :caption="__('custom::admin.products.Color')"
                wire:model="data.varsAttrs.color">
            </x-admin.check-labeled>
        </div>
    </div>

</div>

@if($fullVarsAttrsBag)
    <div class="row mb-3">
        <div class="text-danger">
            @lang('custom::admin.variations_attribute_max_quantity')
        </div>
    </div>
@endif


@foreach ($varieties_column_array as $key => $item_column)
    @continue($key === 'color')
    <div class="row mb-3">
        <div class="col-lg-3 col-5">
            <div class="form-group" id="vars-attr-{{$key}}">
                <x-admin.check-labeled
                    :caption="__('custom::admin.products.'.ucfirst($item_column))"
                    :disabled="$fullVarsAttrsBag AND empty($data['varsAttrs'][$key])"
                    wire:model="data.varsAttrs.{{$key}}">
                </x-admin.check-labeled>
            </div>
        </div>

        <div class="col-lg-5 col-5 @if(empty($data['varsAttrs'][$key])) d-none @endif">
            <label class="check eye">
                <input class="check__input card-attr cart-attr-{{$item_column}}" name="cart-attr"
                       wire:click="toggleCardAttribute('{{$item_column}}')"
                       onclick="document.variations.cardAttrChecked(this)"
                       @if($data['card_attribute'] != $item_column) checked @endif
                       type="checkbox">
                <span class="check__box"></span>
            </label>
        </div>
    </div>
@endforeach

@foreach ($basic_atribute_terms as $b_attr_item)
    @php($attrId = $b_attr_item['attribute_id'])
    <div class="row mb-3">
        <div class="col-lg-3 col-5">
            <div class="form-group" id="vars-attr-{{$attrId}}">
                <x-admin.check-labeled
                    caption="{{ (isset($b_attr_item['attribute_id']) AND isset($atributes[$attrId]['name'])) ? (isset($atributes[$b_attr_item['attribute_id']][session('lang')]['name']) ? $atributes[$b_attr_item['attribute_id']][session('lang')]['name']: $atributes[$b_attr_item['attribute_id']]['name']) : '' }}"
                    :disabled="$fullVarsAttrsBag AND empty($data['varsAttrs'][$attrId])"
                    wire:model="data.varsAttrs.{{$b_attr_item['attribute_id']}}">
                </x-admin.check-labeled>
            </div>
        </div>

        <div class="col-lg-5 col-5 @if(empty($data['varsAttrs'][$attrId])) d-none @endif">
            <label class="check eye">
                <input class="check__input card-attr cart-attr-{{$attrId}}" name="cart-attr"
                       wire:click="toggleCardAttribute('{{$attrId}}')"
                       onclick="document.variations.cardAttrChecked(this)"
                       @if($data['card_attribute'] != $attrId) checked @endif
                       type="checkbox">
                <span class="check__box"></span>
            </label>
        </div>
    </div>
@endforeach

@push('custom-scripts')
    <script>
        // Из за того, что checkbox eye работает наоборот, то приходится
        // переворачивать.
        document.variations = {
            cardAttrChecked: function (target) {
                $('.card-attr').each((i, el) => {
                    if (el !== target) {
                        $(el).prop('checked', true);
                    }
                })
            }
        }

        //# sourceURL=product-variations.js
    </script>
@endpush
