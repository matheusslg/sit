<?php

namespace BusRoute\Painel\Actions;

// Verificação de Segurança
include 'verificacao.php';

// Objetos
include_once 'obj/Rota.php';

$objRota = new \BusRoute\Painel\Objetos\Rota();

if ($usuario_permitido) {
    $quantidadeParadasPreenchidas = filter_input(INPUT_POST, 'qt', FILTER_VALIDATE_INT);
    $objRota->nome = filter_input(INPUT_POST, 'nr', FILTER_SANITIZE_STRING);
    $objRota->periodo = filter_input(INPUT_POST, 'po', FILTER_SANITIZE_STRING);
    $objRota->id_onibus = filter_input(INPUT_POST, 'io', FILTER_VALIDATE_INT);
    $dados = json_decode($_POST['ds'], true);
    
    /* echo $nomeRota;
      echo $idOnibus;
      for ($i = 0; $i < $quantidadeParadasPreenchidas; $i++) {
      echo $dados[$i]["id_bus_parada"];
      echo $dados[$i]["horario"];
      } */

    // coloca os dados do array dentro das variáveis para salvar no banco
    for ($i = 0; $i < $quantidadeParadasPreenchidas; $i++) {
        $horarioParada[$i] = $dados[$i]["horario"];
        $idParada[$i] = $dados[$i]["id_bus_parada"];
    }

    $sucesso = false;
    $erro = false;
    $existente = false;

    $select = $mysqli->query("SELECT nome FROM bus_rota");
    while ($row = $select->fetch_array()) {
        if ($row["nome"] == $objRota->nome) {
            $existente = true;
        }
    }

    if (!$existente) {
        if ($mysqli->query("INSERT INTO bus_rota (nome, id_onibus, periodo) VALUES ('$objRota->nome','$objRota->id_onibus','$objRota->periodo')")) {
            $ultimaID = $mysqli->insert_id;
            for ($i = 0; $i < $quantidadeParadasPreenchidas; $i++) {
                if ($mysqli->query("INSERT INTO bus_rota_parada (id_bus_rota, id_bus_parada, horario) VALUES ('$ultimaID', '$idParada[$i]', '$horarioParada[$i]')")) {
                    if ($mysqli->query("UPDATE bus_parada SET sendo_usada = true WHERE id = '$idParada[$i]'")) {
                        if ($mysqli->query("UPDATE bus_onibus SET sendo_usado = true WHERE id = '$objRota->id_onibus'")) {
                            $sucesso = true;
                        } else {
                            $erro = true;
                        }
                    } else {
                        $erro = true;
                    }
                } else {
                    $erro = true;
                }
            }
        } else {
            $erro = true;
            //echo $mysqli->error;
        }
    }

    $response_array = array(
        'sucesso' => $sucesso,
        'existente' => $existente,
        'erro' => $erro
    );

    echo json_encode($response_array);
}

$results->free();
$select->free();
?>