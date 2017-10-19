<?php

namespace BusRoute\Painel\Actions;

// Conexão com o Banco
include 'connect.php';

// Objetos
include_once 'obj/Usuario.php';

$objUsuario = new \BusRoute\Painel\Objetos\Usuario();

$objUsuario->usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$objUsuario->senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
$objUsuario->email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

$results = $mysqli->query("SELECT usuario FROM painel_usuario");
$ok = true;
$existente = false;
$campos = false;
$sucesso = false;
$erro = false;
$erro_mysql = false;

while ($row = $results->fetch_array()) {
    $usuario_fetch = $row["usuario"];
    if ($usuario_fetch == $objUsuario->usuario) {
        $existente = true;
        $ok = false;
        break;
    }
}

if (empty($objUsuario->usuario) || empty($objUsuario->senha)) {
    $campos = true;
} else if ($ok) {
    if ($mysqli->query("INSERT INTO painel_usuario (usuario, senha, email, level) VALUES ('$objUsuario->usuario', '$objUsuario->senha', '$objUsuario->email', '1')")) {
        $sucesso = true;
    } else {
        $erro_mysql = true;
    }
} else {
    $erro = true;
}

$response_array = array(
    'sucesso' => $sucesso,
    'existente' => $existente,
    'campos' => $campos,
    'erro' => $erro,
    'erro_mysql' => $erro_mysql
);

echo json_encode($response_array);

mysqli_free_result($results);
?>