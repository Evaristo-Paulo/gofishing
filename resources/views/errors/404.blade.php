<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Goshopping</title>
    <!-- Site favicon -->
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('store/assets/images/favicon.svg') }}" />
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('painel/vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/vendors/styles/style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/vendors/styles/zpreloader.css') }}">

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
    <div class="error-page d-flex align-items-center flex-wrap justify-content-center pd-20">
        <div class="pd-10">
            <div class="error-page-wrap text-center">
                <h1>404</h1>
                <h3>Página Não Encontrada</h3>
                <p>Desculpa, não conseguimos localizar a página que você procura.<br>Verifique a URL.</p>
                <div class="pt-20 mx-auto max-width-200">
                    <a href="{{ route('store.products') }}"
                        class="btn bg-primary-2 text-white btn-block btn-lg">Voltar Para Home</a>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="{{ asset('painel/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/layout-settings.js') }}"></script>
</body>

</html>


