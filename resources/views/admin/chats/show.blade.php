@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
<div class="container-large">
    @livewire('admin.chats.chat-show-livewire',['chat'=>$chat], key(time().'chat-show'))
</div>
@endsection