<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Laravel | @yield('adminTitle')</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/vendors/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/assets/vendors/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/assets/vendors/images/favicon-16x16.png') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!--font-awesome CDN  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/assets/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/styles/style.css') }}">

    {{-- TOSTER CDN --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
     alpha/css/bootstrap.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />



    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
    @stack('style')
</head>

<body>


    @include('partials.backend.header')
    @include('partials.backend.sidebar')

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            @yield('content')

            <div class="footer-wrap pd-20 mb-30 card-box">
                Develop By <a href="#" target="_blank">Neeta Bopche</a>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="{{ asset('backend/assets/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/scripts/dashboard.js') }}"></script>

    <!-- buttons for Export datatable -->
    <script src="{{ asset('backend/assets/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('backend/assets/vendors/scripts/datatable-setting.js') }}"></script>
    <!-- Sweat Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    {{-- Toster Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('status'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": 15000,
                // "positionClass": "toast-bottom-left",
            }
            toastr.success("{{ session('status') }}");
        @endif
    </script>

    @stack('script')
</body>

</html>
