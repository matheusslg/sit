<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {
    
    $results = $mysqli->query("SELECT bus_cronograma.id,bus_onibus.numero FROM bus_cronograma INNER JOIN bus_onibus ON bus_onibus.id=bus_cronograma.idOnibus ORDER BY id DESC");
    
    ?>
    
    <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cronogramas</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Confira a lista de cronogramas cadastrados abaixo.
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table id="tabelaDataTable" class="display nowrap dataTable dtr-inline">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ônibus</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $results->fetch_array()) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $row["id"] ?></td>
                                    <td><?php echo $row["numero"] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-circle" onclick="editarCronograma(<?php echo $row["id"] ?>)"><i class="fa fa-pencil"></i></button>
                                        <button type="button" class="btn btn-danger btn-circle" onclick="apagarCronograma(<?php echo $row["id"] ?>)"><i class="fa fa-remove"></i></button>
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