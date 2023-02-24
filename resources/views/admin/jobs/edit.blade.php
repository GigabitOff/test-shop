@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class="sitting"'}}@endsection

@section('content')
<div class="container-large">
    @livewire('admin.jobs.job-edit-livewire', ['item_id'=>$id], key(time().'job-edit'))
</div>

@endsection
