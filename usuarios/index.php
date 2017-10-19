<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {
    $results = $mysqli->query("SELECT id, usuario, email, status, level FROM painel_usuario");
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Usuários</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Confira a lista de usuários cadastrados abaixo
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table id="tabelaDataTable" class="display nowrap dataTable dtr-inline">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuário</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Level</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $results->fetch_array()) {
                                    $id_fetch = $row["id"];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row["id"] ?></td>
                                        <td><?php echo $row["usuario"] ?></td>
                                        <td><?php echo $row["email"] ?></td>
                                        <td>
                                            <?php
                                            if ($row["status"] == 1) {
                                                echo "Online";
                                            } else if ($row["status"] == 0) {
                                                echo "Offline";
                                            }
                                            ?></td>
                                        <td><?php echo $row["level"] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-circle" onclick="editarUsuario(<?php echo $id_fetch ?>)"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger btn-circle" onclick="apagarUsuario(<?php echo $id_fetch ?>)"><i class="fa fa-remove"></i></button>
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