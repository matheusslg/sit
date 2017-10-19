<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PSITP</title>

    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/pages/login.css">

    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/pages/login.js"></script>
    
    <!-- Alertas -->
    <script src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="js/alertas.js"></script>

</head>
<body>
<?php
    
// Conexão com o Banco
include 'actions/connect.php';

$results = $mysqli->query("SELECT id, status, token FROM painel_usuario");
$find = false;

while ($row = $results->fetch_array()) {

    $id_fetch = $row["id"];
    $status_fetch = $row["status"];
    $token_fetch = $row["token"];
    
    if(empty($_SESSION['id']) || empty($_SESSION['token'])) {
        break;
    }

    if ($id_fetch == $_SESSION['id'] && $status_fetch == true && $_SESSION['token'] == $token_fetch) { ?>
        
        <META http-equiv="refresh" content="0;URL=../adm/index"> 
    
        <?php
        $find = true;
        break;
    }
}

if (!$find) {
    ?>
        <div class="text-center" style="padding:50px 0">
	<div class="logo">login</div>
	<!-- Main Form -->
	<div class="login-form-1">
		<form id="login-form" class="text-left">
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="lg_username" class="sr-only">Usuário</label>
						<input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="usuário">
					</div>
					<div class="form-group">
						<label for="lg_password" class="sr-only">Senha</label>
						<input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="senha">
					</div>
					<div class="form-group login-group-checkbox">
						<input type="checkbox" id="lg_remember" name="lg_remember">
						<label for="lg_remember">relembrar</label>
					</div>
				</div>
                            <button type="button" class="login-button" onclick="login()"><i class="fa fa-chevron-right"></i></button>
			</div>
			<div class="etc-login-form">
				<p>esqueceu sua senha? <a href="#">clique aqui</a></p>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
    </div>
    <!--<div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title">Faça login para entrar no painel</h1>
                <div class="account-wall">
                    <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                    <form class="form-signin" action="actions/login.php" method="post">
                        <input name="usuario" type="text" class="form-control" placeholder="E-mail ou usuário" required autofocus>
                        <input name="senha" type="password" class="form-control" placeholder="Senha" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                        <a href="#" class="pull-right need-help">Esqueceu a senha? </a><span class="clearfix"></span>
                    </form>
                </div>
                <a href="registrar.php" class="text-center new-account">Criar uma conta </a>
            </div>
        </div>
    </div>-->
    <?php
}

// Da um free na variável results
$results->free();
    
?>
    
</body>
</html>