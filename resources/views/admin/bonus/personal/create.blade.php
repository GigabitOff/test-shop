@extends('layouts.admin')
@php
$title=__('custom::admin.Bonus');
@endphp
@section('class_body'){{'class="cashback"'}}@endsection
@section('content')
    @livewire('admin.bonus.personal.bonus-personal-create-livewire', key(time().'personal-index'))

@endsection
