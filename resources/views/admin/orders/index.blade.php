@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class="shop-pages"'}}@endsection
@section('content')
<div class="container-large">
@livewire('admin.orders.order-index-livewire', key(time().'order-index'))
</div>
@endsection
