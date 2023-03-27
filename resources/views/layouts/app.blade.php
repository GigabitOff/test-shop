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
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">

    @stack('canonical')

    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/libs.min.css?ver={{config('app.release_no')}}">
    <link rel="stylesheet" href="/assets/css/main.css?ver={{config('app.release_no')}}">
{{--    <link rel="stylesheet" href="/assets/css/custom.css?ver={{config('app.release_no')}}">--}}


    @stack('custom-styles')

    @livewireStyles

</head>

<body class="{{$bodyClasses}}">
<div class="page-wrapper">
    <x-header/>
    {{ $slot }}
    <x-footer/>

{{--    // ToDo: перенести воркеры в футер. При необходимости удалить лишнее--}}
    <!-- Compare worker for add/remove/toggle/clear compare products -->
    <livewire:components.compare-worker-livewire />

    <!-- Favorite worker for add/remove/toggle/clear favorite products -->
    <livewire:components.favorite-worker-livewire/>

    <!-- Cart worker for add/remove/clear cart products -->
    <livewire:components.cart-worker-livewire/>

{{--    // Глобальные модальные окна (видны на всех страницах приложения)  --}}
    <x-global-modals />

{{--    // Персональные модальные окна для каждой страницы  --}}
    @stack('custom-modals')

    @stack('before-scripts')

    <script src="/assets/js/libs.js?ver={{config('app.release_no')}}"></script>
    <script src="/assets/js/main.js?ver={{config('app.release_no')}}"></script>
    <script src="/assets/js/footableEx.js?ver={{config('app.release_no')}}"></script>
    <script src="/assets/js/custom.js?ver={{config('app.release_no')}}"></script>
    @livewireScripts
    <script>
        Livewire.onPageExpired((response, message) => {
            confirm(__('custom::site.page_has_expired')) && window.location.reload()
        })
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <x-modal-form id="modal-user-notification">
        {{-- Форма показа уведомлений --}}
        <livewire:forms.notification-message-livewire/>
    </x-modal-form>

    @stack('show-data')

    {{--    // Персональные скрипты для каждой страницы  --}}
    @stack('custom-scripts')
</div>
</body>
</html>
