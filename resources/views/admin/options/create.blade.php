@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class="options"'}}@endsection
@section('content')
<div class="container-small">
    @livewire('admin.options.option-create-livewire', key(time().'brand-index'))
</div>
@endsection
