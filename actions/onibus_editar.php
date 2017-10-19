<?php

namespace BusRoute\Painel\Actions;

// Verificação de Segurança
include 'verificacao.php';

// Objetos
include_once 'obj/Onibus.php';

$objOnibus = new \BusRoute\Painel\Objetos\Onibus();

if ($usuario_permitido) {
    $objOnibus->id = filter_input(INPUT_POST, 'idOnibus', FILTER_VALIDATE_INT);
    $objOnibus->numero = filter_input(INPUT_POST, 'numeroOnibus', FILTER_SANITIZE_STRING);
    $objOnibus->modelo = filter_input(INPUT_POST, 'modeloOnibus', FILTER_SANITIZE_STRING);
    $objOnibus->placa = filter_input(INPUT_POST, 'placaOnibus', FILTER_SANITIZE_STRING);

    $sucesso = false;
    $erro = false;
    
    if ($mysqli->query("UPDATE bus_onibus SET numero = '$objOnibus->numero', modelo = '$objOnibus->modelo', placa = '$objOnibus->placa' WHERE id = '$objOnibus->id'")) {
        $sucesso = true;
    } else {
        $erro = true;
    }

    $response_array = array(
        'sucesso' => $sucesso,
        'erro' => $erro
    );

    echo json_encode($response_array);
}

$results->free();
?>