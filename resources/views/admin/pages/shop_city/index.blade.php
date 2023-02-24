@extends('layouts.admin')
@php
$title=__('custom::admin.Company structure');
@endphp
@section('class_body'){{'class="options"'}}@endsection
@section('content')
<div class="container-small">
@livewire('admin.pages.shop-city.shop-city-index-livewire', key(time().'option-index'))
</div>
@endsection
