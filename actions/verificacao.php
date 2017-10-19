<?php

namespace BusRoute\Painel\Actions;

// Conexão com o Banco
include 'connect.php';

// Token
$token_session = $_SESSION['token'];

$results = $mysqli->query("SELECT id, status, token FROM painel_usuario");
$usuario_permitido = false;

while ($row = $results->fetch_array()) {

    $id_fetch = $row["id"];
    $status_fetch = $row["status"];
    $token_fetch = $row["token"];
    
    if(empty($_SESSION['id'])) {
        break;
    }

    if ($id_fetch == $_SESSION['id'] && $status_fetch == true && $token_session == $token_fetch) {
        $usuario_permitido = true;
        break;
    }
}

if (!$usuario_permitido) {
    ?>             
    <script>
        alert("Você não tem permissão para acessar esta página, precisa se conectar!");
        window.location.replace("../index.php");
    </script>
    <?php
}

?>