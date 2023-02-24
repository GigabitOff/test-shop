@extends('layouts.admin')
@php
$title=__('custom::admin.Filters');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
<div class="container-large">
    @livewire('admin.catalog.filters.catalog-filter-create-livewire',
                key(time().'catalog-filter-create'))
</div>

@endsection
