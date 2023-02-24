@extends('layouts.admin')
@php
    $title=__('custom::admin.characteristic_editing');
@endphp
@section('class_body')
    {{'class="options"'}}
@endsection
@section('content')
    <div class="container-small">
        <livewire:admin.characteristics.characteristic-edit-livewire :attribute="$characteristic" />
    </div>
@endsection
