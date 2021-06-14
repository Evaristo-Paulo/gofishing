@extends('painel.template')

@section('main-content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="d-flex justify-content-center">
                    <h4 class="text-blue h4">Actualização de Funcionários</h4>
                </div>
            </div>
            <div class="custom-loader">
                <img src="{{ asset('painel/src/images/loader.gif') }}" alt="">
            </div>
            
            <div class="wizard-content">
                <form class="tab-wizard wizard-circle wizard" method="POST" data-method="POST" enctype="multipart/form-data"
                id="sendForm" novalidate="" data-token="{{ csrf_token() }}"
                data-url="/painel/funcionarios/actualizacao" data-urlback="/painel/funcionarios">
                {{ csrf_field() }}
                
                    <h5>Dados Pessoais</h5>
                    <input type="hidden" name="id" value="{{ $person->id }}">

                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" name="name" value="{{ $person->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gênero</label>
                                    <select class="custom-select form-control" name="gender">
                                        @foreach ( $genders as $gender )
                                            @if($gender->id == $person->gender_id)
                                                <option selected value="{{ $gender->id }}">{{ $gender->type }}</option>                  
                                            @else
                                                <option value="{{ $gender->id }}">{{ $gender->type }}</option>                  
                                            @endif
                                        @endforeach  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Data de Nascimento</label>
                                    <input type="text" name="birthday" value="{{ $person->birthday }}" class="form-control date-picker">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bilhete de Identidade</label>
                                    <input type="text" name="bi" value="{{ $person->bi }}" class="form-control">
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
                                    <input type="tel" name="phone" value="{{ $person->phone }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ $users->where('people_id', $person->id )->first()->email }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input type="text" name="adress" value="{{ $person->adress }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Área Funcional</label>
                                    <select class="custom-select form-control" name="ocupation">
                                        @foreach ( $ocupations as $ocupation )
                                            @if($ocupation->id == $person->ocupation_id)
                                                <option selected value="{{ $ocupation->id }}">{{ $ocupation->type }}</option>                  
                                            @else
                                                <option value="{{ $ocupation->id }}">{{ $ocupation->type }}</option>                  
                                            @endif
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
