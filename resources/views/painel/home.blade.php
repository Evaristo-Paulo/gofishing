@extends('painel.template')

@section('main-content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">


        <div class="row pb-10">
            <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{ $qtd_products }}</div>
                            <div class="font-14 text-secondary weight-500">
                                <a href="{{ route('painel.products') }}" class="text-secondary">Produtos</a>
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#7064e0"><i class="icon-copy dw dw-ticket-2"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{ $qtd_clients }}</div>
                            <div class="font-14 text-secondary weight-500">
                                <a href="{{ route('painel.clients') }}" class="text-secondary">Clientes Felizes</a>
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#FFD96A"><i class="icon-copy ion-happy-outline"
                                    aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{ $qtd_collabs }}</div>
                            <div class="font-14 text-secondary weight-500">
                                <a href="{{ route('painel.collaborators') }}" class="text-secondary">Fornecedores</a>
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#7064e0"><span class="icon-copy dw dw-trolley"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pb-10">
            <div class="col-md-8 mb-20">
                <div class="card-box height-100-p pd-20">
                    <div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                        <div class="h5 mb-md-0">Actividades de vendas</div>
                        <div class="form-group mb-md-0">
                            <select class="form-control form-control-sm selectpicker">
                                <option value="">Last Week</option>
                                <option value="">Last Month</option>
                                <option value="">Last 6 Month</option>
                                <option value="">Last 1 year</option>
                            </select>
                        </div>
                    </div>
                    <div id="activities-chart"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-20">
                <div class="card-box height-100-p pd-20 min-height-200px">
                    <div class="d-flex justify-content-between pb-10">
                        <div class="h5 mb-0">Top produtos mais vendidos</div>
                    </div>
                    <div class="user-list">
                        <ul>
                            <li class="d-flex align-items-center justify-content-between">
                                <div class="name-avatar d-flex align-items-center pr-2">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo1.jpg" class="border-radius-100 box-shadow"
                                            width="50" height="50" alt="">
                                    </div>
                                    <div class="txt">
                                        <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                            data-color="#265ed7">4.9</span>
                                        <div class="font-14 weight-600">Dr. Neil Wagner</div>
                                        <div class="font-12 weight-500" data-color="#b2b1b6">Pediatrician</div>
                                    </div>
                                </div>
                                <div class="cta flex-shrink-0">
                                    <a href="#" class="btn btn-sm btn-outline-primary">Ver Stock</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center justify-content-between">
                                <div class="name-avatar d-flex align-items-center pr-2">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo2.jpg" class="border-radius-100 box-shadow"
                                            width="50" height="50" alt="">
                                    </div>
                                    <div class="txt">
                                        <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                            data-color="#265ed7">4.9</span>
                                        <div class="font-14 weight-600">Dr. Ren Delan</div>
                                        <div class="font-12 weight-500" data-color="#b2b1b6">Pediatrician</div>
                                    </div>
                                </div>
                                <div class="cta flex-shrink-0">
                                    <a href="#" class="btn btn-sm btn-outline-primary">Ver Stock</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center justify-content-between">
                                <div class="name-avatar d-flex align-items-center pr-2">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo3.jpg" class="border-radius-100 box-shadow"
                                            width="50" height="50" alt="">
                                    </div>
                                    <div class="txt">
                                        <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                            data-color="#265ed7">4.9</span>
                                        <div class="font-14 weight-600">Dr. Garrett Kincy</div>
                                        <div class="font-12 weight-500" data-color="#b2b1b6">Pediatrician</div>
                                    </div>
                                </div>
                                <div class="cta flex-shrink-0">
                                    <a href="#" class="btn btn-sm btn-outline-primary">Ver Stock</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center justify-content-between">
                                <div class="name-avatar d-flex align-items-center pr-2">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo4.jpg" class="border-radius-100 box-shadow"
                                            width="50" height="50" alt="">
                                    </div>
                                    <div class="txt">
                                        <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                            data-color="#265ed7">4.9</span>
                                        <div class="font-14 weight-600">Dr. Callie Reed</div>
                                        <div class="font-12 weight-500" data-color="#b2b1b6">Pediatrician</div>
                                    </div>
                                </div>
                                <div class="cta flex-shrink-0">
                                    <a href="#" class="btn btn-sm btn-outline-primary">Ver Stock</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-box pb-10">
            <div class="h5 pd-20 mb-0">Produtos que precisam ser acrescidos (<span class="text-danger">stock negativo</span>)</div>
            <table class="data-table table nowrap">
                <thead>
                    <tr>
                        <th class="table-plus">Nome</th>
                        <th>Categoria</th>
                        <th>Fornecedor</th>
                        <th>Stock</th>
                        <th class="datatable-nosort">Actualização</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < 6; $i++)
                        <tr>
                            <td class="table-plus">
                                <div class="name-avatar d-flex align-items-center">
                                    <div class="avatar mr-2 flex-shrink-0">
                                        <img src="vendors/images/photo4.jpg" class="border-radius-100 shadow" width="40"
                                            height="40" alt="">
                                    </div>
                                    <div class="txt">
                                        <div class="weight-600">Nike Jordan</div>
                                    </div>
                                </div>
                            </td>
                            <td>Calçado</td>
                            <td>Nike</td>
                            <td>7 unidade(s)</td>
                            <td>
                                <div class="table-actions">
                                    <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        @include('painel.partials.footer')
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('painel/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/dashboard3.js') }}"></script>
@endpush
