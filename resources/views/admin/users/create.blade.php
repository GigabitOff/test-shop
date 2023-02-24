@extends('layouts.admin')

@php
$title=__('custom::admin.Users');
@endphp
@section('class_body'){{'class=users'}}@endsection
@section('content')
    @livewire('admin.users.user-create-livewire', key(time().'users-create'))

@endsection
