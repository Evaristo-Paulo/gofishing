{{-- SIGLE WORKER UPDATE PASSWORD --}}
<div class="modal fade" id="single-worker-update-password" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary-2" style="color: #fff">
                <h4 class="modal-title text-white" id="myLargeModalLabel">Alteração de Senha</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('painel.workers.profile.update.password.save', encrypt($people->where('id', Auth::user()->people_id )->first()->id) ) }}">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" class="form-control" value="{{ Auth::user()->email }}" type="text"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label>Nova Senha</label>
                        <input name="newPassword" required class="form-control" required type="password">
                    </div>
                    <div class="form-group">
                        <label>Confirma Senha</label>
                        <input name="confiPassword" required class="form-control" required type="password">
                    </div>
                    <div class="group-btn d-flex my-2 justify-content-end">
                        <button type="submit" class="btn bg-primary-2">Alterar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- REGISTER CATEGORY --}}
<div class="modal fade" id="category-register" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary-2" style="color: #fff">
                <h4 class="modal-title text-white" id="myLargeModalLabel">Registo de Categorias</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="modalSendForm" enctype="multipart/form-data" data-method="POST"
                    data-url="/painel/categorias/registo">
                    {{ csrf_field() }}

                    <div class="custom-loader">
                        <img src="{{ asset('painel/src/images/loader.gif') }}" alt="">
                    </div>
                    @include('painel.partials.alert')
                    <div class="form-group">
                        <label>Nome</label>
                        <input name="name" class="form-control" required type="text">
                    </div>
                    <div class="form-group">
                        <label>Descrição (Opcional). Máximo 250 caracteres</label>
                        <textarea name="description" class="form-control" maxlength="250"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Capa (Opcional)</label>
                        <input name="cover" type="file" class="form-control-file form-control height-auto">
                    </div>
                    <div class="group-btn d-flex my-2 justify-content-end">
                        <button type="submit" class="btn bg-primary-2">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- UPDATE CATEGORY --}}
@foreach( $categories as $category )
    <div class="modal fade" id="category{{ $category->id }}-edit" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary-2" style="color: #fff">
                    <h4 class="modal-title text-white" id="myLargeModalLabel">Actualização de Categorias</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data"
                        action="{{ route('painel.categories.update.save', encrypt($category->id)) }}"
                        method="POST">
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="form-group">
                            <label>Nome</label>
                            <input name="name" value="{{ $category->name }}" class="form-control" required
                                type="text">
                        </div>
                        <div class="form-group">
                            <label>Descrição (Opcional). Máximo 250 caracteres</label>
                            <textarea name="description" class="form-control"
                                maxlength="250">{{ $category->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Capa </label>
                            <input name="cover" type="file" value="{{ $category->photo }}"
                                class="form-control-file form-control height-auto">
                        </div>
                        <div class="group-btn d-flex my-2 justify-content-end">
                            <button type="submit" class="btn bg-primary-2">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- REGISTER COLABORATORS --}}
<div class="modal fade" id="colaborator-register" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary-2" style="color: #fff">
                <h4 class="modal-title text-white" id="myLargeModalLabel">Registo de Fornecedores</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="modalSendForm" data-method="POST" data-url="/painel/fornecedores/registo">
                    {{ csrf_field() }}

                    <div class="custom-loader">
                        <img src="{{ asset('painel/src/images/loader.gif') }}" alt="">
                    </div>

                    @include('painel.partials.alert')
                    <div class="form-group">
                        <label>Nome</label>
                        <input name="name" class="form-control" required type="text">
                    </div>
                    <div class="form-group">
                        <label>Descrição (Opcional). Máximo 250 caracteres</label>
                        <textarea name="description" class="form-control" maxlength="250"></textarea>
                    </div>
                    <div class="group-btn d-flex my-2 justify-content-end">
                        <button type="submit" class="btn bg-primary-2">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach( $collaborators as $collaborator )
    {{-- UPDATE COLABORATORS --}}
    <div class="modal fade" id="collaborator{{ $collaborator->id }}-edit" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary-2" style="color: #fff">
                    <h4 class="modal-title text-white" id="myLargeModalLabel">Actualização de Fornecedores</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form
                        action="{{ route('painel.collaborators.update.save', encrypt($collaborator->id)) }}"
                        method="POST">
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="form-group">
                            <label>Nome</label>
                            <input name="name" value="{{ $collaborator->name }}" class="form-control" required
                                type="text">
                        </div>
                        <div class="form-group">
                            <label>Descrição (Opcional). Máximo 250 caracteres</label>
                            <textarea name="description" class="form-control"
                                maxlength="250">{{ $collaborator->description }}</textarea>
                        </div>
                        <div class="group-btn d-flex my-2 justify-content-end">
                            <button type="submit" class="btn bg-primary-2">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
{{-- REGISTER BRANDS --}}
<div class="modal fade" id="brand-register" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary-2" style="color: #fff">
                <h4 class="modal-title text-white" id="myLargeModalLabel">Registo de Marcas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="modalSendForm" data-method="POST" data-url="/painel/marcas/registo">
                    {{ csrf_field() }}

                    <div class="custom-loader">
                        <img src="{{ asset('painel/src/images/loader.gif') }}" alt="">
                    </div>

                    @include('painel.partials.alert')
                    <div class="form-group">
                        <label>Nome</label>
                        <input name="name" class="form-control" required type="text">
                    </div>
                    <div class="form-group">
                        <label>Descrição (Opcional). Máximo 250 caracteres</label>
                        <textarea name="description" class="form-control" maxlength="250"></textarea>
                    </div>
                    <div class="group-btn d-flex my-2 justify-content-end">
                        <button type="submit" class="btn bg-primary-2">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- REGISTER STOCK --}}
@foreach( $stockq as $stock )
    <div class="modal fade" id="stock{{ $stock->id }}-update" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary-2" style="color: #fff">
                    <h4 class="modal-title text-white" id="myLargeModalLabel">Actualização de Stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('painel.stock.update', encrypt($stock->id)) }}"
                        method="POST">
                        @method('PUT')
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Produto</label>
                            <input value="{{ $stock->product }}" name="product" class="form-control" readonly required
                                type="text">
                        </div>
                        <div class="form-group">
                            <label>Fornecedor</label>
                            <select name="collaborator" class="custom-select form-control">
                                @foreach( $collaborators as $collaborator )
                                    <option value="{{ $collaborator->id }}">{{ $collaborator->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Qty. <span style="font-size: .7rem">(* quantidade a ser acrescentada)</span></label>
                            <input class="form-control" name="stock" min="1" value="1" required type="number">
                        </div>

                        <div class="group-btn d-flex my-2 justify-content-end">
                            <button type="submit" class="btn bg-primary-2">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
