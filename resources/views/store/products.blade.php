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
                        @foreach($categories as $category )
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input checked type="checkbox" name="category" value="{{ $category->name }}"
                                        class="custom-control-input">
                                    <span class="custom-control-indicator">{{ $category->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    </form>
                </div>

                <div class="filter-item">
                    <div class="filter-item-title">
                        <h3>Marcas</h3>
                    </div>
                    <form action="">
                        @foreach($brades as $brade )
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input checked type="checkbox" name="category" value="{{ $brade->name }}"
                                        class="custom-control-input">
                                    <span class="custom-control-indicator">{{ $brade->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
        <div class="shop-content">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Nossos Produtos</h2>
                        <p>Uma imagem vale mais que 1.000 palavras, e com a GoShopping, as tuas podem valer muito mais
                            ainda.</p>
                    </div>
                </div>
            </div>
            @if (count($products) == 0)
                <h5 style="margin: 20px; text-align: center">Nenhum produto disponível</h5>
            @else                
                @if(count($products) < 3 )
                    <div class="shop-products" style="grid-template-columns: repeat(auto-fit, minmax(200px, 300px))">
                        @foreach( $products as $product )
                            <div class="single-product">
                                <div class="product-image">
                                    <img src="{{ url("storage/products/". $photos->where('product_id', $product->id)->first()->photo. "") }}"
                                        alt="#">
                                    @if( $product->sale_id == 1 && $product->descount > 0 )
                                        <span class="new-tag">Promoção</span>
                                    @endif
                                    <div class="button">
                                        <a href="{{ route('store.product.details', encrypt($product->id)) }}"
                                            class="btn"><i class="lni lni-cart"></i>
                                            Visualizar</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <i class="lni lni-tag"></i>
                                    <span style="display: inline"
                                        class="category">{{ $categories->where('id', $product->category_id)->first()->name }}</span>
                                    <h4 class="title">
                                        <a
                                            href="{{ route('store.product.details', encrypt($product->id)) }}">{{ $product->name }}</a>
                                    </h4>
                                    <div class="price">
                                        @if($product->sale_id == 1 && $product->descount > 0 )
                                            <span
                                                class="old-price">{{  number_format($product->price, 0, ',', '.') }}
                                                kz</span>
                                        <span>{{ number_format($product->price -  (($product->price * $product->descount)/100), 0, ',', '.') }} kz</span>
                                        @else
                                        <span>{{ number_format($product->price, 0, ',', '.') }} kz</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('store.cart.add', encrypt($product->id)) }}"
                                        class="btn add-cart-btn">
                                        <i class="lni lni-cart"></i>
                                        Adicionar
                                    </a>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        @endforeach
                    </div>
                @else
                    <div class="shop-products">
                        @foreach( $products as $product )
                            <div class="single-product">
                                <div class="product-image">
                                    <img src="{{ url("storage/products/". $photos->where('product_id', $product->id)->first()->photo. "") }}"
                                        alt="#">
                                    @if( $product->sale_id == 1 && $product->descount > 0 )
                                        <span class="new-tag">Promoção</span>
                                    @endif
                                    <div class="button">
                                        <a href="{{ route('store.product.details', encrypt($product->id)) }}"
                                            class="btn"><i class="lni lni-cart"></i>
                                            Visualizar</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <i class="lni lni-tag"></i>
                                    <span style="display: inline"
                                        class="category">{{ $categories->where('id', $product->category_id)->first()->name }}</span>
                                    <h4 class="title">
                                        <a
                                            href="{{ route('store.product.details', encrypt($product->id)) }}">{{ $product->name }}</a>
                                    </h4>
                                    <div class="price">
                                        @if($product->sale_id == 1 && $product->descount > 0 )
                                            <span
                                                class="old-price">{{ number_format($product->price, 0, ',', '.') }}
                                                kz</span>
                                        <span>{{ number_format($product->price  -  (($product->price * $product->descount)/100), 0, ',', '.') }} kz</span>
                                        @else
                                        <span>{{ number_format($product->price, 0, ',', '.') }} kz</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('store.cart.add', encrypt($product->id)) }}"
                                        class="btn add-cart-btn">
                                        <i class="lni lni-cart"></i>
                                        Adicionar
                                    </a>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        @endforeach
                    </div>
                @endif
            @endif
            {{ $products->links() }}
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
                            <a href="#" data-bs-toggle="modal" data-bs-target="#contactUsModal"
                                class="btn">Contanta-Nos</a>
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
                        <p>Conecta-te ao mundo das tecnologias<br>com a GoShopping</p>
                        <div class="button">
                            <a href="#"
                                class="btn" data-bs-toggle="modal" data-bs-target="#soon1Item">Saber Mais</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="single-banner custom-responsive-margin"
                    style="background-image:url('{{ asset('store/assets/images/banner/banner-2-bg.jpg') }}')">
                    <div class="content">
                        <h2>Smart Headphone</h2>
                        <p>Conecta-te ao mundo das tecnologias<br>com a GoShopping</p>
                        <div class="button">
                            <a href="#"
                                class="btn" data-bs-toggle="modal" data-bs-target="#soon2Item">Saber Mais</a>
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
