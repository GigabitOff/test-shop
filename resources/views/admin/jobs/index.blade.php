@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class="sitting"'}}@endsection
@section('content')
    @livewire('admin.pages.jobs.job-index-livewire', key(time().'pages-job-index'))
@endsection
