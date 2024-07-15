<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sky System - Sistema Online</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="{{ asset('/public/dist-assets/css/themes/lite-blue.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/public/dist-assets/css/plugins/perfect-scrollbar.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/public/css/bootstrap-combobox.css') }}" />
    <style media="screen">
    .table-responsive{
        min-height: 200px !important;
    }
    </style>

</head>

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-header">
            <div class="logo">
                <img src="{{ asset('/public/img/logo.png') }}" alt="">
            </div>
            <div class="menu-toggle">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div style="margin: auto"></div>
            <div class="header-part-right">
                <!-- Full screen toggle -->
                <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
                {{--
                <!-- Notificaiton -->
                <div class="dropdown">
                    <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-primary">3</span>
                        <i class="i-Bell text-muted header-icon"></i>
                    </div>
                    <!-- Notification dropdown -->
                    <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none" aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>New message</span>
                                    <span class="badge badge-pill badge-primary ml-1 mr-1">new</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">10 sec ago</span>
                                </p>
                                <p class="text-small text-muted m-0">James: Hey! are you busy?</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Receipt-3 text-success mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>New order received</span>
                                    <span class="badge badge-pill badge-success ml-1 mr-1">new</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">2 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">1 Headphone, 3 iPhone x</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Empty-Box text-danger mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>Product out of stock</span>
                                    <span class="badge badge-pill badge-danger ml-1 mr-1">3</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">10 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">Headphone E67, R98, XL90, Q77</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Data-Power text-success mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>Server Up!</span>
                                    <span class="badge badge-pill badge-success ml-1 mr-1">3</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">14 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">Server rebooted successfully</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Notificaiton End -->
                --}}
                <!-- User avatar dropdown -->
                @php
                //vamos verificar se possui imagem para apresentar

                $user = auth()->user();
                if($user->imagem){
                    $avatar = asset("/public/img/usuarios/$user->imagem");
                }
                else{
                    $avatar = asset("/public/img/avatar.png");
                }
                @endphp
                <div class="dropdown">
                    <div class="user col align-self-end">
                        <img src="{{ $avatar }}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <div class="dropdown-header">
                                <i class="i-Lock-User mr-1"></i> {{ $user->nome }}
                            </div>
                            <a class="dropdown-item" href="{{ route('alterarSenha') }}">Alterar Senha</a>
                            <a class="dropdown-item" href="{{ route('alterarImagem') }}">Alterar Imagem</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="side-content-wrap">
            <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <ul class="navigation-left">
                    <li class="nav-item"><a class="nav-item-hold" href="{{ route('dashboard') }}"><i class="nav-icon i-Bar-Chart"></i><span class="nav-text">Dashboard</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="cadastros"><a class="nav-item-hold" href="#"><i class="nav-icon i-File-Clipboard-File--Text"></i><span class="nav-text">Cadastros</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="estoque"><a class="nav-item-hold" href="#"><i class="nav-icon nav-icon i-File-Clipboard-Text--Image"></i><span class="nav-text">Estoque</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="oficina"><a class="nav-item-hold" href="#"><i class="nav-icon i-Double-Tap"></i><span class="nav-text">Oficina</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="movimentacoes"><a class="nav-item-hold" href="#"><i class="nav-icon i-Data-Backup"></i><span class="nav-text">Movimentações</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="relatorios"><a class="nav-item-hold" href="#"><i class="nav-icon i-Receipt-4"></i><span class="nav-text">Relatórios</span></a>
                        <div class="triangle"></div>
                    </li>
                </ul>
            </div>
            <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <!-- Submenu Dashboards-->
                <ul class="childNav" data-parent="cadastros">
                    <li class="nav-item"><a href="{{ route('usuarios') }}"><i class="nav-icon i-Add-User"></i><span class="item-name">Usuários</span></a></li>
                    <li class="nav-item"><a href="{{ route('marcas') }}"><i class="nav-icon i-Library"></i><span class="item-name">Marcas</span></a></li>
                    <li class="nav-item"><a href="{{ route('produtos') }}"><i class="nav-icon i-Tag"></i><span class="item-name">Produtos</span></a></li>
                    <li class="nav-item"><a href="{{ route('ferramentas') }}"><i class="nav-icon i-Bar-Code"></i><span class="item-name">Patrimônio/Ferramentas</span></a></li>
                    <li class="nav-item"><a href="{{ route('clientes') }}"><i class="nav-icon i-Myspace"></i><span class="item-name">Clientes</span></a></li>
                    <li class="nav-item"><a href="{{ route('estoques') }}"><i class="nav-icon i-Big-Data"></i><span class="item-name">Estoques</span></a></li>
                    <li class="nav-item"><a href="{{ route('veiculos') }}"><i class="nav-icon i-Car"></i><span class="item-name">Veículos</span></a></li>
                    <li class="nav-item"><a href="{{ route('simcards') }}"><i class="nav-icon i-Wifi"></i><span class="item-name">SimCards</span></a></li>
                    <li class="nav-item"><a href="{{ route('rastreadores') }}"><i class="nav-icon i-Router"></i><span class="item-name">Rastreadores</span></a></li>
                    <li class="nav-item"><a href="{{ route('operadoras') }}"><i class="nav-icon i-Communication-Tower"></i><span class="item-name">Operadoras</span></a></li>
                    <li class="nav-item"><a href="{{ route('tipos_rastreadores') }}"><i class="nav-icon i-Newspaper"></i><span class="item-name">Tipos Rastreadores</span></a></li>
                    <li class="nav-item"><a href="{{ route('modelos_rastreadores') }}"><i class="nav-icon i-Newspaper"></i><span class="item-name">Modelos Rastreadores</span></a></li>
                </ul>
                <ul class="childNav" data-parent="estoque">
                    <li class="nav-item"><a href="{{ route('entradas') }}"><i class="nav-icon i-File-Upload"></i><span class="item-name">Entradas</span></a></li>
                    <li class="nav-item"><a href="{{ route('baixas') }}"><i class="nav-icon i-File-Download"></i><span class="item-name">Baixas</span></a></li>
                    <li class="nav-item"><a href="{{ route('transferencias') }}"><i class="nav-icon i-File-Copy"></i><span class="item-name">Transferências</span></a></li>
                </ul>
                <ul class="childNav" data-parent="oficina">
                    <li class="nav-item"><a href="{{ route('oficina.simcards') }}"><i class="nav-icon i-Wifi"></i><span class="item-name">SimCards</span></a></li>
                    <li class="nav-item"><a href="{{ route('oficina.rastreadores') }}"><i class="nav-icon i-Router"></i><span class="item-name">Rastreadores</span></a></li>
                    <li class="nav-item"><a href="{{ route('oficina.instalacoes') }}"><i class="nav-icon i-Double-Tap"></i><span class="item-name">Instalações</span></a></li>
                </ul>
                <ul class="childNav" data-parent="movimentacoes">
                    <li class="nav-item"><a href="{{ route('movimentacoes.ferramentas') }}"><i class="nav-icon i-Bar-Code"></i><span class="item-name">Ferramentas</span></a></li>
                    <li class="nav-item"><a href="{{ route('movimentacoes.simcards') }}"><i class="nav-icon i-Wifi"></i><span class="item-name">Simcard</span></a></li>
                    <li class="nav-item"><a href="{{ route('movimentacoes.rastreadores') }}"><i class="nav-icon i-Router"></i><span class="item-name">Rastreadores</span></a></li>
                </ul>
                <ul class="childNav" data-parent="relatorios">
                    <li class="nav-item"><a href="{{ route('relatorios.estoques') }}"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">Estoques</span></a></li>
                    <li class="nav-item"><a href="{{ route('relatorios.produtos') }}"><i class="nav-icon i-Tag"></i><span class="item-name">Produtos</span></a></li>
                    <li class="nav-item"><a href="{{ route('relatorios.clientes') }}"><i class="nav-icon i-Myspace"></i><span class="item-name">Clientes</span></a></li>
                    <li class="nav-item"><a href="{{ route('relatorios.veiculos') }}"><i class="nav-icon i-Car"></i><span class="item-name">Veículos</span></a></li>
                    <li class="nav-item"><a href="{{ route('relatorios.simcards') }}"><i class="nav-icon i-Wifi"></i><span class="item-name">Simcards</span></a></li>
                    <li class="nav-item"><a href="{{ route('relatorios.rastreadores') }}"><i class="nav-icon i-Router"></i><span class="item-name">Rastreadores</span></a></li>
                    <li class="nav-item"><a href="{{ route('relatorios.entradas') }}"><i class="nav-icon i-File-Upload"></i><span class="item-name">Entradas</span></a></li>
                    <li class="nav-item"><a href="{{ route('relatorios.baixas') }}"><i class="nav-icon i-File-Download"></i><span class="item-name">Baixas</span></a></li>
                    <li class="nav-item"><a href="{{ route('relatorios.transferencias') }}"><i class="nav-icon i-File-Copy"></i><span class="item-name">Transferências</span></a></li>
                    <li class="nav-item"><a href="{{ route('relatorios.instalacoes') }}"><i class="nav-icon i-Double-Tap"></i><span class="item-name">Instalações</span></a></li>
                </ul>
            </div>
            <div class="sidebar-overlay"></div>
        </div>
        <!-- =============== Left side End ================-->
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                @yield('conteudo')
            </div>
            <!-- Footer Start -->
            <div class="flex-grow-1"></div>
            <div class="app-footer mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Desenvolvido po <b>WebPel Soluções Digitais</b></strong></p>
                    </div>
                    <div class="col-md-6">
                        <p class="m-0">&copy; 2024 Sky System All rights reserved</p>
                    </div>
                </div>
            </div>
            <!-- fotter end -->
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('/public/dist-assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/public/dist-assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/public/dist-assets/js/scripts/script.min.js') }}"></script>
    <script src="{{ asset('/public/dist-assets/js/scripts/sidebar.large.script.min.js') }}"></script>
    <script src="{{ asset('/public/dist-assets/js/plugins/echarts.min.js') }}"></script>
    <script src="{{ asset('/public/dist-assets/js/scripts/echart.options.min.js') }}"></script>
    <script src="{{ asset('/public/dist-assets/js/scripts/dashboard.v1.script.min.js') }}"></script>
    <script src="{{ asset('/public/dist-assets/js/scripts/customizer.script.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/public/js/script.js') }}"></script>
    <script src="{{ asset('/public/js/bootstrap-combobox.js') }}"></script>
    <script>
    window.addEventListener('load',()=>{
        $('.combobox').combobox();
    });
    </script>
</body>

</html>
