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
                                <img src="{{  asset('store/assets/images/product-details/01.jpg') }}" id="current" alt="#">
                            </div>
                            <div class="images">
                                <img src="{{ asset('store/assets/images/product-details/01.jpg') }}" class="img" alt="#">
                                <img src="{{ asset('store/assets/images/product-details/02.jpg') }}" class="img" alt="#">
                                <img src="{{ asset('store/assets/images/product-details/03.jpg') }}" class="img" alt="#">
                                <img src="{{ asset('store/assets/images/product-details/04.jpg') }}" class="img" alt="#">
                                <img src="{{ asset('store/assets/images/product-details/05.jpg') }}" class="img" alt="#">
                            </div>
                        </main>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="product-info">
                        <h2 class="title">GoPro Karma Camera Drone</h2>
                        <p class="category"><i class="lni lni-tag"></i> Drones:<a href="javascript:void(0)">Action
                                cameras</a></p>
                        <p class="info-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt
                            ut labore et dolore magna aliqua.</p>
                        <h3 class="price"><span class="old-price">945,00 kz</span> 850,00 kz</h3>
                        <div class="button-group">
                            <div>
                                <div class="form-group quantity">
                                    <label for="color">Quantity</label>
                                    <select class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="bottom-content">
                                <div class="button cart-button">
                                    <button class="btn" style="width: 100%;"><i class="lni lni-cart"></i>
                                        Adicionar
                                    </button>
                                </div>
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
                                <li><span>Marca:</span> Nike Jordan</li>
                                <li><span>Gênero:</span> Unisex</li>
                                <li><span>Tamanho:</span> 42 EUR</li>
                                <li><span>Fabricante:</span> USA</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="info-body custom-responsive-margin">
                            <h4>Detalhes</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
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
                        <p class="wow fadeInUp" data-wow-delay=".6s">Please, purchase full version of the template
                            to get all pages,<br> features and commercial license.</p>
                        <div class="button wow fadeInUp" data-wow-delay=".8s">
                            <a href="#" data-bs-toggle="modal"
                            data-bs-target="#contactUsModal"  class="btn">Contanta-Nos</a>
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
                        <p>Melhor que 1 par de calçado, só mesmo vários pares de calçados.</p>
                    </div>
                </div>
            </div>
            <div class="shop-products">
                <!-- Start Single Product -->
                <div class="single-product">
                    <div class="product-image">
                        <img src="{{  asset('store/assets/images/products/product-5.jpg') }}" alt="#">
                        <div class="button">
                            <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Adicionar</a>
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
                <!-- Start Single Product -->
                <div class="single-product">
                    <div class="product-image">
                        <img src="{{  asset('store/assets/images/products/product-4.jpg') }}" alt="#">
                        <span class="new-tag">Novo</span>
                        <div class="button">
                            <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Adicionar</a>
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
                        <img src="{{  asset('store/assets/images/products/product-5.jpg') }}" alt="#">
                        <div class="button">
                            <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Adicionar</a>
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
                <!-- Start Single Product -->
                <div class="single-product">
                    <div class="product-image">
                        <img src="{{  asset('store/assets/images/products/product-4.jpg') }}" alt="#">
                        <span class="new-tag">Novo</span>
                        <div class="button">
                            <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Adicionar</a>
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
            </div>
        </div>
    </div>
</section>
<!-- End Item Details -->


<!-- Review Modal -->
<div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Leave a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-name">Your Name</label>
                            <input class="form-control" type="text" id="review-name" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-email">Your Email</label>
                            <input class="form-control" type="email" id="review-email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-subject">Subject</label>
                            <input class="form-control" type="text" id="review-subject" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-rating">Rating</label>
                            <select class="form-control" id="review-rating">
                                <option>5 Stars</option>
                                <option>4 Stars</option>
                                <option>3 Stars</option>
                                <option>2 Stars</option>
                                <option>1 Star</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="review-message">Review</label>
                    <textarea class="form-control" id="review-message" rows="8" required></textarea>
                </div>
            </div>
            <div class="modal-footer button">
                <button type="button" class="btn">Submit Review</button>
            </div>
        </div>
    </div>
</div>
<!-- End Review Modal -->
@endsection
