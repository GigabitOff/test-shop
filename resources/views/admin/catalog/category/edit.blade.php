@extends('layouts.admin')
@php
$title=__('custom::admin.Category');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
@livewire('admin.catalog.category.catalog-category-edit-livewire',['category'=>$category,'item_id'=>$id],
                key(time().'catalog-category-edit'))

@endsection
