@extends('layouts.admin')
@php
$title=__('custom::admin.Bonus');
@endphp
@section('class_body'){{'class="cashback"'}}@endsection
@section('content')
    @livewire('admin.bonus.cashback.bonus-cashback-edit-livewire', ['item_id'=>$id], key(time().'cashback-edit'))

    @endsection
