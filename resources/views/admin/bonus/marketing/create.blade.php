@extends('layouts.admin')
@php
$title=__('custom::admin.Bonus');
@endphp
@section('class_body'){{'class="page-marketing-sentences"'}}@endsection
@section('content')
    @livewire('admin.bonus.marketing.bonus-marketing-create-livewire', key(time().'marketing-index'))

@endsection
