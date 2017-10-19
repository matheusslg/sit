<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Novo Usuário</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Insira os dados do novo usuário abaixo.
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form">
                                    <label><i class="fa fa-pencil"></i> Usuário</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="usuario" placeholder="Usuário de acesso">
                                    </div>
                                    <label><i class="fa fa-asterisk"></i> Senha</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="senha" placeholder="Senha do usuário">
                                    </div>
                                    <label><i class="fa fa-envelope"></i> E-mail</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email" placeholder="E-mail para contato">
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="salvarUsuario()">Salvar</button>
                                    <button type="reset" class="btn btn-primary">Limpar Campos</button>
                                </form>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    <?php
}

mysqli_free_result($results);
?>
