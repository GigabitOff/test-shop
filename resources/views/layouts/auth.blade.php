<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="Test" name="author">
    <meta content="Название проекта" name="description">
    <meta name="HandheldFriendly" content="true">
    <meta name="format-detection" content="telephone=no">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">

    <!-- Styles
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">-->

    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>

    @livewireStyles

  {{--<link rel="shortcut icon" href="/admin/assets/img/favicon.png" type="image/x-icon">--}}
  <link rel="stylesheet" href="/admin/assets/css/libs.min.css">
  <link rel="stylesheet" href="/admin/assets/css/main.css">
</head>

<body @yield('class_body', 'class="home"') >
    <div class="page-index">
        <div class="login-form-box">

        @yield('content')
        <div class="login-copy">
            <span>© 2023 Розроблено</span><a href="" target="_blank">Test company</a></div>
        </div>
    <div class="modal modal-message fade" id="m-phone-country" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">@lang('custom::admin.Country code selection')</h5>
          </div>
          <div class="modal-body">
            <ul class="coutry-number-list">

                <li data-bs-dismiss="modal" data-coutry-number="+375"><label class="radio"><input class="check__input" type="radio" name="coutry-number"><span class="check__box"><span>Назва країни</span><span>+375</span></span></label></li>

            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="modal modal-message fade" id="m-phone-success" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body"><img src="/admin/assets/img/phone-success.svg" alt="image">
            <h4>@lang('custom::admin.Success recovery phone')</h4>
            <div class="mt-5">
                <button class="button w-100" type="button" onclick="resetDataRecovery();">@lang('custom::admin.Enter new password')</button></div>
          </div>
        </div>
      </div>
    </div>
    </div>

      @livewireScripts

    <script src="/admin/assets/js/libs.js"></script>
    <script src="/admin/assets/js/main.js"></script>
    <script src="/js/jquery.mask.js"> </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
                $('.js-phone').mask("+38(999) 999-99-99");
        });
    </script>
</body>

</html>
