<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>GoShopping</title>

    <!-- Site favicon -->
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('store/assets/images/favicon.svg') }}" />
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('painel/vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/vendors/styles/style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/vendors/styles/zpreloader.css') }}">
        @stack('css')


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

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->
    @include('painel.partials.header')

    @include('painel.partials.sidebar')

    <div class="mobile-menu-overlay"></div>
    
    @yield('main-content')

    @include('painel.partials.modal')
    <!-- js -->
    <script src="{{ asset('painel/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/zpreloader.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('painel/src/plugins/datatables/js/jquery.dataTables.min.js') }}">
    </script>
    <script
        src="{{ asset('painel/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script
        src="{{ asset('painel/src/plugins/datatables/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ asset('painel/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}">
    </script>
    
    @stack('js')
</body>

</html>
