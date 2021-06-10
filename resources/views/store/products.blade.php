@extends('store.template')
@section('main-content')
<!-- Start Breadcrumbs -->
@section('breadcrumb-title')
<h1 class="page-title">Produtos</h1>
@endsection
<!-- End Breadcrumbs -->
<section class="trending-product section" style="margin-top: 12px">
    <div class="container">
        <div class="filter">
            <div class="filter-title">
                <h2>Filtro</h2>
            </div>
            <div class="filter-content">
                <div class="filter-item">
                    <div class="filter-item-title">
                        <h3>Categorias</h3>
                    </div>
                    <form action="">
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input checked type="checkbox" name="category1" id="category1" value="checkedValue"
                                    class="custom-control-input">
                                <span class="custom-control-indicator">Calçado</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="category1" id="category1" value="checkedValue"
                                    class="custom-control-input">
                                <span class="custom-control-indicator">Roupa</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input checked type="checkbox" name="category1" id="category1" value="checkedValue"
                                    class="custom-control-input">
                                <span class="custom-control-indicator">Masculino</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="category1" id="category1" value="checkedValue"
                                    class="custom-control-input">
                                <span class="custom-control-indicator">Feminino</span>
                            </label>
                        </div>
                    </form>
                </div>

                <div class="filter-item">
                    <div class="filter-item-title">
                        <h3>Marcas</h3>
                    </div>
                    <form action="">
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input checked type="checkbox" name="category1" id="category1" value="checkedValue"
                                    class="custom-control-input">
                                <span class="custom-control-indicator">Nike</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input checked type="checkbox" name="category1" id="category1" value="checkedValue"
                                    class="custom-control-input">
                                <span class="custom-control-indicator">Reebook</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="category1" id="category1" value="checkedValue"
                                    class="custom-control-input">
                                <span class="custom-control-indicator">Converce</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="category1" id="category1" value="checkedValue"
                                    class="custom-control-input">
                                <span class="custom-control-indicator">Jordan</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input checked type="checkbox" name="category1" id="category1" value="checkedValue"
                                    class="custom-control-input">
                                <span class="custom-control-indicator">Puma</span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="shop-content">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Nossos Produtos</h2>
                        <p>Uma imagem vale mais que mil palavras, e com a GoShopping, as tuas podem valer muito mais
                            ainda.</p>
                    </div>
                </div>
            </div>
            <div class="shop-products">
                @for($i = 0; $i < 4; $i++)
                    <!-- Start Single Product -->
                    <div class="single-product">
                        <div class="product-image">
                            <img src="{{ asset('store/assets/images/products/product-4.jpg') }}"
                                alt="#">
                            <span class="new-tag">Novo</span>
                            <div class="button">
                                <a href="{{ route('store.product.details', $i) }}" class="btn"><i class="lni lni-cart"></i>
                                    Adicionar</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <span class="category">Phones</span>
                            <h4 class="title">
                                <a href="product-grids.html">iphone 6x plus</a>
                            </h4>
                            <div class="price">
                                <span class="old-price">400.00 kz</span>
                                <span>400.00 kz</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product -->
                    <!-- Start Single Product -->
                    <div class="single-product">
                        <div class="product-image">
                            <img src="{{ asset('store/assets/images/products/product-5.jpg') }}"
                                alt="#">
                            <div class="button">
                                <a href="{{ route('store.product.details', $i) }}" class="btn"><i class="lni lni-cart"></i>
                                    Adicionar</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <span class="category">Headphones</span>
                            <h4 class="title">
                                <a href="product-grids.html">Wireless Headphones</a>
                            </h4>
                            <div class="price">
                                <span class="old-price">350.00 kz</span>
                                <span>350.00 kz</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product -->
                @endfor
            </div>
        </div>
    </div>
    </div>
</section>
<!-- End Trending Product Area -->

<!-- Start Call Action Area -->
<section class="call-action section">
    <div class="container">
        <div class="row ">
            <div class="col-lg-8 offset-lg-2 col-12">
                <div class="inner">
                    <div class="content">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Fale Connosco</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Please, purchase full version of the template
                            to get all pages,<br> features and commercial license.</p>
                        <div class="button wow fadeInUp" data-wow-delay=".8s">
                            <a href="#" data-bs-toggle="modal"
                            data-bs-target="#contactUsModal" class="btn">Contanta-Nos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Call Action Area -->

<!-- Start Banner Area -->
<section class="banner section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="single-banner"
                    style="background-image:url('{{ asset('store/assets/images/banner/banner-1-bg.jpg') }}')">
                    <div class="content">
                        <h2>Smart Watch 2.0</h2>
                        <p>Space Gray Aluminum Case with <br>Black/Volt Real Sport Band </p>
                        <div class="button">
                            <a href="{{ route('store.product.details', 2021 ) }}" class="btn">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="single-banner custom-responsive-margin"
                    style="background-image:url('{{ asset('store/assets/images/banner/banner-2-bg.jpg') }}')">
                    <div class="content">
                        <h2>Smart Headphone</h2>
                        <p>Lorem ipsum dolor sit amet, <br>eiusmod tempor
                            incididunt ut labore.</p>
                        <div class="button">
                            <a href="{{ route('store.product.details', 2021 ) }}" class="btn">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!-- Start Shipping Info -->
<section class="shipping-info">
    <div class="container">
        <ul>
            <!-- Free Shipping -->
            <li>
                <div class="media-icon">
                    <i class="lni lni-delivery"></i>
                </div>
                <div class="media-body">
                    <h5>Serviço de Delivery</h5>
                </div>
            </li>
            <!-- Money Return -->
            <li>
                <div class="media-icon">
                    <i class="lni lni-support"></i>
                </div>
                <div class="media-body">
                    <h5>Suporte 24h</h5>
                </div>
            </li>
            <!-- Support 24/7 -->
            <li>
                <div class="media-icon">
                    <i class="lni lni-credit-cards"></i>
                </div>
                <div class="media-body">
                    <h5>Pagamentos online</h5>
                </div>
            </li>
            <!-- Safe Payment -->
            <li>
                <div class="media-icon">
                    <i class="lni lni-reload"></i>
                </div>
                <div class="media-body">
                    <h5>Possibilidade de devolução</h5>
                </div>
            </li>
        </ul>
    </div>
</section>
<!-- End Shipping Info -->
@endsection
