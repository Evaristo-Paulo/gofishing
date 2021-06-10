@extends('painel.template')

@section('main-content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Listagem de Produtos</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table hover multiple-select-row nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Nome</th>
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Estilo</th>
                            <th>Tamanho</th>
                            <th>Fornecedor</th>
                            <th>Preço Unit</th>
                            <th>Stock</th>
                            <th>Promoção</th>
                            <th>Condição</th>
                            <th>Detalhes</th>
                            <th>Acção</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < 9; $i++)
                        <tr>
                            <td class="table-plus">
                                <div class="name-avatar d-flex align-items-center">
									<div class="avatar mr-2 flex-shrink-0">
										<img src="vendors/images/photo8.jpg" class="border-radius-100 shadow" width="40" height="40" alt="">
									</div>
									<div class="txt">
										<div class="weight-600">Nike Jordan</div>
									</div>
								</div>
                            </td>
                            <td>Calça</td>
                            <td>Nike</td>
                            <td>Unisex</td>
                            <td>M</td>
                            <td>Nike</td>
                            <td>45.000</td>
                            <td>30</td>
                            <td>Desactiva</td>
                            <td>Disponível</td>
                            <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('painel.products.update', $i) }}" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                    <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
        <!-- multiple select row Datatable End -->
    
    </div>
</div>

@endsection

@push('css')

<link rel="stylesheet" type="text/css" href="{{  asset('painel/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{  asset('painel/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('painel/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('painel/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('painel/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('painel/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Datatable Setting js -->
<script src="{{ asset('painel/vendors/scripts/datatable-setting.js') }}"></script>
@endpush
