@extends('layouts.admin')
@php
$title=__('custom::admin.Services');
@endphp
@section('class_body'){{'class=diskont'}}@endsection
@section('content')
    @livewire('admin.catalog.services.service-edit-livewire', ['item_id'=>$id], key(time().'service-edit'))

@endsection
