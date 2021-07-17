@extends('store.template')
@section('main-content')
<!-- Start Breadcrumbs -->
@section('breadcrumb-title')
<h1 class="page-title">Checkout & Pagamento</h1>
@endsection
@section('breadcrumb-subtitle')
<li>Checkout & Pagamento</li>
@endsection
<!-- End Breadcrumbs -->
<!-- Start Item Details -->
<section class="item-details section">
    <div class="container">
        <div class="checkout">
            <form id='checkout-form' action="{{ route('store.checkout.post') }}" method="POST">
                {{ csrf_field() }}
                <h6 class="checkout-title">Informações Pessoais</h6>
                <div class="form-group">
                    <label for="checkout-name">Nome completo de quem receberá o produto</label>
                    <input required type="text" name="name" id="checkout-name"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="checkout-phone-1">Telefone</label>
                    <input required type="tel" name="phone1" id="checkout-phone-1"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="checkout-phone-2">Telefone (opcional)</label>
                    <input type="tel" name="phone2" id="checkout-phone-2"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="checkout-adress">Endereço</label>
                    <input required type="text" name="adress" id="checkout-adress"
                        class="form-control">
                </div>
                <h6 class="checkout-title">Dados do Cartão</h6>
                <div id="card-element" style="margin: 20px 10px">
                    <!--Stripe.js injects the Card Element-->
                </div>
                <div id="checkout-errors" role="alert"></div>
                <div class="checkout-btn">
                    <h6 style="color: #0167F2">Total a pagar:
                        {{ number_format($totalPrice, 0, ',', '.') }}
                        kz</h6>
                    <button type="submit" id="checkout-button" class="btn btn-success"
                        data-secret="{{ $intent }}">Comprar</button>
                </div>
            </form>

            <article>
                <!-- Start Banner Area -->
                <section class="banner section">
                    <div class="container">
                        <div class="checkout-banner">
                            <div class="single-banner"
                                style="background-image:url('{{ asset('store/assets/images/banner/banner-1-bg.jpg') }}')">
                                <div class="content">
                                    <h2>Smart Watch 2.0</h2>
                                    <p>Conecta-te ao mundo das tecnologias<br>com a Goshopping</p>
                                    <div class="button">
                                        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#soon1Item">Saber
                                            Mais</a>
                                    </div>
                                </div>
                            </div>
                            <div class="single-banner custom-responsive-margin"
                                style="background-image:url('{{ asset('store/assets/images/banner/banner-2-bg.jpg') }}')">
                                <div class="content">
                                    <h2>Smart Headphone</h2>
                                    <p>Conecta-te ao mundo das tecnologias<br>com a Goshopping</p>
                                    <div class="button">
                                        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#soon2Item">Saber
                                            Mais</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Banner Area -->

            </article>
        </div>
    </div>
</section>
<!-- End Item Details -->
@endsection

@push('css')
@endpush
@push('js')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('store/assets/js/checkout.js') }}"></script>
    <script src="{{ asset('store/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}">
    </script>
    <script src="{{ asset('store/vendors/build/js/custom.min.js') }}"></script>
@endpush
