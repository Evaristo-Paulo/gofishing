<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('painel.home') }}">
            <img src="{{ asset('store/assets/images/logo/new-logo.svg') }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="{{ route('painel.home') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-flow"></span><span class="mtext">Categorias</span>
                    </a>
                    <ul class="submenu">
                        @can('only-admin')
                        <li><a href="#" data-toggle="modal" data-target="#category-register">Registo</a></li>
                        @endcan
                        <li><a href="{{ route('painel.categories') }}">Listagem</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-ticket-2"></span><span class="mtext">Produtos</span>
                    </a>
                    <ul class="submenu">
                        @can('only-admin')
                        <li><a href="{{  route('painel.products.register') }}">Registo</a></li>
                        @endcan
                        <li><a href="{{ route('painel.products') }}">Listagem</a></li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon dw dw-balance"></span><span class="mtext">Stock</span>
                            </a>
                            <ul class="submenu child">
                                <li><a href="{{ route('painel.stock') }}">Listagem</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw ion-happy-outline"></span><span class="mtext">Clientes</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('painel.clients') }}">Listagem</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-trolley"></span><span class="mtext">Fornecedores</span>
                    </a>
                    <ul class="submenu">
                        @can('only-admin')
                        <li><a href="#" data-toggle="modal" data-target="#colaborator-register">Registo</a></li>
                        @endcan
                        <li><a href="{{ route('painel.collaborators') }}">Listagem</a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-group"></span><span class="mtext">Funcionários</span>
                    </a>
                    <ul class="submenu">
                        @can('only-admin')
                        <li><a href="{{ route('painel.workers.register') }}">Registo</a></li>
                        @endcan
                        <li><a href="{{ route('painel.workers') }}">Listagem</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-analytics-3"></span><span class="mtext">Estatística</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="javascript:;">Level 1</a></li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-plug"></span><span class="mtext">Level 2</span>
                            </a>
                            <ul class="submenu child">
                                <li><a href="javascript:;">Level 2</a></li>
                                <li><a href="javascript:;">Level 2</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:;">Level 1</a></li>
                        <li><a href="javascript:;">Level 1</a></li>
                    </ul>
                </li>
                @can('just-admin-and-manager')
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Painel de Controle</div>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-settings1"></span><span class="mtext">Usuários</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('painel.users') }}">Listagem</a></li>
                    </ul>
                </li> 
                @endcan
            </ul>
        </div>
    </div>
</div>
