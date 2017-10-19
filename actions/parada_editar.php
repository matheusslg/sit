<?php

namespace BusRoute\Painel\Actions;

// Verificação de Segurança
include 'verificacao.php';

// Objetos
include_once 'obj/Parada.php';

$objParada = new \BusRoute\Painel\Objetos\Parada();

if ($usuario_permitido) {
    $objParada->id = filter_input(INPUT_POST, 'idParada', FILTER_VALIDATE_INT);
    $objParada->nome = filter_input(INPUT_POST, 'nomeParada', FILTER_SANITIZE_STRING);
    $objParada->localizacao = filter_input(INPUT_POST, 'localizacaoParada', FILTER_SANITIZE_STRING);
    $objParada->coordenadas = filter_input(INPUT_POST, 'coordenadasParada', FILTER_SANITIZE_STRING);

    $sucesso = false;
    $erro = false;
    
    if ($mysqli->query("UPDATE bus_parada SET nome = '$objParada->nome', localizacao = '$objParada->localizacao', coordenadas = '$objParada->coordenadas' WHERE id = '$objParada->id'")) {
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