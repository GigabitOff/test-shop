@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')

@livewire('admin.pages.news.news-edit-livewire', ['item_id'=>$id], key(time().'-news-edit'))

@endsection
