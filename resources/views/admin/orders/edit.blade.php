@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
    @livewire('admin.orders.order-edit-livewire', ['action_product'=>$data,'item_id'=>$id], key(time().'order-edit'))

@endsection
