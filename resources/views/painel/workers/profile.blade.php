@extends('painel.template')

@section('main-content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title text-blue">
                            <h4 class="text-blue" style="color: #1B00FF">Meu Perfil</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-photo">
                            <img src="{{ asset('painel/vendors/images/photo1.jpg') }}" alt=""
                                class="avatar-photo">
                        </div>
                        <h5 class="text-center h5 mb-0">Evaristo D. Paulo</h5>
                        <p class="text-center text-muted font-14">Técnico</p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Minhas Informações</h5>
                            <ul>
                                <li>
                                    <span>Telefone:</span>
                                    619-229-0054
                                </li>
                                <li>
                                    <span>Email:</span>
                                    FerdinandMChilds@test.com
                                </li>
                                <li>
                                    <span>Endereço:</span>
                                    1807 Holden Street<br>
                                    San Diego, CA 92115
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                    <div class="card-box height-100-p overflow-hidden">
                        <div class="profile-tab height-100-p">
                            <div class="tab height-100-p">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#setting"
                                            role="tab">Actualização de Dados</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- Setting Tab start -->
                                    <div class="tab-pane fade show active height-100-p" id="setting" role="tabpanel">
                                        <div class="profile-setting">
                                            <div style="border: 1px dotted #7064e0; padding: 10px; border-radius: 3px; margin: 20px; margin-bottom: -40px">
                                                <a href="#" class="text-blue h6" data-toggle="modal"
                                                    data-target="#single-worker-update-password"
                                                    style="list-style: underline">Deseja alterar apenas a senha?</a>
                                            </div>
                                            <form>
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-6">
                                                        <div class="form-group">
                                                            <label>Nome</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Gênero</label>
                                                            <select class="custom-select form-control">
                                                                <option value="Berlin">Masculino</option>
                                                                <option value="Frankfurt">Feminino</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Data de Nascimento</label>
                                                            <input type="text" class="form-control date-picker">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Bilhete de Identidade</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </li>
                                                    <li class="weight-500 col-md-6">
                                                        <div class="form-group">
                                                            <label>Telefone</label>
                                                            <input type="tel" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Endereço</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Fotografia</label>
                                                            <input type="file" class="form-control">
                                                        </div>
                                                        <div class="group-btn d-flex my-2 justify-content-end">
                                                            <button type="button" class="btn bg-primary-2">Actualizar</button>
                                                        </div>
                                                    </li>
                                                </ul>

                                            </form>
                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->
                                </div>
                            </div>
                        </div>
                    </div>
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
