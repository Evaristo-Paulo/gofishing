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
                        <label for="painel-worker-update-email">Email</label>
                        <input id="painel-"  id="painel-worker-update-email" name="email" class="form-control" value="{{ Auth::user()->email }}" type="text"
                            readonly>
                            @if($errors->has('email'))
                                <span class="request-error-message">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="painel-worker-update-password">Nova Senha</label>
                        <input id="painel-"  name="newPassword" id="painel-worker-update-password" required class="form-control" required type="password">
                        @if($errors->has('newPassword'))
                            <span class="request-error-message">
                                {{ $errors->first('newPassword') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="painel-worker-update-confirm-password">Confirma Senha</label>
                        <input id="painel-"  name="confiPassword" id="painel-worker-update-confirm-password" required class="form-control" required type="password">
                        @if($errors->has('confiPassword'))
                            <span class="request-error-message">
                                {{ $errors->first('confiPassword') }}
                            </span>
                        @endif
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
                        <label for="painel-category-name">Nome</label>
                        <input id="painel-category-name"  name="name" required class="form-control" required type="text">
                    </div>
                    <div class="form-group">
                        <label for="painel-category-description">Descrição (Opcional)</label>
                        <textarea name="description" id="painel-category-description" class="form-control" maxlength="255"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="painel-category-cover">Capa (Opcional)</label>
                        <input id="painel-category-cover"  name="cover" type="file" class="form-control-file form-control height-auto">
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
                            <label for="painel-category-update-name">Nome</label>
                            <input id="painel-category-update-name"  name="name" required value="{{ $category->name }}" class="form-control" required
                                type="text">
                        </div>
                        <div class="form-group">
                            <label for="painel-category-description">Descrição (Opcional)</label>
                            <textarea name="description" class="form-control" id="painel-category-description"
                                maxlength="255">{{ $category->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="painel-category-update-cover">Capa (Opcional)</label>
                            <input id="painel-category-update-cover"  name="cover" type="file" value="{{ $category->photo }}"
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
                        <label for="painel-collaborator-update-name">Nome</label>
                        <input id="painel-collaborator-update-name"  name="name" required class="form-control" required type="text">
                    </div>
                    <div class="form-group">
                        <label for="painel-collaborator-update-description">Descrição (Opcional)</label>
                        <textarea name="description" id="painel-collaborator-update-description" class="form-control" maxlength="255"></textarea>
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
                            <label for="painel-collaborator-update-name">Nome</label>
                            <input id="painel-collaborator-update-name"  name="name" required value="{{ $collaborator->name }}" class="form-control" required
                                type="text">
                        </div>
                        <div class="form-group">
                            <label for="painel-collaborator-update-description">Descrição (Opcional)</label>
                            <textarea name="description" id="painel-collaborator-update-description" class="form-control"
                                maxlength="255">{{ $collaborator->description }}</textarea>
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
                        <label for="painel-brand-name">Nome</label>
                        <input id="painel-brand-name"  name="name" required class="form-control" required type="text">
                    </div>
                    <div class="form-group">
                        <label for="painel-brand-description">Descrição (Opcional)</label>
                        <textarea name="description" id="painel-brand-description" class="form-control" maxlength="255"></textarea>
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
                            <label for="painel-stock-name">Produto</label>
                            <input id="painel-stock-name"  value="{{ $stock->product }}" name="product" class="form-control" readonly required
                                type="text">
                        </div>
                        <div class="form-group">
                            <label for="">Fornecedor</label>
                            <select name="collaborator" class="custom-select form-control">
                                @foreach( $collaborators as $collaborator )
                                    <option value="{{ $collaborator->id }}">{{ $collaborator->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="painel-stock-qty">Qty. <span style="font-size: .7rem">(* quantidade a ser acrescentada)</span></label>
                            <input id="painel-stock-qty"  required class="form-control" name="stock" min="1" value="1" required type="number">
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
