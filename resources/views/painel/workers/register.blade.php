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
            <div class="custom-loader">
                <img src="{{ asset('painel/src/images/loader.gif') }}" alt="">
            </div>
            
            <div class="wizard-content">
                <form class="tab-wizard wizard-circle wizard" method="POST" data-method="POST" enctype="multipart/form-data"
                    id="sendForm" novalidate="" data-token="{{ csrf_token() }}"
                    data-url="/painel/funcionarios/registo" data-urlback="/painel/funcionarios">
                    {{ csrf_field() }}

                    <h5>Dados Pessoais</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-worker-name" >Nome</label>
                                    <input id="painel-worker-name" required type="text" name="name" class="form-control">
                                    @if($errors->has('name'))
                                        <span class="request-error-message">
                                            {{ $errors->first('name') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" >Gênero</label>
                                    <select class="custom-select form-control" name="gender">
                                        @foreach ( $genders as $gender )
                                            <option value="{{ $gender->id }}">{{ $gender->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-worker-birthday" >Data de Nascimento</label>
                                    <input id="painel-worker-birthday" required type="text" name="birthday" class="form-control date-picker">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-worker-bi" >Bilhete de Identidade</label>
                                    <input id="painel-worker-bi" required type="text" name="bi" class="form-control">
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
                                    <label for="painel-worker-phone" >Telefone</label>
                                    <input id="painel-worker-phone" type="tel" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-worker-email" >Email</label>
                                    <input id="painel-worker-email" required type="email" name="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-worker-adress" >Endereço</label>
                                    <input id="painel-worker-adress" required type="text" name="adress" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" >Área Funcional</label>
                                    <select name="ocupation" class="custom-select form-control">
                                        @foreach ( $ocupations as $ocupation )
                                            <option value="{{ $ocupation->id }}">{{ $ocupation->type }}</option> 
                                        @endforeach
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
