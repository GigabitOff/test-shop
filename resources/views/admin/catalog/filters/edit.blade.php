@extends('layouts.admin')
@php
$title=__('custom::admin.Filters');
@endphp
@section('class_body'){{'class="page-main"'}}@endsection
@section('content')
<div class="container-large">
    @if(isset($data))
    @livewire('admin.catalog.filters.catalog-filter-edit-livewire',['data'=>$data,'item_id'=>$id],
                key(time().'catalog-filter-edit'))
    @else
    Помилка
    @endif
</div>

@endsection
