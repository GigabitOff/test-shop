@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
    @livewire('admin.catalog.product-import.product-import-create-livewire', key(time().'action-create'))


@endsection
