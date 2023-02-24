@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection
@section('content')
    @livewire('admin.actions.action-edit-livewire', ['action_data'=>$data,'item_id'=>$id], key(time().'action-edit'))


@endsection
