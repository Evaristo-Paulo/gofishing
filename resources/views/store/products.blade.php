@extends('store.template')
@section('main-content')
<!-- Start Breadcrumbs -->
@section('breadcrumb-title')
<h1 class="page-title">Produtos</h1>
@endsection
<!-- End Breadcrumbs -->
<section class="trending-product section" style="margin-top: 12px">
    <div class="container">
        @include('store.partials.filter')
        <div class="shop-content">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Nossos Produtos</h2>
                        <p>Uma imagem vale mais que 1.000 palavras, e com a Goshopping, as tuas podem valer muito mais
                            ainda.</p>
                    </div>
                </div>
            </div>
            @if (count($products) == 0)
                @if (isset($search))
                    <h5 style="margin: 20px; text-align: center">Nenhum produto correspondente</h5>
                @else
                    <h5 style="margin: 20px; text-align: center">Nenhum produto disponível</h5>
                @endif
            @else                
                @if(count($products) < 3 )
                    <div class="shop-products" style="grid-template-columns: repeat(auto-fit, minmax(200px, 300px))">
                        @foreach( $products as $product )
                            <div class="single-product @if($product->stock == 0 ) single-product-out-of-stock @endif">
                                <div class="product-image">
                                    <img src="{{ url("storage/products/". $photos->where('product_id', $product->id)->first()->photo. "") }}"
                                        alt="#">
                                    @if( $product->sale_id == 1 && $product->descount > 0 )
                                        <span class="new-tag">Promoção</span>
                                    @endif
                                    @if( $product->stock == 0)
                                        <span class="new-tag out-stock-box">Esgotado</span>
                                    @endif
                                    <div class="button">
                                        <a href="{{ route('store.product.details', encrypt($product->id)) }}"
                                            class="btn"><i class="lni lni-eye"></i>
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
                            <div class="single-product @if($product->stock == 0 ) single-product-out-of-stock @endif">
                                <div class="product-image">
                                    <img src="{{ url("storage/products/". $photos->where('product_id', $product->id)->first()->photo. "") }}"
                                        alt="#">
                                    @if( $product->sale_id == 1 && $product->descount > 0 )
                                        <span class="new-tag">Promoção</span>
                                    @endif
                                    @if( $product->stock == 0)
                                        <span class="new-tag out-stock-box">Esgotado</span>
                                    @endif
                                    <div class="button">
                                        <a href="{{ route('store.product.details', encrypt($product->id)) }}"
                                            class="btn"><i class="lni lni-eye"></i>
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
                        <p class="wow fadeInUp" data-wow-delay=".6s">Nossos profissionais estão prontos para puder lhe ajudar.</p>
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
                        <p>Conecta-te ao mundo das tecnologias<br>com a Goshopping</p>
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
                        <p>Conecta-te ao mundo das tecnologias<br>com a Goshopping</p>
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

@endsection
