@extends('layouts.admin')
@php
$title=__('custom::admin.Bonus');
@endphp
@section('class_body'){{'class="shop-pages"'}}@endsection
@section('content')
<div class="container-large">
@livewire('admin.bonus.personal.bonus-personal-index-livewire', key(time().'personal-index'))
</div>
@endsection
