<?php

namespace BusRoute\Painel\Actions;

// Verificação de Segurança
include 'verificacao.php';

// Objetos
include_once 'obj/Rota.php';

$objRota = new \BusRoute\Painel\Objetos\Rota();

if ($usuario_permitido) {
    $objRota->nome = filter_input(INPUT_POST, 'nomeRota', FILTER_SANITIZE_STRING);
    $objRota->sentido = filter_input(INPUT_POST, 'sentidoRota', FILTER_SANITIZE_STRING);
    $objRota->id_onibus = filter_input(INPUT_POST, 'idOnibus', FILTER_VALIDATE_INT);

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
        if ($mysqli->query("INSERT INTO bus_rota (nome, id_onibus, sentido) VALUES ('$objRota->nome','$objRota->id_onibus','$objRota->sentido')")) {
            $sucesso = true;
        } else {
            $erro = true;
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