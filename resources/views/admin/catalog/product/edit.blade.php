@extends('layouts.admin')
@php
    $title=__('custom::admin.Catalog products');
@endphp
@section('class_body')
    {{'class=sitting'}}
@endsection
@section('content')
    <div class="container-large">
        @livewire('admin.catalog.product.catalog-product-edit-livewire',[
            'product'=>$product,
            'item_id'=>$product->id
        ])
    </div>

@endsection
