<?php

namespace BusRoute\Painel\Actions;

// Verificação de Segurança
include 'verificacao.php';

if ($usuario_permitido) {
    $results = $mysqli->query("SELECT MAX(id) FROM bus_rota");
    while ($row = $results->fetch_array()) {
        $ultimaID = $row['MAX(id)'];
    }
    echo $ultimaID;
}