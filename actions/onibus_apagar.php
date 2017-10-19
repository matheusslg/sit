<?php

namespace BusRoute\Painel\Actions;

// Verificação de Segurança
include 'verificacao_level.php';

if ($usuario_permitido) {

    $id = filter_input(INPUT_POST, 'idOnibus', FILTER_VALIDATE_INT);

    $sucesso = false;
    $erro = false;
    $sendo_usado = false;

    $results = $mysqli->query("SELECT id, sendo_usado FROM bus_onibus WHERE id=" . $id);
    while ($row = $results->fetch_array()) {
        if ($row["sendo_usado"] == true) {
            $sendo_usado = true;
            break;
        } else {
            if ($row["id"] == $id) {
                if ($mysqli->query("DELETE FROM bus_onibus WHERE id=" . $id)) {
                    $sucesso = true;
                    break;
                } else {
                    $erro = true;
                    break;
                }
                break;
            }
        }
    }
}

$response_array = array(
    'sucesso' => $sucesso,
    'sendo_usado' => $sendo_usado,
    'erro' => $erro
);

echo json_encode($response_array);

$results->free();
