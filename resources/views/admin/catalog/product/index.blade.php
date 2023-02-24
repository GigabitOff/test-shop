
@extends('layouts.admin')
@php
$title=__('custom::admin.Catalog products');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
<div class="container-large">
    @livewire('admin.catalog.product.catalog-product-index-livewire', key(time().'catalog-product-index'))
</div>
@endsection
