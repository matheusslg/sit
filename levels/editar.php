<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao_level.php';

if ($usuario_permitido) {

    $idLevel = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $results = $mysqli->query("SELECT * FROM bus_level WHERE id=" . $idLevel);

    while ($row = $results->fetch_array()) {
        $nome = $row["nome"];
        $level = $row["level"];
        break;
    }
    ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editar Level</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edite os dados do level nos campos abaixo.
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form">
                                    <label><i class="fa fa-pencil"></i> Nome</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nome" placeholder="Nome do level" value="<?php echo $nome ?>">
                                    </div>
                                    <label><i class="fa fa-asterisk"></i> Level</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="level" placeholder="Numeração do level" value="<?php echo $level ?>">
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="salvarLevelEditado(<?php echo $row["id"] ?>)">Editar</button>
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
