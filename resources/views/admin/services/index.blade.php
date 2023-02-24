@extends('layouts.admin')
@php
    $title=__('custom::admin.Services');
@endphp
@section('class_body')
    {{'class="options"'}}
@endsection
@section('content')
    <div class="container-large">
        <livewire:admin.services.service-index-livewire :services-page="$page" />
    </div>
@endsection
