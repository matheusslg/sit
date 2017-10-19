<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {
    
    $id_onibus = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
   
    $results = $mysqli->query("SELECT id, numero, modelo, placa FROM bus_onibus");
    
    while ($row = $results->fetch_array()) {
        if($row["id"] == $id_onibus) {
            $numero = $row["numero"];
            $modelo = $row["modelo"];
            $placa = $row["placa"];
        }
    }
    
    ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editar Ônibus</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edite os dados do ônibus nos campos abaixo.
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form">
                                    <label><i class="fa fa-pencil"></i> Número</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="numeroOnibus" placeholder="Nome de identificação" value="<?php echo $numero ?>">
                                    </div>
                                    <label><i class="fa fa-bus"></i> Modelo</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="modeloOnibus" placeholder="Endereço da parada" value="<?php echo $modelo ?>">
                                    </div>
                                    <label><i class="fa fa-barcode"></i> Placa</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="placaOnibus" placeholder="Clique sobre um ponto do mapa para pegar as coordenadas" value="<?php echo $placa ?>">
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="salvarOnibusEditado(<?php echo $id_onibus ?>)">Editar</button>
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
