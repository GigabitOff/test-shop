@section('title'){{$title = (isset($meta['title']) ? trim($title) : (isset($meta['name']) ? $meta['name'] : 'Техніка Монтажу')) }}@endsection
@section('image'){{ isset($image) ? $image : '' }}@endsection
@section('meta_title')
@if(isset($meta['meta_title']) AND trim($meta['meta_title']) !=''){{trim($meta['meta_title']) }} @elseif(isset($meta['name']) AND $meta['name'] != ''){{$meta['name']}}@else{{$title}}@endif
@endsection
@section('meta_description'){!! isset($meta['meta_description']) !='' ? strip_tags (trim($meta['meta_description'])) : (isset($meta['description']) ? strip_tags ($meta['description']) : 'Техніка монтажа опис')!!}@endsection
@section('meta_keywords'){{isset($meta['meta_keywords']) !='' ? trim(@$meta['meta_keywords']) : ''}}@endsection
