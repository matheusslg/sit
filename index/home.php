<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Painel</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">

                                    <?php
                                    if ($usuarios = $mysqli->query("SELECT id FROM painel_usuario")) {
                                        printf($usuarios->num_rows);
                                    }

                                    $usuarios->free();
                                    ?>

                                </div>
                                <div>Usuários Cadastrados</div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:;" onclick="menuSidebar_usuarios_ver()">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalhes</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-map-signs fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">

                                    <?php
                                    if ($rotas = $mysqli->query("SELECT id FROM bus_rota")) {
                                        printf($rotas->num_rows);
                                    }

                                    $rotas->free();
                                    ?>

                                </div>
                                <div>Rotas Cadastradas</div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:;" onclick="menuSidebar_rotas_ver()">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalhes</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-hand-paper-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    
                                    <?php
                                    if ($paradas = $mysqli->query("SELECT id FROM bus_parada")) {
                                        printf($paradas->num_rows);
                                    }

                                    $paradas->free();
                                    ?>
                                    
                                </div>
                                <div>Paradas Cadastradas</div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:;" onclick="menuSidebar_paradas_ver()">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalhes</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-bus fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    
                                    <?php
                                    if ($onibus = $mysqli->query("SELECT id FROM bus_onibus")) {
                                        printf($onibus->num_rows);
                                    }

                                    $onibus->free();
                                    ?>
                                    
                                </div>
                                <div>Ônibus Cadastrados</div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:;" onclick="menuSidebar_onibus_ver()">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalhes</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->

    <?php
}

mysqli_free_result($results);

?>