@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
    @livewire('admin.orders.order-create-livewire', key(time().'order-index'))

@endsection
