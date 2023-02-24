@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class="sitting"'}}@endsection

@section('content')
<div class="container-large">
    @livewire('admin.jobs.job-create-livewire', key(time().'job-create'))
</div>
@endsection
