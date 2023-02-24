@extends('layouts.admin')

@php
$title=__('custom::admin.Counterparties');
@endphp
@section('class_body'){{'class=sitting'}}@endsection

@section('content')

    @livewire('admin.counterparties.counterparty-create-livewire', key(time().'counterparties-create'))

@endsection
