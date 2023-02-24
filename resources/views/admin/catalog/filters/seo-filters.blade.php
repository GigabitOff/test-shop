
@extends('layouts.admin')
@php
$title=__('custom::admin.Seo data');
@endphp
@section('class_body'){{'class=filter-seo'}}@endsection
@section('content')
<div class="container-large">
    @livewire('admin.catalog.filters.catalog-filter-seo-index-livewire', key(time().'filter-seo-index'))

</div>
@endsection
