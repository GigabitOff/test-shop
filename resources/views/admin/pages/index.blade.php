@extends('layouts.admin')
@php
    $title=__('custom::admin.Pages');
@endphp
@section('class_body')
    {{'class="shop-pages"'}}
@endsection
@section('content')

    @livewire('admin.pages.page-index-livewire')

@endsection
