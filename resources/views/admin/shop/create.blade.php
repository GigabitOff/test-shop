@extends('layouts.admin')
@php
$title=__('custom::admin.Company structure');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')

    @livewire('admin.shop.shop-create-livewire',
                key(time().'shop-index'))


@endsection
