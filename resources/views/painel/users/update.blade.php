@extends('painel.template')

@section('main-content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="">
                    <h4 class="text-blue h4">Actualização de Usuários</h4>
                </div>
            </div>
            <form>
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
                            <label>Email</label>
                            <input type="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="custom-select form-control">
                                <option value="Berlin">Admin</option>
                                <option value="Frankfurt">Manager</option>
                                <option value="Frankfurt" selected>User</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="group-btn d-flex my-2 justify-content-end">
                    <button type="button" class="btn bg-primary-2 text-white">Actualizar</button>
                </div>
            </form>
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
