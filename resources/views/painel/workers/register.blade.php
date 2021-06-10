@extends('painel.template')

@section('main-content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="d-flex justify-content-center">
                    <h4 class="text-blue h4">Registo de Funcionários</h4>
                </div>
            </div>
            <div class="wizard-content">
                <form class="tab-wizard wizard-circle wizard">
                    <h5>Dados Pessoais</h5>
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
                                    <label>Gênero</label>
                                    <select class="custom-select form-control">
                                        <option value="Berlin">Masculino</option>
                                        <option value="Frankfurt">Feminino</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Data de Nascimento</label>
                                    <input type="text" class="form-control date-picker">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bilhete de Identidade</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 2 -->
                    <h5>Informações Adicionais</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="tel" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Área Funcional</label>
                                    <select class="custom-select form-control">
                                        <option value="Berlin">Comercial</option>
                                        <option value="Frankfurt">Finança</option>
                                        <option value="Frankfurt">Gestão</option>
                                        <option value="Frankfurt">Logística</option>
                                        <option value="Frankfurt">Técnica</option>
                                    </select>
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
