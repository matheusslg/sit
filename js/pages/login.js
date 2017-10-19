var login = function () {
    var usuario = $('#lg_username').val();
    var senha = $('#lg_password').val();

    var usuarioValido = false;
    var senhaValida = false;

    if (usuario.length < 10) {
        var n = noty({
            text: 'O usuário digitado não possui no m\u00ednimo 10 caracteres. Tente novamente.',
            type: 'warning'
        });
    } else {
        usuarioValido = true;
    }

    if (senha.length < 8) {
        var n = noty({
            text: 'A senha digitada não possui no m\u00ednimo 8 caracteres. Tente novamente.',
            type: 'warning'
        });
    } else {
        senhaValida = true;
    }

    if (usuarioValido && senhaValida) {
        var postData = {
            "usuarioLogin": usuario,
            "senhaLogin": senha
        };

        $.ajax({
            url: "actions/login.php",
            type: "post",
            data: postData,
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == true) {
                    window.location.replace("index");
                } else if (data.dado_incorreto == true) {
                    var n = noty({
                        text: 'Usuário/senha incorretos! Tente novamente.',
                        type: 'warning'
                    });
                } else if (data.erro == true) {
                    var n = noty({
                        text: 'Ocorreu um erro fazer conexão com o banco de dados. Contate o suporte!',
                        type: 'error'
                    });
                }
            },
        });
    }
}

