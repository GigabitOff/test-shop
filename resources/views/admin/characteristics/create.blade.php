@extends('layouts.admin')
@php
    $title=__('custom::admin.characteristic_creating');
@endphp
@section('class_body')
    {{'class="options"'}}
@endsection
@section('content')
    <div class="container-small">
        <livewire:admin.characteristics.characteristic-create-livewire />
    </div>
@endsection
