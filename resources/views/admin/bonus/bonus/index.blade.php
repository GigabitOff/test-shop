@extends('layouts.admin')
@php
$title=__('custom::admin.Bonus');
@endphp
@section('class_body'){{'class="shop-pages"'}}@endsection
@section('content')
<div class="container-large">
@livewire('admin.bonus.bonus.bonus-bonus-index-livewire', key(time().'bonus-index'))
</div>
@endsection
