@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')

    @livewire('admin.pages.news.news-create-livewire', key(time().'-news-create'))


@endsection
