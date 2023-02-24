@extends('layouts.auth')

@section('content')
    <div class="login-form">
        <div class="border">
            <span class="top"></span>
            <span class="left"></span>
            <span class="bottom"></span>
            <span class="right-top"></span>
            <span class="right-bottom"></span>
        </div>
        <div class="decor"></div>
        @livewire('admin.auth.admin-login-livewire', key(time().'admin-login'))

      </div>

@endsection


