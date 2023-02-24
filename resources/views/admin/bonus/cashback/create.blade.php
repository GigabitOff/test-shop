@extends('layouts.admin')
@php
$title=__('custom::admin.Bonus');
@endphp
@section('class_body'){{'class="cashback"'}}@endsection
@section('content')
    @livewire('admin.bonus.cashback.bonus-cashback-create-livewire', key(time().'cashback-index'))

@endsection
