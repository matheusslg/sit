<?php

namespace BusRoute\Painel\Actions;

// Verificação de Segurança
include 'verificacao_level.php';

// Objetos
include_once 'obj/Usuario.php';

$objUsuario = new \BusRoute\Painel\Objetos\Usuario();

if ($usuario_permitido) {
    $objUsuario->id = filter_input(INPUT_POST, 'idUsuario', FILTER_VALIDATE_INT);
    $objUsuario->usuario = filter_input(INPUT_POST, 'usuarioUsuario', FILTER_SANITIZE_STRING);
    $objUsuario->senha = filter_input(INPUT_POST, 'senhaUsuario', FILTER_SANITIZE_STRING);
    $objUsuario->email = filter_input(INPUT_POST, 'emailUsuario', FILTER_SANITIZE_STRING);

    $results = $mysqli->query("SELECT usuario FROM painel_usuario");
    $existente = false;
    $campos = false;
    $sucesso = false;
    $erro_mysql = false;

    while ($row = $results->fetch_array()) {
        $usuario_fetch = $row["usuario"];
        if ($usuario_fetch == $objUsuario->usuario) {
            $existente = true;
            break;
        }
    }

    if (empty($objUsuario->usuario) || empty($objUsuario->senha)) {
        $campos = true;
    }
    
    if (!$existente && !$campos) {
        if ($mysqli->query("UPDATE painel_usuario SET usuario = '$objUsuario->usuario', senha = '$objUsuario->senha', email = '$objUsuario->email' WHERE id = '$objUsuario->id'")) {
            $sucesso = true;
        } else {
            $erro_mysql = true;
        }
    }

    $response_array = array(
        'sucesso' => $sucesso,
        'existente' => $existente,
        'campos' => $campos,
        'erro_mysql' => $erro_mysql
    );

    echo json_encode($response_array);

    mysqli_free_result($results);
}
?>