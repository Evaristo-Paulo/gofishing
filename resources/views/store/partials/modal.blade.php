<!-- Modal Contacta-nos -->
<div class="modal fade" id="contactUsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulário | Fale Connosco</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" id="name" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="subject">Assunto</label>
                    <input type="text" id="subject" class="form-control" name="subject">
                </div>
                <div class="form-group">
                    <label for="message">Mensagem</label>
                    <textarea name="message" class="form-control" id="message" rows="3"></textarea>
                </div>
                <div class="modal-footer-custom">
                    <button type="button" class="btn btn-success">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulário | Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body" action="{{ route('store.login.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" class="form-control" name="password">
                </div>
                <div class="modal-footer-custom">
                    <button type="submit" class="btn btn-success">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Login -->
@for($item = 1; $item <= 2; $item++)
    <div class="modal fade" id="soon{{ $item }}Item" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tecnologia Inovação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="single-banner"
                        style="background-image:url('{{ asset('store/assets/images/banner/banner-'.$item.'-bg.jpg') }}')">
                        <div class="content">
                            <h2>GoShopping Tecnologia</h2>
                            <p>Conecta-te ao mundo das tecnologias<br>com a GoShopping</p>
                            <div class="button">
                                <a href="javascript:void(0)" class="btn modal-close">Brevemente</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endfor
<!-- Modal Register-->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulário | Registo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body" action="{{ route('store.register.store.save') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input type="text" id="name" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Gênero</label>
                    <select class="form-control" name="gender" style="font-size: .9rem">
                        @foreach( $genders as $gender )
                            <option value="{{ $gender->id }}">{{ $gender->type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" class="form-control" name="password">
                </div>
                <div class="modal-footer-custom">
                    <button type="type" class="btn btn-success">Registar</button>
                </div>
            </form>
        </div>
    </div>
</div>
