<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}}</title>

    <meta content="Test" name="author">
    <meta content="@yield('meta_description')" name="description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="HandheldFriendly" content="true">
    <meta name="format-detection" content="telephone=no">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <link rel="shortcut icon" href="/assets/img/favicon.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/libs.min.css?ver={{config('app.release_no')}}">
    <link rel="stylesheet" href="/assets/css/main.css?ver={{config('app.release_no')}}">
    <link rel="stylesheet" href="/assets/css/custom.css?ver={{config('app.release_no')}}">

</head>

<body>
<div class="page-wrapper">
    <div class="container py-5">
        {{ $slot }}
    </div>
    @stack('custom-scripts')
</div>
</body>
</html>
