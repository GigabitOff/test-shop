@extends('layouts.admin')
@php
$title=__('custom::admin.Pages edit');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
@livewire('admin.pages.page-edit-livewire', ['item_id'=>$id], key(time().'page-edit'))

@endsection
