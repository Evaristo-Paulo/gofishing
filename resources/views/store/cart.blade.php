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
                        <tr>
                            <td class="tb-product-name">
                                <span class="remove-item text-danger btn"><i class="lni lni-close"></i></span>
                                <span class="item-title">
                                    Nike Jordan
                                </span>
                            </td>
                            <td>15000 kz</td>
                            <td>
                                <span class="totalItem"><span class="dtItem">15000</span> kz</span>
                                <input type="number" class="qtdItem form-control" data-value="15000" value="1" name=""
                                    min="1" id="">

                            </td>
                        </tr>
                        <tr>
                            <td class="tb-product-name">
                                <span class="remove-item text-danger btn"><i class="lni lni-close"></i></span>
                                <span class="item-title">
                                    T-Shirt
                                </span>
                            </td>
                            <td>5000 kz</td>
                            <td>
                                <span class="totalItem"><span class="dtItem">5000</span> kz</span>
                                <input type="number" class="qtdItem form-control" data-value="5000" value="1" name=""
                                    min="1" id="">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="boxOrder">
                    Total Pedido: <span class="totalOrder">20000</span> kz
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
                    <tr>
                        <td>
                            Nike Jordan
                        </td>
                        <td>15000 kz</td>
                        <td>
                            <input type="number" class="qtdItemMobile form-control" data-value="15000" value="1" name=""
                                min="1" id="">
                        </td>
                        <td class="totalItemMobile"><span class="dtItemMobile">15000</span> kz</td>
                        <td>
                            <span class="text-danger btn"><i class="lni lni-close"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Casaco
                        </td>
                        <td>10000 kz</td>
                        <td>
                            <input type="number" class="qtdItemMobile form-control" data-value="10000" value="1" name=""
                                min="1" id="">
                        </td>
                        <td class="totalItemMobile"><span class="dtItemMobile">10000</span> kz</td>
                        <td>
                            <span class="text-danger btn"><i class="lni lni-close"></i></span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="boxOrder">
                Total Pedido: <span class="totalOrderMobile">25000</span> kz
            </div>


            <div class="checkout mt-4 d-flex justify-content-end">
                <a href="{{ route('store.products') }}" class="btn mx-2" style="border: 1px solid rgba(0, 0, 0, 0.151)">Continuar compra</a>
                <a href="#" class="btn btn-success">Checkout</a>
            </div>
        </div>
    </div>
</section>
<!-- End Item Details -->
@endsection

@push('css')
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="{{ asset('store/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('store/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('store/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('store/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('store/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('store/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
@endpush

@push('js')
<script src="{{  asset('store/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{  asset('store/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!-- Datatables -->
<script src="{{ asset('store/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('store/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('store/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('store/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{ asset('store/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('store/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('store/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('store/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{ asset('store/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{ asset('store/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('store/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{ asset('store/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('store/vendors/build/js/custom.min.js')}}"></script>
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
