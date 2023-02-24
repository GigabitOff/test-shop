@extends('layouts.admin')
@php
    $title=__('custom::admin.Users');
@endphp
@section('class_body')
    {{'class=users'}}
@endsection
@section('content')
    @livewire('admin.users.user-edit-livewire', ['item_id'=>$id], key(time().'users-edit'))
@endsection
