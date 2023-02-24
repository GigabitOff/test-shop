@extends('layouts.admin')
@php
$title=__('custom::admin.Bonus');
@endphp
@section('class_body'){{'class="shop-pages"'}}@endsection
@section('content')
<div class="container-large">
@livewire('admin.bonus.cashback.bonus-cashback-index-livewire', key(time().'cashback-index'))
</div>
@endsection
