@extends('layouts.admin')
@php
$title=__('custom::admin.Services');
@endphp
@section('class_body'){{'class=diskont'}}@endsection
@section('content')
    @livewire('admin.catalog.services.service-create-livewire', key(time().'service-index'))

@endsection
