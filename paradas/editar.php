<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {
    
    $id_parada = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
   
    $results = $mysqli->query("SELECT id, nome, localizacao, coordenadas FROM bus_parada");
    
    while ($row = $results->fetch_array()) {
        if($row["id"] == $id_parada) {
            $nome = $row["nome"];
            $localizacao = $row["localizacao"];
            $coordenadas = $row["coordenadas"];
            break;
        }
    }
    
    ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editar Parada</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edite os dados da parada nos campos abaixo.
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form">
                                    <label><i class="fa fa-pencil"></i> Nome da Parada</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nomeParada" placeholder="Nome de identificação" value="<?php echo $nome ?>">
                                    </div>
                                    <label><i class="fa fa-map"></i> Localização</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="localizacaoParada" placeholder="Endereço da parada" value="<?php echo $localizacao ?>">
                                    </div>
                                    <label><i class="fa fa-map-marker"></i> Coordenadas</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="coordenadasParada" placeholder="Clique sobre um ponto do mapa para pegar as coordenadas" value="<?php echo $coordenadas ?>">
                                    </div>
                                    <div id="map"></div><br/>
                                    <button type="button" class="btn btn-success" onclick="salvarParadaEditada(<?php echo $id_parada ?>)">Editar</button>
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
    
    <script>initMapEditarParada()</script>
    
    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgMaw5t5r8FCmly6Q2fT9PzsJAgbLW1Dc&callback=initMapEditarParada" async defer></script>-->

    <?php
}

mysqli_free_result($results);

?>
