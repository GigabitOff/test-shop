@extends('layouts.admin')
@php
$title=__('custom::admin.Bonus');
@endphp
@section('class_body'){{'class="page-marketing-sentences"'}}@endsection
@section('content')
<div class="container-large">
@livewire('admin.bonus.marketing.bonus-marketing-index-livewire', key(time().'marketing-index'))
</div>
@endsection
