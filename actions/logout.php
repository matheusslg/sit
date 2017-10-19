<?php

namespace BusRoute\Painel\Actions;

// Conexão com o Banco
include 'connect.php';

$results = $mysqli->query("SELECT id, status FROM painel_usuario");

while ($row = $results->fetch_array()) {

    $id_fetch = $row["id"];
    $status_fetch = $row["status"];

    if ($id_fetch == $_SESSION['id'] && $status_fetch == true) {
        if ($mysqli->query("UPDATE painel_usuario SET status = false WHERE id=" . $id_fetch)) {
            unset($_SESSION['id']);
            session_destroy();
            ?>
            <META http-equiv="refresh" content="0;URL=../index.php"> 
            <?php
            break;
        }
    }
}

// Da um free na variável results
$results->free();
?>
