<?php

namespace BusRoute\Painel\Actions;

// Verificação de Segurança
include 'verificacao.php';

// Objetos
include_once 'obj/Parada.php';

$objParada = new \BusRoute\Painel\Objetos\Parada();

if ($usuario_permitido) {
    $objParada->nome = filter_input(INPUT_POST, 'nomeParada', FILTER_SANITIZE_STRING);
    $objParada->localizacao = filter_input(INPUT_POST, 'localizacaoParada', FILTER_SANITIZE_STRING);
    $objParada->coordenadas = filter_input(INPUT_POST, 'coordenadasParada', FILTER_SANITIZE_STRING);

    $sucesso = false;
    $erro = false;
    $existente = false;

    $results = $mysqli->query("SELECT nome FROM bus_parada");
    while ($row = $results->fetch_array()) {
        if ($row["nome"] == $objParada->nome) {
            $existente = true;
            break;
        }
    }

    if (!$existente) {
        if ($mysqli->query("INSERT INTO bus_parada (nome, localizacao, coordenadas, sendo_usada) VALUES ('$objParada->nome', '$objParada->localizacao', '$objParada->coordenadas', 'false')")) {
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
?>