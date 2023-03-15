@extends('layouts.admin')
@php
$title=__('custom::admin.Orders');
@endphp
@section('class_body'){{'class="shop-pages"'}}@endsection
@section('content')
<div class="container-large">
@livewire('admin.orders.order-show-livewire',['item_id'=>$id], key(time().'order-show'))
</div>
@endsection
