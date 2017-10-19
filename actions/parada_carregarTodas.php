<?php

namespace BusRoute\Painel\Actions;

// Verificação de Segurança
include 'verificacao.php';

if ($usuario_permitido) {
    $paradas = $mysqli->query("SELECT * from bus_parada ORDER BY id DESC");

    $i = 0;
    while ($row = $paradas->fetch_array()) {
        $array[$i] = array(
            'id' => $row["id"],
            'nome' => $row["nome"],
            'localizacao' => $row["localizacao"],
            'coordenadas' => $row["coordenadas"],
            'sendo_usada' => $row["sendo_usada"]
        );
        $i++;
    }

    $json = json_encode($array);

    if ($json)
        echo $json;
    else
        echo json_last_error_msg();
}
