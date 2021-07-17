@extends('painel.template')
@section('main-content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Visualização do Pedido Nº {{ $orders[0]->order_id }}</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table hover multiple-select-row nowrap">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Produto</th>
                            <th>Qty.</th>
                            <th>Desconto</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $orders as $order )
                            <tr>
                                <td>{{ $order->client }}</td>
                                <td>{{ $order->product }}</td>
                                <td>{{ $order->qty }}</td>
                                <td>{{ $order->descount }}</td>
                                <td>{{ number_format($order->payment, 0, ',','.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- multiple select row Datatable End -->

    </div>
</div>

@endsection

@push('css')

    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
@endpush

@push('js')
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
    <!-- Datatable Setting js -->
    <script src="{{ asset('painel/vendors/scripts/datatable-setting.js') }}"></script>
@endpush
