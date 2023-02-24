@extends('layouts.admin')
@php
$title=__('custom::admin.Services');
@endphp
@section('class_body'){{'class="shop-pages"'}}@endsection
@section('content')
<div class="container-large">
@livewire('admin.catalog.services.service-index-livewire', key(time().'service-index'))
</div>
@endsection
