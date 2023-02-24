@extends('layouts.admin')
@php
$title=__('custom::admin.Category');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
    @livewire('admin.catalog.category.catalog-category-index-livewire',
                key(time().'catalog-category-index'))

@endsection
