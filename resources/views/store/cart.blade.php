@extends('store.template')
@section('main-content')
<!-- Start Breadcrumbs -->
@section('breadcrumb-title')
<h1 class="page-title">Carrinho</h1>
@endsection
@section('breadcrumb-subtitle')
<li>Carrinho</li>
@endsection
<!-- End Breadcrumbs -->
<!-- Start Item Details -->
<section class="item-details section">
    <div class="container">
        <div class="cart">
            <!-- TABLE MOBILE  -->
            <div class="table-responsive table-mobile">
                <table class="table table-bordered" cellspacing="0">
                    <thead style="background-color: #0166f3ca; color: #fff">
                        <tr>
                            <th>Produto</th>
                            <th>Valor Unitário</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $hproducts as $product )
                            <tr>
                                <td class="tb-product-name">
                                    <a href="{{ route('store.cart.remove.item', encrypt($product['item']['id'])) }}"
                                        class="remove-item text-danger btn"><i class="lni lni-close"></i></a>
                                    <span class="item-title">
                                        {{ $product['item']['name'] }}
                                    </span>
                                </td>
                                <td>
                                    @if ($product['item']['sale_id'] == 1 && $product['item']['descount'] > 0)
                                        {{ $product['item']['price'] - (($product['item']['price'] * $product['item']['descount'])/100) }} kz
                                    @else
                                    {{ $product['item']['price'] }} kz
                                    @endif
                                </td>
                                <td>
                                    <span class="totalItem">
                                        @if ($product['item']['sale_id'] == 1 && $product['item']['descount'] > 0)
                                        <span
                                        class="dtItem">{{ $product['item']['price'] - (($product['item']['price'] * $product['item']['descount'])/100) }}</span>
                                        @else
                                        <span
                                        class="dtItem">{{ $product['item']['price'] }}</span>
                                        @endif
                                        kz</span>
                                    <input type="number" class="qtdItem form-control"
                                        @if ($product['item']['sale_id'] == 1 && $product['item']['descount'] > 0)
                                            data-value="{{ $product['item']['price'] - (($product['item']['price'] * $product['item']['descount'])/100) }}"
                                        @else
                                            data-value="{{ $product['item']['price'] }}"
                                        @endif
                                        value="{{ $product['qty'] }}" name="" min="1" id="">

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="boxOrder">
                    Total Pedido: <span class="totalOrder">{{ $totalPrice }}</span> kz
                </div>

            </div>


            <table id="datatable-responsive" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                width="100%">
                <thead style="background-color: #0166f3ca; color: #fff">
                    <tr>
                        <th>Produto</th>
                        <th>Valor Unitário</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th>Remover Item</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $hproducts as $product )
                        <tr>
                            <td>
                                <div class="cart-img-head">
                                    <img src="{{ url("storage/products/". $photos->where('product_id', $product['item']['id'])->first()->photo ."") }}" alt="">
                                </div>
                                <span class="title-product">
                                {{ $product['item']['name'] }}
                                </span>
                            </td>
                            <td>
                                @if ($product['item']['sale_id'] == 1 && $product['item']['descount'] > 0)
                                    {{ $product['item']['price'] - (($product['item']['price'] * $product['item']['descount'])/100) }} kz
                                @else
                                    {{ $product['item']['price'] }} kz
                                @endif                            
                            </td>
                            <td>
                                <input type="number" class="qtdItemMobile form-control" 
                                @if ($product['item']['sale_id'] == 1 && $product['item']['descount'] > 0)
                                data-value="{{ ($product['item']['price'] - (($product['item']['price'] * $product['item']['descount'])/100))}}"
                                @else
                                data-value="{{ $product['item']['price']}}"
                                @endif
                                    value="{{ $product['qty'] }}" name="" min="1" id="">
                            </td>
                            <td class="totalItemMobile"><span
                                    class="dtItemMobile">
                                    @if ($product['item']['sale_id'] == 1 && $product['item']['descount'] > 0)
                                    {{ ($product['item']['price'] - (($product['item']['price'] * $product['item']['descount'])/100)) * $product['qty'] }}
                                    @else
                                    {{ $product['item']['price'] * $product['qty'] }}
                                    @endif
                                </span>
                                kz</td>
                            <td>
                                <a href="{{ route('store.cart.remove.item', encrypt($product['item']['id']) ) }}"
                                    class="text-danger btn"><i class="lni lni-close"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="boxOrder">
                Total Pedido: <span class="totalOrderMobile">{{ $totalPrice }}</span> kz
            </div>


            <div class="checkout mt-4 d-flex justify-content-end">
                <a href="{{ route('store.products') }}" class="btn mx-2"
                    style="border: 1px solid rgba(0, 0, 0, 0.151)">Continuar compra</a>
                <a href="#" class="btn btn-success">Checkout</a>
            </div>
        </div>
    </div>
</section>
<!-- End Item Details -->
@endsection

@push('css')
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="{{ asset('store/vendors/bootstrap/dist/css/bootstrap.min.css') }}"
        rel="stylesheet">
    <link
        href="{{ asset('store/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}"
        rel="stylesheet">
    <link
        href="{{ asset('store/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}"
        rel="stylesheet">
    <link
        href="{{ asset('store/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
        rel="stylesheet">
    <link
        href="{{ asset('store/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
        rel="stylesheet">
    <link
        href="{{ asset('store/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}"
        rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('store/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('store/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}">
    </script>
    <!-- Datatables -->
    <script src="{{ asset('store/vendors/datatables.net/js/jquery.dataTables.min.js') }}">
    </script>
    <script
        src="{{ asset('store/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}">
    </script>
    <script
        src="{{ asset('store/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}">
    </script>
    <script
        src="{{ asset('store/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}">
    </script>
    <script src="{{ asset('store/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}">
    </script>
    <script src="{{ asset('store/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}">
    </script>
    <script src="{{ asset('store/vendors/datatables.net-buttons/js/buttons.print.min.js') }}">
    </script>
    <script
        src="{{ asset('store/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}">
    </script>
    <script
        src="{{ asset('store/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}">
    </script>
    <script
        src="{{ asset('store/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ asset('store/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}">
    </script>
    <script
        src="{{ asset('store/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}">
    </script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('store/vendors/build/js/custom.min.js') }}"></script>
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
