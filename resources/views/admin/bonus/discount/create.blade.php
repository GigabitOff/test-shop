@extends('layouts.admin')
@php
$title=__('custom::admin.Bonus');
@endphp
@section('class_body'){{'class=pages'}}@endsection
@section('content')
    @livewire('admin.bonus.discount.bonus-discount-create-livewire', key(time().'discount-index'))

@endsection
