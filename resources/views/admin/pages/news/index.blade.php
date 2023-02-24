@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
<div class="container-large">
@livewire('admin.pages.news.news-index-livewire', key(time().'news-index'))
</div>
@endsection
