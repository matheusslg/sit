<?php

namespace BusRoute\Painel;

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Novo Ônibus</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Insira os dados do ônibus abaixo.
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form">
                                    <label><i class="fa fa-pencil"></i> Número</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="numeroOnibus" placeholder="Número de identificação">
                                    </div>
                                    <label><i class="fa fa-bus"></i> Modelo</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="modeloOnibus" placeholder="Modelo/Marca do ônibus">
                                    </div>
                                    <label><i class="fa fa-barcode"></i> Placa</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="placaOnibus" placeholder="Placa do ônibus">
                                    </div>
                                    <button type="button" class="btn btn-success" onclick="salvarOnibus()">Salvar</button>
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

// Da um free na variável results
$results->free();
?>
