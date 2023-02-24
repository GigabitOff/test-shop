@extends('layouts.admin')
@php
$title=__('custom::admin.Company structure');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
<div class="container-large">

    @livewire('admin.contucts.contuct-index-livewire', key(time().'contuct-index'))
</div>
@endsection
