@extends('layouts.admin')

@php
$title=__('custom::admin.Counterparties');
@endphp
@section('class_body'){{'class=sitting'}}@endsection

@section('content')

    @livewire('admin.counterparties.counterparty-edit-livewire', ['item_id'=>$id], key(time().'counterparty-edit'))

@endsection
