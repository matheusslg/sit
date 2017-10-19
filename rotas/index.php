<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {
    
    $results = $mysqli->query("SELECT * FROM bus_rota ORDER BY id DESC");
    
    ?>
    
    <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Rotas</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Confira a lista de rotas cadastradas abaixo.
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="tabelaDataTable" class="display nowrap dataTable dtr-inline">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Ônibus</th>
                                <th>Sentido</th>
                                <th>Horário Inicial</th>
                                <th>Horário Final</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $results->fetch_array()) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $row["id"] ?></td>
                                    <td><?php echo $row["nome"] ?></td>
                                    <td>
                                        <?php 
                                        $idOnibus = $row["id_onibus"];
                                        $onibus = $mysqli->query("SELECT id, numero FROM bus_onibus");
                                        while ($data = $onibus->fetch_array()) {
                                            if ($idOnibus == $data["id"]) {
                                                echo $data["numero"];
                                            }
                                        }
                                        mysqli_free_result($onibus);
                                        ?>
                                    </td>
                                    <td><?php echo $row["sentido"] ?></td>
                                    <td>
                                        <?php 
                                        $idRota = $row["id"];
                                        $horarioInicial = $mysqli->query("SELECT horario FROM bus_rota_parada WHERE id_bus_rota = '$idRota' ORDER BY horario ASC LIMIT 1");
                                        while ($data = $horarioInicial->fetch_array()) {
                                            echo $data["horario"];
                                        }
                                        mysqli_free_result($horarioInicial);
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $horarioFinal = $mysqli->query("SELECT horario FROM bus_rota_parada WHERE id_bus_rota = '$idRota' ORDER BY horario DESC LIMIT 1");
                                        while ($data = $horarioFinal->fetch_array()) {
                                            echo $data["horario"];
                                        }
                                        mysqli_free_result($horarioFinal);
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-circle" onclick="editarRota(<?php echo $row["id"] ?>)"><i class="fa fa-pencil"></i></button>
                                        <button type="button" class="btn btn-danger btn-circle" onclick="apagarRota(<?php echo $row["id"] ?>)"><i class="fa fa-remove"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->

<script>ativarDataTable()</script>

<?php
}

mysqli_free_result($results);

?>