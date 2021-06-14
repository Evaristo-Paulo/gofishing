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
        href="{{ asset('painel/vendors/styles/zpreloader.css') }}">
        <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/vendors/styles/login.css') }}">

        <style>
            body {
                background: url({{ asset('painel/src/images/img5.jpg') }})
            }
        </style>
</head>

<body>
    <div class="wrapper">
        <header>
            <nav>
                <ul class="menu">
                    <li class="logo">
                        <a href="#">
                            <img src="{{ asset('store/assets/images/logo/new-logo.svg') }}"
                                alt="">
                        </a>
                    </li>
                    <ul>
                        <li><a href="{{ route('painel.home') }}">Entrar</a></li>
                        <li><a href="">Sair</a></li>
                    </ul>
                </ul>
            </nav>
        </header>

        <div class="login-container">
            <div class="login">
                <div class="form-box">
                    <div class="title">
                        <img src="{{ asset('store/assets/images/logo/logo.svg') }}">
                        <h2>Seja bem-vindo</h2>
                    </div>
                    
                    <form action="{{ route('painel.login.store') }}" method="POST">
                    {{ csrf_field() }}
                    @if (session('error'))
                        <p class="request-error-message text-center">{{ session('error') }}</p>
                    @endif
                    <div class="form-group">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="email" required value="{{ old('email') }}" class="form-control" name="email" id="email">
                        @if($errors->has('email'))
                            <span class="request-error-message">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" required class="form-control" name="password" id="password">
                        @if($errors->has('password'))
                            <span class="request-error-message">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary  w-100">Entrar</button>
                </form>
                </div>
            </div>
        </div>


    </div>
    <!-- js -->
    <script src="{{ asset('painel/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/zpreloader.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/layout-settings.js') }}"></script>
</body>

</html>
