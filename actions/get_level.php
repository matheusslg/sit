<?php

namespace BusRoute\Painel\Actions;

include 'verificacao_level.php';

// retorna o level do usuário logado
$level = $_SESSION['level'];
echo $level;

?>
