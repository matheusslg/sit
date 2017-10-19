<?php

namespace BusRoute\Painel\Actions;

// Conexão com o Banco
include 'connect.php';

// Dados dos inputs
$usuario = filter_input(INPUT_POST, 'usuarioLogin', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senhaLogin', FILTER_SANITIZE_STRING);
$ultimo_acesso = date("Y-m-d H:i:s");

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$results = $mysqli->query("SELECT id, usuario, senha, status, level FROM painel_usuario");
$find = false;

while ($row = $results->fetch_array()) {

    $sucesso = false;
    $erro = false;
    $dado_incorreto = false;

    $id_fetch = $row["id"];
    $usuario_fetch = $row["usuario"];
    $senha_fetch = $row["senha"];
    $status_fetch = $row["status"];
    $level_fetch = $row["level"];

    if ($usuario_fetch == $usuario && $senha_fetch == $senha) {
        if ($mysqli->query("UPDATE painel_usuario SET status = true, ultimo_ip = \"$ip\", ultimo_acesso = \"$ultimo_acesso\" WHERE id=" . $id_fetch)) {
            $token = md5("$usuario_fetch" . "$ip" . "$ultimo_acesso");
            if ($mysqli->query("UPDATE painel_usuario SET token = \"$token\" WHERE id=" . $id_fetch)) {
                $_SESSION['token'] = $token;
                $_SESSION['id'] = $id_fetch;
                $_SESSION['status'] = $status_fetch;
                $_SESSION['level'] = $level_fetch;
                $sucesso = true;
                break;
            } else {
                //echo $mysqli->error;
                $erro = true;
            }
        } else {
            //echo $mysqli->error;
            $erro = true;
        }
    } else {
        $dado_incorreto = true;
    }
}

$response_array = array(
    'sucesso' => $sucesso,
    'dado_incorreto' => $dado_incorreto,
    'erro' => $erro
);

echo json_encode($response_array);

$results->free();
?>
