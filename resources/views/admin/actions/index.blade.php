@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
<div class="container-large">
    @livewire('admin.actions.action-index-livewire', key(time().'action-index'))
</div>
@endsection
