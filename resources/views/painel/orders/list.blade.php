@extends('painel.template')
@section('main-content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Listagem de Pedidos</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table hover multiple-select-row nowrap">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acção</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $orders as $order )
                            <tr>
                                <td>
                                    {{ $order->id }}
                                </td>
                                <td>
                                    {{ $order->client }}
                                </td>
                                <td>
                                    {{ number_format($order->payment, 0,',','.') }}
                                </td>
                                <td>
                                    @if ($order->state == 'WA')
                                        Em espera
                                    @else
                                        Finalizado
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('painel.order', encrypt($order->id)) }}"
                                            data-color="#FFA600"><i class="icon-copy dw dw-eye"></i></a>
                                        <a href="{{ route('painel.order.done', encrypt($order->id)) }}"
                                            data-color="#265ed7"><i class="icon-copy dw dw-exchange"></i></a>
                                    </div>
                                </td>
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
