@extends('layouts.admin')
@php
    $title=__('custom::admin.service_creating');
@endphp
@section('class_body')
    {{'class="options"'}}
@endsection
@section('content')
    <div class="container-small">
        <livewire:admin.services.service-create-livewire :parent-page-id="$parentId"/>
    </div>
@endsection
