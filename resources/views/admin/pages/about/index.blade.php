@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')

@livewire('admin.pages.about.about-index-livewire', key(time().'about-index'))


@endsection
