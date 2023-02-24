@extends('layouts.admin')
@php
$title=__('custom::admin.Company structure');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
<div class="container-medium">

    @livewire('admin.contucts.contuct-create-livewire',
                key(time().'contuct-index'))
</div>
@endsection

