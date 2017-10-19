<?php

namespace BusRoute\Painel\Actions;

// Verificação de Segurança
include 'verificacao_level.php';

if ($usuario_permitido) {
    
    $id = filter_input(INPUT_POST, 'idParada', FILTER_VALIDATE_INT);
    
    $sucesso = false;
    $erro = false;
    $sendo_usada = false;
    
    $results = $mysqli->query("SELECT id, sendo_usada FROM bus_parada");
    while ($row = $results->fetch_array()) {
        if ($row["id"] == $id && $row["sendo_usada"] == false) {
            if ($mysqli->query("DELETE FROM bus_parada WHERE id=" . $id . "")) {
                $sucesso = true;
                break;
            } else {
                $erro = true;
                break;
            }
            break;
        } else {
            $sendo_usada = true;
        }
    }
}

$response_array = array(
    'sucesso' => $sucesso,
    'sendo_usada' => $sendo_usada,
    'erro' => $erro
);

echo json_encode($response_array);

$results->free();