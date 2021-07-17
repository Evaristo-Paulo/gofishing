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
            <div class="custom-loader">
                <img src="{{ asset('painel/src/images/loader.gif') }}" alt="">
            </div>
            <div class="wizard-content">
                <form class="tab-wizard wizard-circle wizard" method="POST" data-method="POST"
                    enctype="multipart/form-data" id="sendForm" novalidate="" data-token="{{ csrf_token() }}"
                    data-url="/painel/produtos/registo" data-urlback="/painel/produtos">
                    {{ csrf_field() }}
                    
                    <h5>Dados do Produto</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-product-name" >Nome</label>
                                    <input id="painel-product-name"  type="text" required name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" >Categoria <span class="add-new text-primary-2" data-toggle="modal"
                                            data-target="#category-register"><i class="fa fa-plus"
                                                aria-hidden="true"></i> Novo</span></label>
                                    <select name="category" class="custom-select form-control">
                                        @foreach( $categories as $category )
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-" >Marca <span class="add-new text-primary-2" data-toggle="modal"
                                            data-target="#brand-register"><i class="fa fa-plus" aria-hidden="true"></i>
                                            Novo</span></label>
                                    <select name="brade" class="custom-select form-control">
                                        @foreach( $brades as $brade )
                                            <option value="{{ $brade->id }}">{{ $brade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="painel-" >Estilo</label>
                                    <select name="style" class="custom-select form-control">
                                        @foreach( $styles as $style )
                                            <option value="{{ $style->id }}">{{ $style->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="painel-product-size" >Tamanho</label>
                                    <input id="painel-product-size"  name="size" required type="text" class="form-control">
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
                                    <label for="painel-" >Fornecedor <span class="add-new text-primary-2" data-toggle="modal"
                                            data-target="#colaborator-register"><i class="fa fa-plus"
                                                aria-hidden="true"></i> Novo</span></label>
                                    <select name="collaborator" class="custom-select form-control">
                                        @foreach( $collaborators as $collaborator )
                                            <option value="{{ $collaborator->id }}">{{ $collaborator->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="painel-product-qty" >Qty. Fornecida</label>
                                    <input id="painel-product-qty"  required name="stock" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="painel-product-price" >Preço Unitário</label>
                                    <input id="painel-product-price"  required name="price" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="painel-product-descount" >Desconto (%)</label>
                                    <input id="painel-product-descount"  name="descount" min="0" type="number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-" >Promoção</label>
                                    <select name="onsale" class="custom-select form-control">
                                        @foreach( $sales as $sale )
                                            @if ( $sale->id == 1 )
                                                <option value="{{ $sale->id }}">{{ $sale->type }}</option>
                                            @else
                                                <option selected value="{{ $sale->id }}">{{ $sale->type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-" >Condição</label>
                                    <select name="condition" class="custom-select form-control">
                                        @foreach( $conditions as $condition )
                                            <option value="{{ $condition->id }}">{{ $condition->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 3 -->
                    <h5>Introdução e Descrição</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-product-introduction" >Introdução</label>
                                    <textarea id="painel-product-introduction"  required maxlength="255" name="specification" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-product-description" >Descrição</label>
                                    <textarea id="painel-product-description"  required maxlength="255" name="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 4 -->
                    <h5>Fotografia</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-product-photo-1" >Fotografia 1 (<span class="text-danger">Obrigatório</span>)</label>
                                    <input id="painel-product-photo-1"  name="photo[]" required multiple type="file" class="form-control-file form-control height-auto">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-product-photo-2" >Fotografia 2 (Opcional)</label>
                                    <input id="painel-product-photo-2"  name="photo[]" multiple type="file" class="form-control-file form-control height-auto">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-product-photo-3" >Fotografia 3 (Opcional)</label>
                                    <input id="painel-product-photo-3"  name="photo[]" multiple type="file" class="form-control-file form-control height-auto">
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
