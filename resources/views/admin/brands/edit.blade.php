@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
    @livewire('admin.brands.brand-edit-livewire', ['action_product'=>$data,'item_id'=>$id], key(time().'brand-edit'))

@endsection
