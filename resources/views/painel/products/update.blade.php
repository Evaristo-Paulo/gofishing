@extends('painel.template')

@section('main-content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="d-flex justify-content-center">
                    <h4 class="text-blue h4">Actualização de Produtos</h4>
                </div>
            </div>
            <div class="custom-loader">
                <img src="{{ asset('painel/src/images/loader.gif') }}" alt="">
            </div>
            <div class="wizard-content">
                <form class="tab-wizard wizard-circle wizard" method="POST" data-method="POST" enctype="multipart/form-data"
                id="sendForm" novalidate="" data-token="{{ csrf_token() }}"
                data-url="/painel/produtos/actualizacao" data-urlback="/painel/produtos">
                {{ csrf_field() }}
                    
                    <h5>Dados do Produto</h5>
                    <input id="painel-" type="hidden" name="id" value="{{ $product->id }}">
                    
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-product-update-name" >Nome</label>
                                    <input id="painel-product-update-name" required type="text" name="name" value="{{ $product->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" >Categoria <span class="add-new text-primary-2" data-toggle="modal"
                                            data-target="#category-register"><i class="fa fa-plus"
                                                aria-hidden="true"></i> Novo</span></label>
                                    <select name="category" class="custom-select form-control">
                                        @foreach ( $categories as $category )
                                            @if($category->id == $product->category_id)
                                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>                  
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>                  
                                            @endif
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" >Marca <span class="add-new text-primary-2" data-toggle="modal"
                                            data-target="#brand-register"><i class="fa fa-plus" aria-hidden="true"></i>
                                            Novo</span></label>
                                    <select name="brade" class="custom-select form-control">
                                        @foreach ( $brades as $brade )
                                            @if($brade->id == $product->brade_id)
                                                <option selected value="{{ $brade->id }}">{{ $brade->name }}</option>                  
                                            @else
                                                <option value="{{ $brade->id }}">{{ $brade->name }}</option>                  
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="" >Estilo</label>
                                    <select name="style" class="custom-select form-control">
                                        @foreach ( $styles as $style )
                                            @if($style->id == $product->style_id)
                                                <option selected value="{{ $style->id }}">{{ $style->type }}</option>                  
                                            @else
                                                <option value="{{ $style->id }}">{{ $style->type }}</option>                  
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="painel-product-update-size" >Tamanho</label>
                                    <input id="painel-product-update-size" required type="text" name="size" value="{{ $product->size }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Step 2 -->
                    <h5>Informações Adicionais</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="painel-product-update-price" >Preço Unitário</label>
                                    <input id="painel-product-update-price" required name="price" type="number" name="price"  value="{{ $product->price }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="painel-product-update-descount" >Desconto (%)</label>
                                    <input id="painel-product-update-descount" name="descount" min="0" value="{{ $product->descount }}" type="number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" >Promoção</label>
                                    <select name="onsale" class="custom-select form-control">
                                        @foreach ( $sales as $sale )
                                            @if($sale->id == $product->sale_id)
                                                <option selected value="{{ $sale->id }}">{{ $sale->type }}</option>                  
                                            @else
                                                <option value="{{ $sale->id }}">{{ $sale->type }}</option>                  
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" >Condição</label>
                                    <select name="condition" class="custom-select form-control">
                                        @foreach ( $conditions as $condition )
                                            @if($condition->id == $product->condition_id)
                                                <option selected value="{{ $condition->id }}">{{ $condition->type }}</option>                  
                                            @else
                                                <option value="{{ $condition->id }}">{{ $condition->type }}</option>                  
                                            @endif
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
                                    <label for="painel-product-update-introduction" >Introdução</label>
                                    <textarea id="painel-product-update-introduction" required name="specification" maxlength="255" class="form-control">{{ $product->specification }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-product-update-description" >Descrição</label>
                                    <textarea id="painel-product-update-description" required name="description" maxlength="255" class="form-control">{{ $product->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- step 4 -->
                    <h5>Fotografia</h5>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-product-photo-1" >Fotografia 1 (Opcional)</label>
                                    <input id="painel-product-photo-1" name="photo[]" multiple type="file" class="form-control-file form-control height-auto">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-product-photo-2" >Fotografia 2 (Opcional)</label>
                                    <input id="painel-product-photo-2" name="photo[]" multiple type="file" class="form-control-file form-control height-auto">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="painel-product-photo-3" >Fotografia 3 (Opcional)</label>
                                    <input id="painel-product-photo-3" name="photo[]" multiple type="file" class="form-control-file form-control height-auto">
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
