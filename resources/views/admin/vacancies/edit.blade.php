@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection

@section('content')
<div class="container-large">
    @livewire('admin.vacancies.vacancies-edit-livewire', ['item_id'=>$id], key(time().'vacancies-edit'))
</div>

@endsection
