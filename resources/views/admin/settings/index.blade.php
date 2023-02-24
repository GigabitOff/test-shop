@extends('layouts.admin')
@php
    $title=__('custom::admin.Settings general');
@endphp
@section('class_body')
    {{'class="sitting-general"'}}
@endsection

@section('content')

    @livewire('admin.settings.setting-index-livewire', key(time().'Settings-index'))

@endsection
