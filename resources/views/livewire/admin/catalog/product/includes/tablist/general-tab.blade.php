<div class="container-medium">

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-text">@lang('custom::admin.products.Name product')</span>
            <input class="form-control @error('data.'.session('lang').'.name') is-invalid @enderror" type="text" placeholder="" value="" wire:model.lazy="data.{{session('lang')}}.name">
        </div>
        @include('livewire.admin.includes.error-title',['index'=>'name'])
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-text">@lang('custom::admin.products.Articul')</span>
            <input class="form-control" type="text" placeholder="" value="" wire:model.lazy="data.articul">
        </div>
    </div>

    <div  class="row mt-4" wire:key="script-prod" >
        <div class="form-group">
            @if(isset($data['articul_search']) AND count($data['articul_search']) > 0)
                <div class="tagger">
                    <input class="form-control" type="hidden" placeholder="Додати хештег" value="sdfsdf,dfsdfsdf" hidden="hidden">
                    <ul>
                        @foreach ($data['articul_search'] as $item_k)
                            <li>
                                <a href="javascript: void(0);" class="--yellow">
                                    <span class="label">{{$item_k}}</span>
                                    <span href="#" class="close" onclick="@this.unSetDataTags('articul_search','{{$item_k}}',true)">×</span>
                                </a>
                            </li>
                        @endforeach

                        <li class="tagger-new">
                            <input class="js-tags-next" onkeypress="return addNewTags(event)" placeholder="@lang('custom::admin.Add hash tags')" >
                            <div class="tagger-completion"></div>
                        </li>
                    </ul>
                </div>
            @else
                <input class="js-tags-first form-control" onkeypress="return addFirstNewTags(event)" type="text" placeholder="@lang('custom::admin.Add hash tags')" value = "">

            @endif

            {{-- <div class="form-group mt-4"><button class="button" type="button">Добавить</button></div>--}}
        </div>

        <script>
            /* ---------------------------- Tags в поле input --------------------------- */

            document.addEventListener('DOMContentLoaded', function () {


                $('.js-tags').on('keypress',function(e) {
                    if(e.which == 13) {

                        @this.setDataTags("articul_search",$('.js-tags').val(),true)
                    }
                });

            });

            function addFirstNewTags(e) {
                if(e.which == 13) {

                    @this.setDataTags("articul_search",$('.js-tags-first').val(),true) //articul_search
                    $('.js-tags-first').val('');
                }
            }

            function addNewTags(e) {
                if(e.which == 13) {

                    @this.setDataTags("articul_search",$('.js-tags-next').val(),true) //articul_search
                    $('.js-tags-next').val('');
                }
            }


        </script>
    </div>

    <div class="form-group">
        <div class="input-group @error('slug')error @enderror">
            <span class="input-group-text">@lang('custom::admin.Slug')</span>
            <input class="form-control " type="text" placeholder="" value="" wire:model.lazy="slug">
        </div>
        @error('slug')
        @php($error_show=$message)
        <div class="error" name="error">{{ $message}}</div>
        @enderror
    </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text">@lang('custom::admin.products.Brand')</span>
            @include('livewire.admin.includes.select-data-arrow',[
                        'select_data_input'=>(isset($select_data['brand_id']) ? $select_data['brand_id']: null),
                        'select_data_array'=>$brands, 'placeholder'=>__('custom::admin.products.Brand'),
                        'index'=>'brand_id',
                        'show_title'=>true,
                        'index_leng_admin_key' =>'site',
                        ])

                {{--  <input class="form-control" type="text"  value="@lang('custom::admin.availability.'.$data['availability'])" wire:model.lazy="data.availability">--}}
            </div>
        </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-text">@lang('custom::admin.products.Seller')</span>
            <input class="form-control" type="text" placeholder="" value="" wire:model.lazy="data.{{session('lang')}}.seller" >
        </div>
    </div>


    <div class="form-group">
            <label class="check">
                <input class="check__input" type="checkbox"
                       @checked($data['foodstuff'])
{{--                       onclick="@this.set('data.foodstuff',{{ (!isset($data['price_sale_show']) OR $data['price_sale_show'] == 0) ? 1 : 0 }});"--}}
                       wire:model="data.foodstuff">
                <span class="check__box">@lang('custom::admin.products.foodstuff')</span>
            </label>
        </div>

{{--        <div class="form-group">--}}
{{--            <div class="input-group">--}}
{{--                <span class="input-group-text">@lang('custom::admin.products.Barcode')</span>--}}
{{--                <input class="form-control" type="text" placeholder="" value="" wire:model.lazy="data.barcode">--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <div class="input-group">--}}
{{--                <span class="input-group-text">@lang('custom::admin.products.Product availability')</span>--}}
{{--            @include('livewire.admin.includes.select-data-arrow',[--}}
{{--                        'select_data_input'=>(isset($select_data['availability']) ? $select_data['availability']: null),--}}
{{--                        'select_data_array'=>\App\Models\Product::AVAILABILITY_TYPES, 'placeholder'=>__('custom::admin.products.Product availability'),--}}
{{--                        'index'=>'availability',--}}
{{--                        'hide_clear' =>true,--}}
{{--                        'index_leng_admin_key' =>'admin',--}}
{{--                        ])--}}

{{--                --}}{{--  <input class="form-control" type="text"  value="@lang('custom::admin.availability.'.$data['availability'])" wire:model.lazy="data.availability">--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="form-group">

            <div class="input-group">

                <span class="input-group-text">@lang('custom::admin.products.Availability of goods from the supplier')</span>
                <div class="drop --arrow">
            <input class="form-control drop-input" type="text" autocomplete="off" placeholder="@lang('custom::admin.products.Product availability')" value="{{ isset($data['availability_supplier']) ? __('custom::admin.availability.'.$data['availability_supplier']) : ''}}" />
                <div class="drop-box">
                  <div class="drop-overflow">
                    <ul class="drop-list">
                        @foreach (\App\Models\Product::AVAILABILITY_TYPES as $ke_av => $item_av)
                      <li class="drop-list-item" onclick="@this.set('data.availability_supplier',{{$item_av}})">{{  __('custom::admin.availability.'.$ke_av) }}</li>

                        @endforeach

                    </ul>
                  </div>
                </div>
              </div>

            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text">@lang('custom::admin.products.The multiplicity of the sale of goods')</span>
                <input class="form-control" type="text" placeholder="" value="" wire:model.lazy="data.multiplicity">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text">@lang('custom::admin.products.Code UKTVED')</span>
                <input class="form-control" type="text" placeholder="" value="" wire:model.lazy="data.uktved">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text">@lang('custom::admin.products.Size LxWxH')</span>
                <input class="form-control" type="number" placeholder="@lang('custom::admin.products.Depth')"  value="0" wire:model.lazy="data.depth">
                <input class="form-control" type="number" placeholder="@lang('custom::admin.products.Width')"  value="0" wire:model.lazy="data.width">
                <input class="form-control" type="number" placeholder="@lang('custom::admin.products.Height')"  value="0" wire:model.lazy="data.height">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-text">
                    <span>@lang('custom::admin.products.Color')</span>
                </div>
                <a class="form-control color-button" href="javascript:void(0);"
                   onclick="Livewire.emit('eventSetColor', {color:'{{ $data['color'] ?? ''}}'})"
                    >{{ $data['color'] ?? ''}}
                    <div class="color-button__color">{{ $data['color'] ?? ''}}</div>
                    <span class="color-button__preview" style="background: {{ $data['color'] ?? 'transparent'}}"></span>
                </a>

            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text">@lang('custom::admin.products.Unit')</span>
                <input class="form-control" type="text" placeholder="" value=""  wire:model.lazy="data.{{session('lang')}}.measure">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text">@lang('custom::admin.products.Weight')</span>
                <input class="form-control" type="text" placeholder="@lang('custom::admin.products.Weight')" value=""  wire:model.lazy="data.weight">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text">@lang('custom::admin.products.Producing country')</span>
                <input class="form-control" type="text" placeholder="@lang('custom::admin.products.Producing country')" value=""  wire:model.lazy="data.{{session('lang')}}.country">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text">@lang('custom::admin.products.Country of brand registration')</span>
                    <input class="form-control" type="text" placeholder="" value=""  wire:model.lazy="data.{{session('lang')}}.country_registration">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text">@lang('custom::admin.products.Warranty')</span>
                <input class="form-control" type="text" placeholder="" value=""  wire:model.lazy="data.warranty">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text">@lang('custom::admin.products.State')</span>
                <input class="form-control" type="text" placeholder="" value=""  wire:model.lazy="data.{{session('lang')}}.state">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text">@lang('custom::admin.Description')</span>
                <input class="form-control" type="text" placeholder="" value=""
                       wire:model.lazy="data.{{session('lang')}}.short_description">
            </div>
        </div>
        <div class="form-group textareEditor"  wire:ignore>
                <span class="input-group-text">@lang('custom::admin.Tehnical description')</span>
            <textarea id="page-item-data-{{session('lang')}}-technical_description" class="form-control" rows="3" placeholder="@lang('custom::admin.Tehnical description')"
                wire:model.lazy="data.{{session('lang')}}.technical_description">
                @if(isset($data[session('lang')]['technical_description']))
                {{ $data[session('lang')]['technical_description'] }}
                @endif
        </textarea>
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'page-item-data-'.session('lang').'-technical_description', 'nameForm'=>'data.'.session('lang').'.technical_description'])
        </div>
        <div class="form-group textareEditor" wire:ignore>
    <div class="col-12" >
                <span class="input-group-text">@lang('custom::admin.Body')</span>
        <textarea id="page-item-data-{{session('lang')}}-description" class="form-control" rows="3" placeholder="@lang('custom::admin.Description')"
                wire:model.lazy="data.{{session('lang')}}.description">
                @if(isset($data[session('lang')]['description']))
                {{ $data[session('lang')]['description'] }}
                @endif
        </textarea>
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'page-item-data-'.session('lang').'-description', 'nameForm'=>'data.'.session('lang').'.description'])
    </div>

        </div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text">@lang('custom::admin.products.Shipping and payment')</span>
                    <input class="form-control" type="text" placeholder="" value=""  wire:model.lazy="data.{{session('lang')}}.shipping_payment">
            </div>
        </div>

        <div class="form-group">
            <x-admin.check-labeled
                :caption="__('custom::admin.products.Cut out')"
                wire:model="data.cut_out" />
        </div>
        <div class="form-group">
            <x-admin.check-labeled
                :caption="__('custom::admin.products.novelty')"
                wire:model="data.new" />
        </div>
        <div class="form-group">
            <x-admin.check-labeled
                :caption="__('custom::admin.products.markdown')"
                wire:model="data.markdown" />
        </div>
        @if(isset($item_id))
    <div wire:ignore>
        <h6>
            @lang('custom::admin.Related products')
        </h6>
        @livewire('admin.catalog.catalog-search-product-livewire', [
            'product_id'=>$item_id,
            'table_name'=>'product_accompanying',
            'target'=>'accompanying',
            'type_show'
        ])

    </div>
    @endif

    <livewire:admin.forms.select-color-livewire />
</div>
