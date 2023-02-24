@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class="shop-pages"'}}@endsection
@section('content')
    @livewire('admin.pages.main.main-index-livewire', key(time().'main-index'))
@endsection
