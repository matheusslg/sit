<?php

namespace BusRoute\Painel\Actions;

$servername = "localhost";
$username = "matheuscavallini";
$password = "mnc825";
$db = "matheuscavallini";

$mysqli = new \mysqli($servername, $username, $password, $db);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
} else if (!$mysqli->connect_errno) {
    session_start();
}


?>