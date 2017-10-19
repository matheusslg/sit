<?php

namespace BusRoute\Painel;

// Conexão com o Banco
include 'actions/connect.php';

$results = $mysqli->query("SELECT id, status FROM painel_usuario");
$find = false;

while ($row = $results->fetch_array()) {

    $id_fetch = $row["id"];
    $status_fetch = $row["status"];

    if (empty($_SESSION['id'])) {
        break;
    }

    if ($id_fetch == $_SESSION['id'] && $status_fetch == true) {
        $find = true;
        break;
    }
}

if ($find) {
    ?>             
    <script>
        alert("Você já está conectado! Faça logout para acessar esta página.");
    </script>
    <META http-equiv="refresh" content="0;URL=index.php"> 
    <?php
}

if (!$find) {
    ?>

    <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>ADS IESA</title>

            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="css/bootstrap-theme.min.css">

            <link rel="stylesheet" href="css/pages/login.css">

            <script src="js/jquery-3.1.1.min.js"></script>
            <script src="js/bootstrap.min.js"></script>

            <!-- Caixa de Alerta -->
            <script src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
            <script src="js/alertas.js"></script>

            <script src="js/pages/registrar.js"></script>
            <script src="js/pages/painel.js"></script>

        </head>
        <body>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-md-offset-4">
                        <h1 class="text-center login-title">Insira seus dados abaixo</h1>
                        <div class="account-wall">
                            <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                                 alt="">
                            <form class="form-signin">
                                <input id="usuario" type="text" class="form-control" placeholder="Usuário" required autofocus>
                                <input id="senha" type="password" class="form-control" placeholder="Senha" required>
                                <input id="email" id="email" type="text" class="form-control" placeholder="E-mail" required>
                                <button class="btn btn-lg btn-primary btn-block" type="button" onclick="usuario_registrar()">Registrar</button>
                            </form>
                        </div>
                        <a href="../index.php" class="text-center new-account">Voltar </a>
                    </div>
                </div>
            </div>
        </body>
    </html>

    <?php
}

// Da um free na variável results
$results->free();
?>