@extends('layouts.admin')
@php
    $title=__('custom::admin.Characteristics');
@endphp
@section('class_body')
    {{'class="options"'}}
@endsection
@section('content')
    <div class="container-large">
        <livewire:admin.characteristics.characteristic-index-livewire />
    </div>
@endsection
