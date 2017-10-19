<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {

    $results = $mysqli->query("SELECT id, nome, localizacao FROM bus_parada ORDER BY id DESC");
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nova Rota</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Insira os dados da nova rota abaixo.
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group" style="display: inline-block; padding-right: 10px; width: 100%">
                                    <label><i class="fa fa-pencil"></i> Nome da Rota</label>
                                    <input type="text" class="form-control" id="nomeRota" placeholder="Nome de identificação">
                                </div>
                                <div class="form-group" style="display: inline-block; padding-right: 10px; width: 100%">
                                    <label><i class="fa fa-location-arrow"></i> Sentido</label>
                                    <select id="sentidoRota" class="form-control">
                                        <option value="Norte">Norte</option>
                                        <option value="Sul">Sul</option>
                                    </select>
                                </div>
                                <div class="form-group" style="display: inline-block; padding-right: 10px; width: 100%">
                                    <label><i class="fa fa-bus"></i> Ônibus</label>
                                    <select id="idOnibus" class="form-control">
                                        <?php
                                        $onibus = $mysqli->query("SELECT id, numero FROM bus_onibus");
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
                                    <button onclick="resizeMap()" type="button" class="btn btn-info" data-toggle="collapse" data-target="#divNovaParada" style="margin-bottom: 15px">Nova Parada</button>
                                    <div id="divNovaParada" class="collapse">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <form role="form">
                                                            <label><i class="fa fa-pencil"></i> Nome da Parada</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="nomeParada" placeholder="Nome de identificação">
                                                            </div>
                                                            <label><i class="fa fa-map"></i> Localização</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="localizacaoParada" placeholder="Endereço da parada">
                                                            </div>
                                                            <label><i class="fa fa-map-marker"></i> Coordenadas</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="coordenadasParada" placeholder="Clique sobre um ponto do mapa para pegar as coordenadas">
                                                            </div>
                                                            <div id="map"></div><br/>
                                                            <button type="button" class="btn btn-success" onclick="salvarParadaNaRota()">Salvar</button>
                                                            <button type="reset" class="btn btn-primary">Limpar Campos</button>
                                                        </form>
                                                    </div>
                                                    <!-- /.col-lg-6 (nested) -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fa fa-hand-paper-o"></i> Paradas</label>  <label class="label label-info">Informe os horários em que o ônibus designado efetua as paradas</label>
                                        <div id="tabelaDeParadas">
                                            <script>montaDTParadas()</script>
                                        </div>
                                    </div>                     
                                    <button type="button" class="btn btn-success" onclick="salvarRota(<?php echo $row['id'] ?>)">Salvar</button>
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

        <script>
            initMapNovaParada();
            ativarDataTable();
        </script>

        <?php
    }

// Da um free na variável results
    $results->free();
    ?>
