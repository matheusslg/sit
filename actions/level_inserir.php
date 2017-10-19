<?php

namespace BusRoute\Painel\Actions;

// Conexão com o Banco
include 'connect.php';

// Objetos
include_once 'obj/Level.php';

$objLevel = new \BusRoute\Painel\Objetos\Level();

$objLevel->nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$objLevel->level = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_STRING);

$results = $mysqli->query("SELECT level FROM bus_level");
$ok = true;
$existente = false;
$campos = false;
$sucesso = false;
$erro = false;
$erro_mysql = false;

while ($row = $results->fetch_array()) {
    $level_fetch = $row["level"];
    if ($level_fetch == $objLevel->level) {
        $existente = true;
        $ok = false;
        break;
    }
}

if (empty($objLevel->nome) || empty($objLevel->level)) {
    $campos = true;
} else if ($ok) {
    if ($mysqli->query("INSERT INTO bus_level (nome, level, sendo_usado) VALUES ('$objLevel->nome', '$objLevel->level', '0')")) {
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