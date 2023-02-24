@extends('layouts.admin')
@php
$title=__('custom::admin.Bonus');
@endphp
@section('class_body'){{'class="cashback"'}}@endsection
@section('content')
    @livewire('admin.bonus.personal.bonus-personal-edit-livewire', ['item_id'=>$id], key(time().'personal-edit'))
@endsection
