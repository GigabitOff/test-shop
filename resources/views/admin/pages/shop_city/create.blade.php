@extends('layouts.admin')
@php
$title=__('custom::admin.Company structure');
@endphp
@section('class_body'){{'class=shop-pages'}}@endsection
@section('content')
<div class="container-small">
    @livewire('admin.pages.shop-city.shop-city-create-livewire', key(time().'brand-index'))
</div>
@endsection
