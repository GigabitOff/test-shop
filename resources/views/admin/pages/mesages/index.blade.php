@extends('layouts.admin')
@php
$title=__('custom::admin.Messages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
    @livewire('admin.pages.messages.message-index-livewire', key(time().'pages-message-index'))
@endsection
