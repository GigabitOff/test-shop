@extends('layouts.admin')
@php
    $title=__('custom::admin.Users');
@endphp
@section('class_body')
    {{'class="page-main"'}}
@endsection
@section('content')
    @livewire('admin.users.user-index-livewire', key(time().'user-index-livewire'))
@endsection
