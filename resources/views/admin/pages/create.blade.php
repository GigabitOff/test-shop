@extends('layouts.admin')
@php
$title=__('custom::admin.Pages create');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
    @livewire('admin.pages.page-create-livewire', key(time().'shop_city-index'))

@endsection
