@extends('store.template')
@section('main-content')
<!-- Start Breadcrumbs -->
@section('breadcrumb-title')
<h1 class="page-title">Detalhes Do Produto</h1>
@endsection
@section('breadcrumb-subtitle')
<li>Detalhes do produto</li>
@endsection
<!-- End Breadcrumbs -->

<!-- Start Item Details -->
<section class="item-details section">
    <div class="container">
        <div class="top-area">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="product-images">
                        <main id="gallery">
                            <div class="main-img">
                                <img src="{{ url("storage/products/". $product[0]->photo. "") }}"
                                    id="current" alt="#">
                            </div>
                            <div class="images">
                                @foreach( $product as $item )
                                    <img src="{{ url("storage/products/". $item->photo. "") }}"
                                        class="img" alt="#">
                                @endforeach
                            </div>
                        </main>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="product-info">
                        <h2 class="title">{{ $product[0]->name }}</h2>
                        <p class="category"><i class="lni lni-tag"></i> Categoria:<a
                                href="javascript:void(0)">{{ $categories->where('id',$product[0]->category_id)->first()->name }}</a>
                        </p>
                        <p class="info-text">{{ $product[0]->specification }}</p>
                        @if ($product[0]->sale_id == 1 && $product[0]->descount > 0)
                            <h3 class="price">Desconto de {{ $product[0]->descount }}%</h3>
                        @endif
                        <h3 class="price">
                            @if ($product[0]->sale_id == 1 && $product[0]->descount > 0)
                                <span class="old-price">{{ number_format($product[0]->price, 0, ',', '.') }}kz</span>
                                {{ number_format($product[0]->price - (($product[0]->price * $product[0]->descount )/100), 0, ',', '.')}} kz
                            @else
                            {{ number_format($product[0]->price, 0, ',', '.')}} kz
                            @endif
                        </h3>
                        <p>Stock: {{ $qtd_stock }} unidade(s)</p>
                        <div class="button-group">
                            <div class="bottom-content">
                                <form
                                    action="{{ route('store.cart.add', encrypt($product[0]->id) ) }}"
                                    method="GET">
                                    {{ csrf_field() }}

                                    <button class="btn btn-primary" style="width: 100%;"><i class="lni lni-cart"></i>
                                        Adicionar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-details-info">
            <div class="single-block">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="info-body">
                            <h4>Especificações</h4>
                            <ul class="normal-list">
                                <li><span>Categoria:</span>
                                    {{ $categories->where('id', $product[0]->category_id )->first()->name }}
                                </li>
                                <li><span>Marca:</span>
                                    {{ $brades->where('id', $product[0]->brade_id )->first()->name }}
                                </li>
                                <li><span>Estilo:</span>
                                    {{ $styles->where('id', $product[0]->style_id )->first()->type }}
                                </li>
                                <li><span>Tamanho:</span> {{ $product[0]->size }}</li>
                                <li><span>Stock:</span> {{ $qtd_stock }} unidade(s)</li>
                                <li><span></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="info-body custom-responsive-margin">
                            <h4>Descrição</h4>
                            <p>{{ $product[0]->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Item Details -->

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
<!-- Start Item Details -->
<section class="item-details section">
    <div class="container">
        <div class="shop-content">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Produtos que talvez gostas</h2>
                        <p>Melhor que 1 par, só mesmo vários pares.</p>
                    </div>
                </div>
            </div>
            @if( count($youMayLike) < 3 )
                <div class="shop-products" style="grid-template-columns: repeat(auto-fit, minmax(200px, 400px))">
                    @forelse( $youMayLike as $product )
                        <div class="single-product @if($product['stock'] == 0 ) single-product-out-of-stock @endif">
                            <div class="product-image">
                                <img src="{{ url("storage/products/". $photos->where('product_id', $product['id'])->first()->photo. "") }}"
                                    alt="#">
                                @if( $product['sale_id'] == 1 && $product['descount'] > 0 )
                                    <span class="new-tag">Promoção</span>
                                @endif
                                @if( $product['stock'] == 0 )
                                    <span class="new-tag">Esgostado</span>
                                @endif
                                <div class="button">
                                    <a href="{{ route('store.product.details', encrypt($product['id'])) }}"
                                        class="btn"><i class="lni lni-eye"></i>
                                        Visualizar</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <i class="lni lni-tag"></i>
                                <span style="display: inline"
                                    class="category">{{ $categories->where('id', $product['category_id'])->first()->name }}</span>
                                <h4 class="title">
                                    <a
                                        href="{{ route('store.product.details', encrypt($product['id'])) }}">{{ $product['name'] }}</a>
                                </h4>
                                <div class="price">
                                    @if ($product['sale_id'] == 1 && $product['descount'] > 0)
                                    <span
                                    class="old-price">{{ number_format($product['price'], 0, ',', '.') }} kz</span>
                                    <span>{{ number_format($product['price'] - (($product['price'] * $product['descount'])/100), 0, ',', '.') }} kz</span>
                                    @else
                                    <span>{{ number_format($product['price'], 0, ',','.') }} kz</span>
                                    @endif
                                </div>
                                <a href="{{ route('store.cart.add', encrypt($product['id'])) }}"
                                    class="btn add-cart-btn">
                                    <i class="lni lni-cart"></i>
                                    Adicionar
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="youMayLike">
                            <h5>Nenhum produto relacionado disponível</h5>
                        </div>
                    @endforelse
                </div>
            @else
                <div class="shop-products">
                    @forelse( $youMayLike as $product )
                        <div class="single-product @if($product['stock'] == 0 ) single-product-out-of-stock @endif">
                            <div class="product-image">
                                <img src="{{ url("storage/products/". $photos->where('product_id', $product['id'])->first()->photo. "") }}"
                                    alt="#">
                                @if( $product['sale_id'] == 1 )
                                    <span class="new-tag">Promoção</span>
                                @endif
                                @if( $product['stock'] == 0 )
                                    <span class="new-tag">Esgostado</span>
                                @endif
                                <div class="button">
                                    <a href="{{ route('store.product.details', encrypt($product['id'])) }}"
                                        class="btn"><i class="lni lni-eye"></i>
                                        Visualizar</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <i class="lni lni-tag"></i>
                                <span style="display: inline"
                                    class="category">{{ $categories->where('id', $product['category_id'])->first()->name }}</span>
                                <h4 class="title">
                                    <a
                                        href="{{ route('store.product.details', encrypt($product['id'])) }}">{{ $product['name'] }}</a>
                                </h4>
                                <div class="price">
                                    @if ($product['sale_id'] == 1 && $product['descount'] > 0)
                                    <span
                                    class="old-price">{{ number_format($product['price'], 0, ',', '.') }} kz</span>
                                    <span>{{ number_format($product['price'] - (($product['price'] * $product['descount'])/100), 0, ',', '.') }} kz</span>
                                    @else
                                    <span>{{ number_format($product['price'], 0, ',','.') }} kz</span>
                                    @endif
                                </div>
                                <a href="{{ route('store.cart.add', encrypt($product['id'])) }}"
                                    class="btn add-cart-btn">
                                    <i class="lni lni-cart"></i>
                                    Adicionar
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="youMayLike">
                            <h5>Nenhum produto relacionado</h5>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    </div>
</section>
<!-- End Item Details -->

@endsection
@push('js')
    <script type="text/javascript">
        const current = document.getElementById("current");
        const opacity = 0.6;
        const imgs = document.querySelectorAll(".img");
        imgs.forEach(img => {
            img.addEventListener("click", (e) => {
                //reset opacity
                imgs.forEach(img => {
                    img.style.opacity = 1;
                });
                current.src = e.target.src;
                //adding class 
                //current.classList.add("fade-in");
                //opacity
                e.target.style.opacity = opacity;
            });
        });

    </script>
@endpush
