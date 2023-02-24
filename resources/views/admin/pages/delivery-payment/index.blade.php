@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')

@livewire('admin.pages.delivery-payment.delivery-payment-index-livewire', key(time().'delivery-payment-index'))


@endsection
