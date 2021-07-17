<!DOCTYPE html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Goshopping</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('store/assets/images/favicon.svg') }}" />
    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('store/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('store/assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('store/assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('store/assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('store/assets/css/main.css') }}" />
    @stack('css')
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
    @include('sweetalert::alert')

    @include('store.partials.modal')
    
    <!-- Start Header Area -->
    @include('store.partials.header')
    <!-- End Header Area -->

    <!-- Start Main Content -->
    @yield('main-content')
    <!-- End Main Content -->
    
    <!-- Start Footer Area -->
    @include('store.partials.footer')
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('store/vendors/jquery/dist/jquery.min.js') }}" ></script>
    <script src="{{ asset('store/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('store/assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('store/assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('store/assets/js/main.js') }}"></script>
    @stack('js')
    <script type="text/javascript">
        //========= Hero Slider 
        tns({
            container: '.hero-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        });

        //======== Brand Slider
        tns({
            container: '.brands-logo-carousel',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 6,
                }
            }
        });

    </script>
</body>

</html>
