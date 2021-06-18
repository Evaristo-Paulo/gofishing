<!-- Modal Contacta-nos -->
<div class="modal fade" id="contactUsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Entrar em contacto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body">
                <div class="form-group">
                    <label for="getting-touch-name">Nome</label>
                    <input type="text" id="getting-touch-name" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label for="getting-touch-email">Email</label>
                    <input type="email" id="getting-touch-email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="getting-touch-subject">Assunto</label>
                    <input type="text" id="getting-touch-subject" class="form-control" name="subject">
                </div>
                <div class="form-group">
                    <label for="getting-touch-message">Mensagem</label>
                    <textarea name="message" class="form-control" id="getting-touch-message" rows="3"></textarea>
                </div>
                <div class="modal-footer-custom">
                    <button type="button" class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulário de login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body" action="{{ route('store.login.store') }}" method="POST">
                {{ csrf_field() }}

                @if (session('lerror'))
                    <p class="request-error-message text-center">{{ session('lerror') }}</p>
                @endif

                <div class="form-group">
                    <label for="store-login-email">Email</label>
                    <input  required type="email" id="store-login-email" class="form-control" value="{{ old('email') }}" name="email">
                    @if($errors->has('email'))
                        <span class="request-error-message">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="store-login-password">Senha</label>
                    <input required type="password" id="store-login-password"  class="form-control" name="password">
                    @if($errors->has('password'))
                        <span class="request-error-message">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
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
                <h5 class="modal-title">Formulário de registo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            @if (session('rerror'))
                <p class="request-error-message text-center">{{ session('rerror') }}</p>
             @endif
            <form class="modal-body" action="{{ route('store.register.store.save') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="store-register-full-name">Nome Completo</label>
                    <input required type="text" id="store-register-full-name" value="{{ old('name') }}" class="form-control" name="name">
                    @if($errors->has('name'))
                        <span class="request-error-message">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
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
                    <label for="store-register-email">Email</label>
                    <input required type="email" id="store-register-email" value="{{ old('email') }}" class="form-control" name="email">
                    @if($errors->has('email'))
                        <span class="request-error-message">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="store-register-password">Senha</label>
                    <input required type="password" id="store-register-password" value="{{ old('password') }}" class="form-control" name="password">
                    @if($errors->has('password'))
                        <span class="request-error-message">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
                <div class="modal-footer-custom">
                    <button type="type" class="btn btn-success">Registar</button>
                </div>
            </form>
        </div>
    </div>
</div>
