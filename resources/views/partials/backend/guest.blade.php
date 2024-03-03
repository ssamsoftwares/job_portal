<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>@yield('authTitle')</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/vendors/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('backend/assets/vendors/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('backend/assets/vendors/images/favicon-16x16.png') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/assets/src/plugins/jquery-steps/jquery.steps.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/styles/style.css') }}">

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
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <div class="brand-logo">
                <a href="#">
                    <img src="https://jobspitch.in/site/images/logo.png" alt="">
                </a>
            </div>

            <div class="select-role m-2">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn">
                        <a href="{{route('candidateRegistration')}}">
                        <div class="icon"><img src="{{ asset('backend/assets/vendors/images/briefcase.svg') }}" class="svg" alt=""></div>
                        <span>Register Candidate</span></a>

                    </label>

                    <label class="btn">
                        <a href="{{route('employerRegistration')}}">
                        <div class="icon"><img src=" {{ asset('backend/assets/vendors/images/person.svg') }}" class="svg" alt=""></div>
                        <span>Register Employer</span></a>
                    </label>

                </div>
            </div>


        </div>
    </div>

    @yield('authContent')

    <!-- success Popup html End -->
    <!-- js -->

    <script src="{{ asset('backend/assets/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/jquery-steps/jquery.steps.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/scripts/steps-setting.js') }}"></script>

    @stack('script')
</body>

</html>
