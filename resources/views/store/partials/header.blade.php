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
                        @auth
                        <div class="user">
                            <i class="lni lni-user"></i>
                            {{ $people->where('id', Auth::user()->people_id)->first()->name }}
                        </div> 
                        @endauth
                        <ul class="user-login">
                            @auth
                                <li>
                                    <a href="{{ route('store.logout') }}">Sair</a>
                                </li>
                            @else
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Entrar</a>
                                </li>
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Registar</a>
                                </li>
                            @endauth
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
                    <a class="navbar-brand" href="{{ route('store.products') }}">
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
                                    <span
                                        class="total-items">{{ Session::has('cart') ? Session::get('cart')->totalQty : 0 }}</span>
                                </a>
                                <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>Carrinho</span>
                                        <span>{{ Session::has('cart') ? Session::get('cart')->totalQty : 0 }}
                                            Item(s)</span>
                                    </div>
                                    @if(Session::has('cart'))
                                        <ul class="shopping-list">
                                            @foreach ( $hproducts as $product )
                                            <li>
                                                <a href="{{ route('store.cart.remove.item', encrypt($product['item']['id'])) }}"
                                                    class="remove" title="Remover este item"><i
                                                        class="lni lni-close text-danger"></i></a>
                                                <div class="cart-img-head">
                                                    <a class="cart-img"
                                                        href="{{ route('store.product.details', encrypt($product['item']['id'])) }}"><img
                                                            src="{{ url("storage/products/". $photos->where('product_id', $product['item']['id'])->first()->photo. "") }}"
                                                            alt="#"></a>
                                                </div>
                                                <div class="content">
                                                    <h4><a
                                                            href="{{ route('store.product.details', encrypt($product['item']['id'])) }}">
                                                            {{ $product['item']['name'] }}</a>
                                                    </h4>
                                                    <p class="quantity">{{ $product['qty'] }}x -
                                                        @if ($product['item']['sale_id'] ==1 && $product['item']['descount'] > 0)
                                                        <span
                                                        class="amount">{{ number_format($product['item']['price'] - (($product['item']['price'] * $product['item']['descount'])/100), 0, ',', '.') }}
                                                        kz</span></p> 
                                                        @else
                                                        <span
                                                        class="amount">{{ number_format($product['item']['price'], 0, ',', '.') }}
                                                        kz</span></p>
                                                        @endif
                                                        
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total Pedido</span>
                                                <span class="total-amount">{{ number_format($totalPrice, 0, ',', '.') }} kz</span>
                                            </div>
                                            <div class="button">
                                                <a href="{{ route('store.cart') }}"
                                                    class="btn my-2 animate">Carrinho</a>
                                                <a href="#" class="btn animate"
                                                    style="background-color: #218838">Checkout</a>
                                            </div>
                                        </div>
                                    @else
                                        <ul class="shopping-list">
                                            <li>
                                                Nenhum item no carrinho
                                            </li>
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total Pedido</span>
                                                <span class="total-amount">0 kz</span>
                                            </div>
                                            <div class="button">
                                                <a href="{{ route('store.cart') }}"
                                                    class="btn my-2 animate"><i class="lni lni-cart"></i> Carrinho</a>
                                            </div>
                                        </div>
                                    @endif
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
                                    <a href="{{ route('store.products') }}"
                                        aria-label="Toggle navigation">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#contactUsModal"
                                        aria-label="Toggle navigation">Contacta-nos</a>
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
                            <a href="javascript:void(0)"><i class="lni lni-instagram"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- End Nav Social -->

                <!-- Start Login and Register -->
                <ul class="user-login-mobile">
                    @auth
                        <li><a
                                href="#">{{ $people->where('id', Auth::user()->people_id)->first()->name }}</a>
                        </li>
                        <li><a href="{{ route('store.logout') }}">Sair</a></li>
                    @else
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Registar</a></li>
                    @endauth
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
                    <li><a href="{{ route('store.products') }}"><i class="lni lni-home"></i> Home</a></li>
                    <li><a href="{{ route('store.products') }}">Produtos</a></li>
                    @yield('breadcrumb-subtitle')
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
