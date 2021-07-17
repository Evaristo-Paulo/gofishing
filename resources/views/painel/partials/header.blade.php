<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
    </div>
    <div class="header-right">
        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>
                    @if( $g_orders > 0 )
                        <span class="badge notification-active"></span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul>
                            <li>
                                <a href="{{  route('painel.orders') }}">
                                    <img src="{{ url('painel/vendors/images/paper-map-cuate.svg') }}"
                                        alt="">
                                    <h3>Notificação</h3>
                                    @if( $g_orders > 0 )
                                        @if( $g_orders == 1 )
                                            <p>{{ $g_orders }} pedido em espera</p>
                                        @else
                                            <p>{{ $g_orders }} pedidos em espera</p>
                                        @endif
                                    @else
                                        <p>Não existem pedidos</p>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="{{ secure_url("storage/people/". $people->where('id', Auth::user()->people_id)->first()->photo. "") }}"
                            alt="">
                    </span>
                    <span
                        class="user-name">{{ $people->where('id', Auth::user()->people_id)->first()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item"
                        href="{{ route('painel.workers.profile', encrypt($people->where('id', Auth::user()->people_id)->first()->id)  ) }}"><i
                            class="dw dw-user1"></i> Meu Perfil</a>
                    <a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Ajuda</a>
                    <a class="dropdown-item" href="{{ route('painel.logout') }}"><i
                            class="dw dw-logout"></i> Sair</a>
                </div>
            </div>
        </div>
    </div>
</div>
