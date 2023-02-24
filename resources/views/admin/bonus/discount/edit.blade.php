@extends('layouts.admin')
@php
$title=__('custom::admin.Bonus');
@endphp
@section('class_body'){{'class=pages'}}@endsection
@section('content')
    @livewire('admin.bonus.discount.bonus-discount-edit-livewire', ['action_product'=>$data,'item_id'=>$id], key(time().'brand-edit'))
@endsection
