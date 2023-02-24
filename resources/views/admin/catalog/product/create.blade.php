@extends('layouts.admin')
@php
$title=__('custom::admin.Catalog products');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
<div class="container-large">

    @livewire('admin.catalog.product.catalog-product-create-livewire',
                key(time().'catalog-product-create'))

</div>

@endsection
