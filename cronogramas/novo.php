<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {

    $results = $mysqli->query("SELECT * FROM bus_cronograma_parada ORDER BY id DESC");
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Novo Cronograma</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Insira os dados do novo cronograma abaixo.
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group" style="display: inline-block; padding-right: 10px; width: 100%">
                                    <label><i class="fa fa-bus"></i> Ônibus</label>
                                    <select id="idOnibus" class="form-control">
                                        <?php
                                        $onibus = $mysqli->query("SELECT id, numero FROM bus_onibus WHERE sendo_usado = 0");
                                        while ($row = $onibus->fetch_array()) {
                                            ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['numero'] ?></option>
                                            <?php
                                        }
                                        $onibus->free();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label><i class="fa fa-hand-paper-o"></i> Paradas</label>
                                        <table id="tabelaDataTable" class="display nowrap dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>Horário</th>
                                                    <th>Parada</th>
                                                    <th>Sentido</th>
                                                    <th>Opções</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyTabelaParadas">
                                                <tr class="odd gradeX">
                                                    <td id="horario" width="75px" class="form-inline">
                                                        <input class="form-control" type="time" id="horarioParada" style="padding-right: 10px">
                                                    </td>
                                                    <td>
                                                        <select id="idParada" class="form-control">
                                                            <?php
                                                            $paradas = $mysqli->query("SELECT * FROM bus_parada");
                                                            while ($row = $paradas->fetch_array()) {
                                                                ?>
                                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['nome'] ?></option>
                                                                <?php
                                                            }
                                                            $paradas->free();
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="sentido" class="form-control">
                                                            <option value="norte">Norte</option>
                                                            <option value="sul">Sul</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-circle" onclick="adicionarParadaCronograma()"><i class="fa fa-plus"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="salvarCronograma()">Salvar</button>
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

// Da um free na variável results
    $results->free();
    ?>
