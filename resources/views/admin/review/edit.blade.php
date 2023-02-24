@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
    @livewire('admin.review.review-edit-livewire', ['item_id'=>$id], key(time().'review-edit'))

@endsection
