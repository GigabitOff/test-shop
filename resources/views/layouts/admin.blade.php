<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="Test" name="author">
  <meta content="Название проекта" name="description">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="HandheldFriendly" content="true">
  <meta name="format-detection" content="telephone=no">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">

    <link rel="shortcut icon" href="/admin/assets/img/favicon.ico" type="image/x-icon">

    <!-- Styles
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">-->

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link href="/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <link href="/css/footable.bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/admin/assets/css/libs.min.css">
    <link rel="stylesheet" href="/admin/assets/css/main.css">

    <style>
        button.footable-page-link {
            border: none; outline: none;
            padding-top: 0px;
            margin-top: -2px;
        }
        .paginate-pages {
            padding-top: 15px;
        }

        div .error {
            color: red;
        }

         .error span, .error input {
            color: red;
            border-color: red;
        }

        .is-invalid {
            color: red;

        }
    </style>
    @livewireStyles

</head>

<body @yield('class_body', 'class="sitting"') >
    <div class="page-wrapper">
        <header class="page-head">
        <div class="page-head__inner">
            <div class="page-head__logo"><a href="{{ route('admin.index')}}">
                <h4>@lang('custom::admin.Admin panel')</h4><img class="logo__full" src="/img/logo-admin.svg" alt="logo">
            </a></div>

            <div class="page-head__content">
                <div class="container-large">
                @if(isset($title))
                <h3>{{ $title }}</h3>
                @endif
                </div>
            </div>
        </div>
        </header>
        <div class="page-content">
            <aside class="page-sidebar">
            @if(Auth::guard('admin')->user())
                @include('admin.partials.sidebar')
            @endif

            </aside>
            <main class="page-main">
                @yield('content')

            </main>
        </div>

        @livewire('admin.widgets.popups.widget-popup-alert-message-livewire')
        @livewire('admin.forms.dialog-message-livewire')

    </div>

    <script src="/admin/assets/js/libs.js"></script>
    <script src="/admin/assets/js/main.js"></script>
    <script src="/admin/assets/js/custom.js"></script>

<script src="/admin/plugins/daterangepicker/daterangepicker.js"> </script>
<script src="/admin/plugins/daterangepicker/moment.min.js"> </script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <script src="/admin/plugins/ckeditor/ckeditor.js"> </script>
    <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
    <script>
        CKFinder.config( { connectorPath: '/ckfinder/connector' } );
    </script>
   {{-- <script src="/js/jquery.mask.js"> </script>--}}

    @livewireScripts

    <!-- date-range-picker-->
    <script defer src="/admin/plugins/daterangepicker/daterangepicker.js"></script>

    <script defer src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>



<!-- Scripts-->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <script>
        screenWidth = window.screen.width;
            Refresh = 1;

        window.addEventListener('updateFooData', () => {

            setTimeout(() => {

                if(Refresh != 1){
                    $('.js-table_new').footable();
                }

                Refresh = 1;

            }, 500);
         });


    window.addEventListener('perPageUpdate', () => {

        changeJsTable();
         });

        window.addEventListener('updatedOrder', () => {
            changeJsTable();


         });

         function changeItemDataSelect(id,html) {

            html = html.replace(/ +/g, ' ').trim();
            $('#'+id).val(html);
            $('#'+id).text(html);
         }

        function changeTableFoot() {

                  //  $( ".js-table_new" ).removeAttr('wire:ignore');

                   setTimeout(() => {
                       // $( ".js-table_new" ).attr('wire:ignore');
            $('.js-table_new').footable();

                    }, 1000);

        }
            document.addEventListener("DOMContentLoaded", function(event) {

               // changeJsTable();

            });

        function changeJsTable() {
            if(screenWidth<1200){
                  //$(".for_footable").addClass("js-table_new");

                 changeTableFoot();

              //  $('.js-table_new').footable({"toggleColumn": "last"});


                }

        }

function showMascDate(item) {
            $(item).inputmask({"mask": "99.99.9999"});

        }

        function topFunction() {
window.scrollTo(0,0);
        }

        </script>

    @stack('custom-scripts')

    <style>
        table.footable>tbody>tr.footable-empty>td {
            font-size: 14pt;
        }
    </style>
</body>

</html>
