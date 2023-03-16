@if(!$isThreeColumns)
<div class="col-md-6">
@endif
    <ul class="specification-list">
        @foreach(array_slice($attributes, ceil($countAttributes/2)) as $attr)
            <li>
                @foreach($attr['attribute']['translations'] as $translation_name)
                    @if($translation_name['locale'] == app()->getLocale())
                        <span>{{$translation_name['name']}}</span>
                    @endif
                @endforeach
                @foreach($attr['translations'] as $translation_value)
                    @if($translation_value['locale'] == app()->getLocale())
                        <strong>{{$translation_value['name']}}</strong>
                    @endif
                @endforeach
            </li>
        @endforeach
    </ul>
@if(!$isThreeColumns)
</div>
@endif
