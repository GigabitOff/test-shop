@extends('layouts.admin')
@php
$title=__('custom::admin.Options');
@endphp
@section('class_body'){{'class="options"'}}@endsection
@section('content')
<div class="container-large">
@livewire('admin.options.option-index-livewire', key(time().'option-index'))
</div>
@endsection
