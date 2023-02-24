
@extends('layouts.admin')
@php
$title=__('custom::admin.Filter');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
<div class="container-large">
    @livewire('admin.catalog.filters.catalog-filter-index-livewire', key(time().'catalog-filter-index'))
</div>
@endsection
