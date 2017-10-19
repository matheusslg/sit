<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>PSITP</title>

            <script src="../js/jquery-3.1.1.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/metisMenu.min.js"></script>
            <script src="../js/raphael.min.js"></script>
            <!--<script src="../js/morris.min.js"></script>
            <script src="../js/morris-data.js"></script>-->
            <script src="../js/sb-admin-2.js"></script>
            <link href="../css/bootstrap.css" rel="stylesheet">
            <link href="../css/metisMenu.min.css" rel="stylesheet">
            <link href="../css/sb-admin-2.css" rel="stylesheet">
            <link href="../css/morris.css" rel="stylesheet">
            <link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

            <!-- Google Maps -->
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgMaw5t5r8FCmly6Q2fT9PzsJAgbLW1Dc" async defer></script>

            <!-- Alertas -->
            <script src="../js/noty/packaged/jquery.noty.packaged.min.js"></script>
            <script src="../js/alertas.js"></script>
            <script src="../js/sweetalert.min.js"></script>
            <link href="../css/sweetalert.css" rel="stylesheet">

            <!-- DataTable -->
            <script src="../js/jquery.dataTables.min.js"></script>
            <link href="../css/jquery.dataTables.min.css" rel="stylesheet">

            <!-- JS das páginas -->
            <script src="../js/pages/painel.js"></script>
            <script src="../js/pages/usuario.js"></script>
            <script src="../js/pages/rota.js"></script>
            <script src="../js/pages/cronograma.js"></script>
            <script src="../js/pages/onibus.js"></script>
            <script src="../js/pages/level.js"></script>
            <script src="../js/pages/parada.js"></script>
            
            <!-- Objetos -->
            <script src="../js/model/Cronograma.js"></script>

            <!-- CSS das páginas -->
            <link href="../css/pages/novo_post.css" rel="stylesheet">
            <link href="../css/pages/rota.css" rel="stylesheet">
            <link href="../css/pages/parada.css" rel="stylesheet">

        </head>
        <body>
            <div id="wrapper">
                <!-- Navigation -->
                <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Abrir Menu</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.html">PSITP</a>
                    </div>
                    <!-- /.navbar-header -->

                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="javascript:;"><i class="fa fa-user fa-fw"></i> Perfil</a>
                                </li>
                                <li><a href="javascript:;"><i class="fa fa-gear fa-fw"></i> Configurações</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="../actions/logout.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                    <!-- /.navbar-top-links -->

                    <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav navbar-collapse">
                            <ul class="nav" id="side-menu">
                                <!--<li class="sidebar-search">
                                    <div class="input-group custom-search-form">
                                        <input type="text" class="form-control" placeholder="Buscar...">
                                        <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                    </div>
                                </li>-->
                                <br>
                                <li><label class="label" style="color: #92989b; padding-left: 17px">PRINCIPAL</label></li>
                                <li>
                                    <a href="javascript:;" onclick="menuSidebar_painel_inicio()"><i class="fa fa-dashboard fa-fw"></i> Painel</a>
                                </li>
                                <!--<li>
                                    <a href="javascript:;"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="flot.html">Flot Charts</a>
                                        </li>
                                        <li>
                                            <a href="morris.html">Morris.js Charts</a>
                                        </li>
                                    </ul>
                                </li>-->
                                <li>
                                    <a href="javascript:;"><i class="fa fa-newspaper-o fa-fw"></i> Cronogramas<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="javascript:;" onclick="menuSidebar_cronogramas_novo()">Novo Cronograma</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" onclick="menuSidebar_cronogramas_ver()">Cadastrados</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;"><i class="fa fa-users fa-fw"></i> Paradas<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="javascript:;" onclick="menuSidebar_paradas_novo()">Nova Parada</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" onclick="menuSidebar_paradas_ver()">Cadastradas</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;"><i class="fa fa-bus fa-fw"></i> Ônibus<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="javascript:;" onclick="menuSidebar_onibus_novo()">Novo Ônibus</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" onclick="menuSidebar_onibus_ver()">Cadastrados</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><label class="label" style="color: #92989b; padding-left: 17px">OUTROS RECURSOS</label></li>
                                <li>
                                    <a href="javascript:;"><i class="fa fa-user fa-fw"></i> Usuários<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="javascript:;" onclick="menuSidebar_usuarios_novo()">Novo Usuário</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" onclick="menuSidebar_usuarios_ver()">Cadastrados</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;"><i class="fa fa-exclamation-circle fa-fw"></i> Levels<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="javascript:;" onclick="menuSidebar_levels_novo()">Novo Level</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" onclick="menuSidebar_levels_ver()">Cadastrados</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="../../" target="_blank"><i class="fa fa-globe fa-fw"></i> Visitar Site</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.sidebar-collapse -->
                    </div>
                    <!-- /.navbar-static-side -->
                </nav>

                <div id='dvConteudo'>

                </div>

            </div>
            <!-- /#wrapper -->

        </body>

    </html>

    <?php
}

// Da um free na variável results
$results->free();
?>