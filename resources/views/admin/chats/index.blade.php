@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=messeges'}}@endsection
@section('content')
    @livewire('admin.chats.chat-index-livewire', key(time().'chat-index'))

@endsection
