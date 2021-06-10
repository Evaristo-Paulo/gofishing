<header class="header navbar-area">
    <!-- Start Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="top-left">
                        <ul class="menu-top-link">
                            <li><i class="lni lni-phone"></i> (+244) 940570866</li>
                            <li><i class="lni lni-map-marker"></i> Central. Sequele, Cacuaco, Luanda</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="top-end">
                        <div class="user">
                            <i class="lni lni-user"></i>
                            Evaristo Paulo
                        </div>
                        <ul class="user-login">
                            <li>
                                <a href="login.html" data-bs-toggle="modal" data-bs-target="#loginModal">Entrar</a>
                            </li>
                            <li>
                                <a href="register.html" data-bs-toggle="modal"
                                    data-bs-target="#registerModal">Registar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <!-- Start Header Middle -->
    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-7">
                    <!-- Start Header Logo -->
                    <a class="navbar-brand" href="{{ route('store.home') }}">
                        <img src="{{ asset('store/assets/images/logo/logo.svg') }}"
                            alt="Logo">
                    </a>
                    <!-- End Header Logo -->
                </div>
                <div class="col-lg-5 col-md-7 d-xs-none">
                    <!-- Start Main Menu Search -->
                    <div class="main-menu-search">
                        <!-- navbar search start -->
                        <div class="navbar-search search-style-5">
                            <div class="search-input">
                                <input type="text" placeholder="Pesquisar">
                            </div>
                            <div class="search-btn">
                                <button><i class="lni lni-search-alt"></i></button>
                            </div>
                        </div>
                        <!-- navbar search Ends -->
                    </div>
                    <!-- End Main Menu Search -->
                </div>
                <div class="col-lg-4 col-md-2 col-5">
                    <div class="middle-right-area">
                        <div class="nav-hotline">
                        </div>
                        <div class="navbar-cart">
                            <div class="cart-items">
                                <a href="javascript:void(0)" class="main-btn">
                                    <i class="lni lni-cart"></i>
                                    <span class="total-items">2</span>
                                </a>
                                <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>Carrinho</span>
                                        <span>2 Items</span>
                                    </div>
                                    <ul class="shopping-list">
                                        @for($i = 0; $i < 2; $i++)
                                        <li>
                                            <a href="javascript:void(0)" class="remove" title="Remover este item"><i
                                                    class="lni lni-close text-danger"></i></a>
                                            <div class="cart-img-head">
                                                <a class="cart-img" href="{{ route('store.product.details', $i)  }}"><img
                                                        src="{{ asset('store/assets/images/header/cart-items/item1.jpg') }}"
                                                        alt="#"></a>
                                            </div>

                                            <div class="content">
                                                <h4><a href="{{ route('store.product.details', $i) }}">
                                                        Apple Watch Series 6</a></h4>
                                                <p class="quantity">1x - <span class="amount">$99.00</span></p>
                                            </div>
                                        </li>
                                        @endfor
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">$134.00</span>
                                        </div>
                                        <div class="button">
                                            <a href="{{ route('store.cart') }}" class="btn my-2 animate">Carrinho</a>
                                            <a href="#" class="btn animate" style="background-color: #218838">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Shopping Item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Middle -->
    <!-- Start Header Bottom -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-6 col-12">
                <div class="nav-inner">
                    <!-- Start Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a href="{{ route('store.home') }}" aria-label="Toggle navigation">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dd-menu collapsed active" href="javascript:void(0)"
                                        data-bs-toggle="collapse" data-bs-target="#submenu-1-2"
                                        aria-controls="navbarSupportedContent" aria-expanded="false"
                                        aria-label="Toggle navigation">Loja</a>
                                    <ul class="sub-menu collapse" id="submenu-1-2">
                                        <li class="nav-item"><a href="{{ route('store.cart') }}">Carrinho</a></li>
                                        <li class="nav-item"><a href="{{ route('store.products') }}">Nossos Produtos</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#contactUsModal"  aria-label="Toggle navigation">Contacta-nos</a>
                                </li>
                            </ul>
                        </div> <!-- navbar collapse -->
                    </nav>
                    <!-- End Navbar -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Nav Social -->
                <div class="nav-social">
                    <h5 class="title">Rede Social:</h5>
                    <ul>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-instagram"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- End Nav Social -->

                <!-- Start Login and Register -->
                <ul class="user-login-mobile">
                    <li><i class="lni lni-user"></i>
                        Evaristo Paulo</li>
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Registar</a></li>
                </ul>
                <!-- End Login and Register -->
            </div>
        </div>
    </div>
    <!-- End Header Bottom -->
</header>
<!-- Start Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    @yield('breadcrumb-title')
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="{{ route('store.home') }}"><i class="lni lni-home"></i> Home</a></li>
                    <li><a href="{{ route('store.products') }}">Produtos</a></li>
                    @yield('breadcrumb-subtitle')
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
