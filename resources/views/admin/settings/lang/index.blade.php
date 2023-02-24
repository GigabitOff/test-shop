@php
$title=__('custom::admin.Settings');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@extends('layouts.admin')
@section('content')
<div class="container-medium">
    @livewire('admin.settings.setting-lang-livewire', key(time().'Settings-lang'))
</div>
@endsection
