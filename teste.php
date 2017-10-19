<?php

// Verificação de Segurança
include 'actions/verificacao.php';

if($usuario_permitido) {
    echo "Usuário permitido";
    echo 'Current PHP version: ' . phpversion();
}

?>