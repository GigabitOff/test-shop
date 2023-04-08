@props([
    'list' => [],   // Массив(коллекция) данных в формате [ ['url'=>'', 'name'=>''], ... ]
    'currentName' => '',    // Название активного элемента
])
<div class="page-breadcrumb">
    <div class="container-xl">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('main')}}">@lang('custom::site.main')</a></li>
            @foreach($list as $key =>$item)
            @php
                if($key<3)
                $link = $item['url'];
            @endphp
                <li class="breadcrumb-item">
                    <a href="{{ $link }}">{{$item['name']}}</a></li>
            @endforeach
            <li class="breadcrumb-item active" aria-current="page">{{$currentName}}</li>
        </ol>
    </div>
</div>
