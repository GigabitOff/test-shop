@php $attributes = $data->attributeValues->toArray();@endphp
@if ($attributes)
    <div
        class="@if ($layout['columns'] != 3) product-full-box --specification @else product-full-box --specification-single @endif">
        <div class="product-full-box__head">
            <div class="product-full-box__title" id="specification">@lang('custom::site.Specification')</div>
        </div>
        <div class="product-full-box__body --overflow">
            <div>
                @php
                    //add size and weight to attribute
                    if ($data->weight) {
                        array_push($attributes, ['translations' => [0 => ['locale' => app()->getLocale(), 'name' => $data->weight]], 'attribute' => ['translations' => [0 => ['locale' => app()->getLocale(), 'name' => \Lang::get('custom::site.Weight')]]]]);
                    }
                    if ($data->depth || $data->width || $data->height) {
                        array_push($attributes, ['translations' => [0 => ['locale' => app()->getLocale(), 'name' => $data->depth . 'х' . $data->width . 'х' . $data->height]], 'attribute' => ['translations' => [0 => ['locale' => app()->getLocale(), 'name' => \Lang::get('custom::site.Size')]]]]);
                    }
                    $countAttributes = count($attributes);
                @endphp
                <div>
                    <ul class="specification-list">
                        @foreach (array_slice($attributes, 0, ceil($countAttributes / 2)) as $attr)
                            <li>
                                @foreach ($attr['attribute']['translations'] as $translation_name)
                                    @if ($translation_name['locale'] == app()->getLocale())
                                        <span>{{ $translation_name['name'] }}</span>
                                    @endif
                                @endforeach
                                @foreach ($attr['translations'] as $translation_value)
                                    @if ($translation_value['locale'] == app()->getLocale())
                                        <strong>{{ $translation_value['name'] }}</strong>
                                    @endif
                                @endforeach
                            </li>
                        @endforeach
                        @include('livewire.catalog.product.product-atributes-livewire')
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
