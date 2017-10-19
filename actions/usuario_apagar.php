<?php

namespace BusRoute\Painel\Actions;

// Verificação de Segurança
include 'verificacao_level.php';

// Objetos
include_once 'obj/Usuario.php';

$objUsuario = new \BusRoute\Painel\Objetos\Usuario();

if ($usuario_permitido) {
    
    $sucesso = false;
    $erro = false;
    
    $objUsuario->id = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);
    $results = $mysqli->query("SELECT id FROM painel_usuario");
    while ($row = $results->fetch_array()) {
        $id_fetch = $row["id"];
        if ($id_fetch == $objUsuario->id) {
            if ($mysqli->query("DELETE FROM painel_usuario WHERE id=" . $objUsuario->id . "")) {
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

$response_array = array(
    'sucesso' => $sucesso,
    'erro' => $erro,
    'usuario_permitido' => $usuario_permitido
);

echo json_encode($response_array);

$results->free();