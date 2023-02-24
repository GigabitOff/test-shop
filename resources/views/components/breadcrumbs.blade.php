@props([
    'list' => [],   // Массив(коллекция) данных в формате [ ['url'=>'', 'name'=>''], ... ]
    'currentName' => '',    // Название активного элемента
])
<div class="page-breadcrumb">
    <div class="container-xl">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('main')}}">@lang('custom::site.main')</a></li>
            @foreach($list as $item)
                <li class="breadcrumb-item">
                    <a href="{{ $item['url'] }}">{{$item['name']}}</a></li>
            @endforeach
            <li class="breadcrumb-item active" aria-current="page">{{$currentName}}</li>
        </ol>
    </div>
</div>
