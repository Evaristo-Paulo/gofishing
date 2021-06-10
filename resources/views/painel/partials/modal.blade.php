{{-- SIGLE WORKER UPDATE PASSWORD --}}
<div class="modal fade" id="single-worker-update-password" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary-2" style="color: #fff">
                <h4 class="modal-title text-white" id="myLargeModalLabel">Alteração de Senha</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" required type="text" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nova Senha</label>
                        <input class="form-control" required type="password">
                    </div>
                    <div class="form-group">
                        <label>Confirma Senha</label>
                        <input class="form-control" required type="password">
                    </div>
                    <div class="group-btn d-flex my-2 justify-content-end">
                        <button type="button" class="btn bg-primary-2">Alterar</button>
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
                <form>
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" required type="text">
                    </div>
                    <div class="form-group">
                        <label>Descrição (Opcional). Máximo 250 caracteres</label>
                        <textarea class="form-control" maxlength="250"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Capa (Opcional)</label>
                        <input type="file" class="form-control-file form-control height-auto">
                    </div>
                    <div class="group-btn d-flex my-2 justify-content-end">
                        <button type="button" class="btn bg-primary-2">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
                <form>
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" required type="text">
                    </div>
                    <div class="form-group">
                        <label>Descrição (Opcional). Máximo 250 caracteres</label>
                        <textarea class="form-control" maxlength="250"></textarea>
                    </div>
                    <div class="group-btn d-flex my-2 justify-content-end">
                        <button type="button" class="btn bg-primary-2">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
                <form>
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" required type="text">
                    </div>
                    <div class="form-group">
                        <label>Descrição (Opcional). Máximo 250 caracteres</label>
                        <textarea class="form-control" maxlength="250"></textarea>
                    </div>
                    <div class="group-btn d-flex my-2 justify-content-end">
                        <button type="button" class="btn bg-primary-2">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- REGISTER STOCK --}}
<div class="modal fade" id="stock-register" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary-2" style="color: #fff">
                <h4 class="modal-title text-white" id="myLargeModalLabel">Actualização de Stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Produto</label>
                        <select class="custom-select form-control">
                            <option value="NM">New Mexico</option>
                            <option value="ND">North Dakota</option>
                            <option value="UT">Utah</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fornecedor</label>
                        <select class="custom-select form-control">
                            <option value="UT">Lu 'nkenda</option>
                            <option value="WY">We rock!</option>
                            <option value="WY">G21</option>
                            <option value="WY">Nike</option>
                            <option value="WY">stagiarious</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantidade</label>
                        <input class="form-control" min="1" required type="number">
                    </div>
                    <div class="group-btn d-flex my-2 justify-content-end">
                        <button type="button" class="btn bg-primary-2">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
