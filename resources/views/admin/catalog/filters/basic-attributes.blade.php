
@extends('layouts.admin')
@php
$title=__('custom::admin.Basic attributes');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
<div class="container-large">
    @livewire('admin.catalog.filters.catalog-filter-attribute-livewire',['basic'=>true], key(time().'-filter-attribute-livewire'))
</div>
@endsection
