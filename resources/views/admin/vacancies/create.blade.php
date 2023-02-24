@extends('layouts.admin')
@php
$title=__('custom::admin.Pages');
@endphp
@section('class_body'){{'class=sitting'}}@endsection

@section('content')
<div class="container-large">
    @livewire('admin.vacancies.vacancies-create-livewire', key(time().'vacancies-create'))
</div>
@endsection
