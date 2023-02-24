
@extends('layouts.admin')
@php
$title=__('custom::admin.Additional attributes');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
<div class="container-large">
    @livewire('admin.catalog.filters.catalog-filter-attribute-livewire', key(time().'-filter-attribute-livewire'))
</div>
@endsection
