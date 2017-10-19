<?php

namespace BusRoute\Painel\Actions;

// Verificação de Segurança
include 'verificacao.php';

// Objetos
include_once 'obj/Onibus.php';

$objOnibus = new \BusRoute\Painel\Objetos\Onibus();

if ($usuario_permitido) {
    $objOnibus->numero = filter_input(INPUT_POST, 'numeroOnibus', FILTER_SANITIZE_STRING);
    $objOnibus->modelo = filter_input(INPUT_POST, 'modeloOnibus', FILTER_SANITIZE_STRING);
    $objOnibus->placa = filter_input(INPUT_POST, 'placaOnibus', FILTER_SANITIZE_STRING);

    $sucesso = false;
    $erro = false;
    $numero_existente = false;
    $placa_existente = false;

    $results = $mysqli->query("SELECT numero, placa FROM bus_onibus");
    while ($row = $results->fetch_array()) {
        if ($row["numero"] == $objOnibus->numero) {
            $numero_existente = true;
            break;
        }
        if ($row["placa"] == $objOnibus->placa) {
            $placa_existente = true;
            break;
        }
    }

    if (!$numero_existente && !$placa_existente) {
        if ($mysqli->query("INSERT INTO bus_onibus (numero, modelo, placa) VALUES ('$objOnibus->numero', '$objOnibus->modelo', '$objOnibus->placa')")) {
            $sucesso = true;
        } else {
            $erro = true;
        }
    }

    $response_array = array(
        'sucesso' => $sucesso,
        'numero_existente' => $numero_existente,
        'placa_existente' => $placa_existente,
        'erro' => $erro
    );

    echo json_encode($response_array);
}

$results->free();
?>