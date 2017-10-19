<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nova Parada</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Insira os dados da parada abaixo.
                    </div>
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
                                    <button type="button" class="btn btn-success" onclick="salvarParada()">Salvar</button>
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

    <script>initMapNovaParada()</script>

    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgMaw5t5r8FCmly6Q2fT9PzsJAgbLW1Dc&callback=initMapNovaParada" async defer></script>-->

    <?php
}

// Da um free na variável results
$results->free();
?>
