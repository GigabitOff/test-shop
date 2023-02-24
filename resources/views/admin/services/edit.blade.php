@extends('layouts.admin')
@php
    $title=__('custom::admin.service_editing');
@endphp
@section('class_body')
    {{'class="options"'}}
@endsection
@section('content')
    <div class="container-small">
        <livewire:admin.services.service-edit-livewire :page="$service" :parent_page_id="$service->page_id" />
    </div>
@endsection
