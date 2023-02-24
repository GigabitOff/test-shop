@extends('layouts.admin')
@php
$title=__('custom::admin.Settings');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
    @livewire('admin.menu.menu-index-livewire', key(time().'-menu-index'))

@endsection
