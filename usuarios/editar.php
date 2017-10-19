<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao_level.php';

if ($usuario_permitido) {
    
    $idUsuario = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
   
    $results = $mysqli->query("SELECT id, usuario, senha, email FROM painel_usuario");
    
    while ($row = $results->fetch_array()) {
        if($row["id"] == $idUsuario) {
            $usuario = $row["usuario"];
            $senha = $row["senha"];
            $email = $row["email"];
            break;
        }
    }
    
    ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editar Usuário</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edite os dados do usuário nos campos abaixo.
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form">
                                    <label><i class="fa fa-pencil"></i> Usuário</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="usuario" placeholder="Usuário de acesso" value="<?php echo $usuario ?>">
                                    </div>
                                    <label><i class="fa fa-asterisk"></i> Senha</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="senha" placeholder="Senha do usuário" value="<?php echo $senha ?>">
                                    </div>
                                    <label><i class="fa fa-envelope"></i> E-mail</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email" placeholder="E-mail para contato" value="<?php echo $email ?>">
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="salvarUsuarioEditado(<?php echo $row["id"] ?>)">Editar</button>
                                    <button type="reset" class="btn btn-primary">Resetar</button>
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
