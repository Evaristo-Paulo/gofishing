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
            
            <table class="table data-table-export nowrap" id="datatable-responsive">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Produto</th>
                        <th>Valor Unitário</th>
                        <th>Qty.</th>
                        <th>Remove Item</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $hproducts as $product )
                        <tr>
                            <td  class="table-plus">
                                <div class="cart-img-head">
                                    <img src="{{ url("storage/products/". $photos->where('product_id', $product['item']['id'])->first()->photo ."") }}" alt="">
                                </div>
                                <span class="title-product">
                                {{ $product['item']['name'] }}
                                </span>
                            </td>
                            <td >
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
                            <td  class="table-actions">
                                <a href="{{ route('store.cart.remove.item', encrypt($product['item']['id']) ) }}"
                                    class="text-danger btn"><i class="lni lni-close"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="boxOrder" id="desktop-table-box-price">
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
    <!-- CSS -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <style>
    .table thead th {
        font-weight: 600;
        font-size: 15px;
        border-bottom: 0;
        padding-left: 1rem
    }

    .table td,
    .table th {
        vertical-align: middle
    }

    .table td {
        font-size: 14px;
        font-weight: 500;
        padding: 1rem
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background: #eaeef2
    }

    table.dataTable.display tbody tr.odd,
    table.dataTable.display tbody tr:hover,
    table.dataTable.hover tbody tr:hover,
    table.dataTable.stripe tbody tr.odd {
        background: #ecf0f3 !important
    }

    table.dataTable tbody tr.selected,
    table.dataTable.display tbody tr:hover.selected,
    table.dataTable.hover tbody tr:hover.selected {
        background-color: #181f48 !important;
        color: #fff
    }

    table.dataTable.display tbody tr.odd.selected,
    table.dataTable.stripe tbody tr.odd.selected {
        background-color: #1b00ff !important
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
        font-family: "dropways";
        font-size: 14px
    }

    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:before {
        content: "\eabb"
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc_disabled:after {
        content: "\eaba";
        right: .2em
    }

    .blog-list ul li:hover .blog-caption h4 a,
    .fontawesome-icon-list .fa-hover:hover a,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_desc:after {
        color: #1b00ff
    }

    table.dataTable>tbody>tr.child ul.dtr-details {
        white-space: normal
    }

    .dataTables_length,
    .dt-buttons,
    div.dataTables_wrapper div.dataTables_filter,
    div.dataTables_wrapper div.dataTables_info,
    div.dataTables_wrapper div.dataTables_paginate {
        padding-left: 15px;
        padding-right: 15px
    }

    .dt-checkbox,
    .dt-checkbox input {
        width: 20px;
        height: 20px;
        position: relative
    }

    .dt-checkbox input {
        position: absolute;
        opacity: 0;
        z-index: 1;
        left: 0;
        top: 0
    }

    .dt-checkbox span,
    .dt-checkbox span:before {
        width: 20px;
        height: 20px;
        -webkit-transition: all .3s ease-in-out;
        transition: all .3s ease-in-out
    }

    .dt-checkbox span {
        position: relative;
        display: block;
        border: 1px solid #9e9e9e;
        border-radius: 4px
    }

    .dt-checkbox span:before {
        content: "";
        background: url(../images/check-mark.png) no-repeat;
        position: absolute;
        left: 0;
        top: -1px;
        background-size: 12px 12px;
        background-position: center center;
        -webkit-transform: scale(0);
        transform: scale(0)
    }

    .dt-checkbox input:checked~span {
        background: #1b00ff;
        border-color: #1b00ff;
        color: #fff
    }

    .dt-checkbox input:checked~span:before {
        -webkit-transform: scale(1);
        transform: scale(1)
    }

    .plyr {
        border-radius: 10px;
        -webkit-box-shadow: 0 0 10px 2px rgba(0, 0, 0, .15);
        box-shadow: 0 0 10px 2px rgba(0, 0, 0, .15)
    }

    .popover-header {
        font-weight: 500
    }

    .list-group-flush .list-group-item {
        border-top: 0;
        margin-bottom: 0
    }

    .docs-cropped .modal-body>canvas,
    .docs-cropped .modal-body>img,
    .img-preview>img {
        max-width: 100%
    }

    .apexcharts-svg * {
        font-family: 'Inter', sans-serif !important
    }

    table.dataTable.dtr-inline.collapsed>tbody>tr[role=row]>td:first-child:before,
    table.dataTable.dtr-inline.collapsed>tbody>tr[role=row]>th:first-child:before {
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 0;
        border-radius: 0;
        font-family: "FontAwesome";
        background: 0 0;
        content: "\f107";
        color: #444;
        font-size: 23px;
        left: 7px;
        top: 50%;
        margin-top: -7px
    }

    table.dataTable.dtr-inline.collapsed>tbody>tr.parent>td:first-child:before,
    table.dataTable.dtr-inline.collapsed>tbody>tr.parent>th:first-child:before {
        content: "\f106";
        background: 0 0
    }
    </style>
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

    <script src="{{ asset('painel/vendors/scripts/zpreloader.js') }}"></script>
    <script src="{{ asset('painel/src/plugins/datatables/js/jquery.dataTables.min.js') }}">
    </script>
    <script
        src="{{ asset('painel/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script
        src="{{ asset('painel/src/plugins/datatables/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ asset('painel/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script src="{{ url('painel/vendors/scripts/datatable-setting.js') }}"></script>

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
