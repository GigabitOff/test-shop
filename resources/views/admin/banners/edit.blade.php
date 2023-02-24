@extends('layouts.admin')
@php
    $title=__('custom::admin.Banners');
@endphp
@section('class_body')
    {{'class=page-main'}}
@endsection
@section('content')
    <div class="container-large">
        @livewire('admin.banners.banner-edit-livewire', ['item_id'=>$id], key(time().'banner-edit'))
    </div>
@endsection
