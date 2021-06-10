@extends('painel.template')

@section('main-content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="d-flex justify-content-center">
                    <h4 class="text-blue h4">Registo de Produtos</h4>
                </div>
            </div>
            <div class="wizard-content">
                <form class="tab-wizard wizard-circle wizard">
                    <h5>Dados do Produto</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Categoria <span class="add-new text-primary-2" data-toggle="modal"
                                            data-target="#category-register"><i class="fa fa-plus"
                                                aria-hidden="true"></i> Novo</span></label>
                                    <select class="custom-select form-control">
                                        <option value="Berlin">Blusa</option>
                                        <option value="Frankfurt">Casaco</option>
                                        <option value="Frankfurt">Boné</option>
                                        <option value="Frankfurt">Saia</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Marca <span class="add-new text-primary-2" data-toggle="modal"
                                            data-target="#brand-register"><i class="fa fa-plus" aria-hidden="true"></i>
                                            Novo</span></label>
                                    <select class="custom-select form-control">
                                        <option value="Berlin">Nike</option>
                                        <option value="Frankfurt">Jordan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Estilo</label>
                                    <select class="custom-select form-control">
                                        <option value="Berlin">Unisex</option>
                                        <option value="Berlin">Masculino</option>
                                        <option value="Frankfurt">Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tamanho</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Step 2 -->
                    <h5>Informações Adicionais</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Preço Unitário</label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fornecedor <span class="add-new text-primary-2" data-toggle="modal"
                                            data-target="#colaborator-register"><i class="fa fa-plus"
                                                aria-hidden="true"></i> Novo</span></label>
                                    <select class="custom-select form-control">
                                        <option value="Berlin">Lu 'nkenda</option>
                                        <option value="Frankfurt" selected>Nike</option>
                                        <option value="Frankfurt">Conquistador</option>
                                        <option value="Frankfurt">Stagiarious</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Promoção</label>
                                    <select class="custom-select form-control">
                                        <option value="Berlin">Activa</option>
                                        <option value="Frankfurt" selected>Desactiva</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Condição</label>
                                    <select class="custom-select form-control">
                                        <option value="Berlin" selected>Disponível</option>
                                        <option value="Frankfurt">Indisponível</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 3 -->
                    <h5>Fotografia</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Detalhes</label>
                                    <textarea name="" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fotografia</label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('painel/src/plugins/jquery-steps/jquery.steps.css') }}">
@endpush

@push('js')
    <script src="{{ asset('painel/src/plugins/jquery-steps/jquery.steps.js') }}"></script>
    <script src="{{ asset('painel/vendors/scripts/steps-setting.js') }}"></script>
@endpush
