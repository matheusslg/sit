var usuario_registrar = function () {
    var usuario = $('#usuario').val();
    var senha = $('#senha').val();
    var email = $('#email').val();
    
    var emailValido = false;
    var usuarioValido = false;
    var senhaValida = false;

    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (testEmail.test(email)) {
        emailValido = true;
    } else {
        var n = noty({
            text: 'O email digitado não é válido!',
            type: 'warning'
        });
        email.focus;
    }

    if (usuario.length < 10) {
        var n = noty({
            text: 'O usuário digitado não possui no m\u00ednimo 10 caracteres. Tente novamente.',
            type: 'warning'
        });
        usuario.focus;
    } else {
        usuarioValido = true;
    }

    if (senha.length < 8) {
        var n = noty({
            text: 'A senha digitada não possui no m\u00ednimo 8 caracteres. Tente novamente.',
            type: 'warning'
        });
        senha.focus;
    } else {
        senhaValida = true;
    }

    if (usuarioValido && senhaValida && emailValido) {
        var postData = {
            "usuario": usuario,
            "senha": senha,
            "email": email
        };

        $.ajax({
            url: "actions/usuario_inserir.php",
            type: "post",
            data: postData,
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == true) {
                    var n = noty({
                        text: "Usuário cadastrado com sucesso!",
                        type: 'success'
                    });

                    var delay = 3000;
                    setTimeout(function () {
                        window.location.replace("index.php");
                    }, delay);

                } else if (data.existente == true) {
                    var n = noty({
                        text: 'O nome de usuário digitado já existe',
                        type: 'warning'
                    });
                } else if (data.campos == true) {
                    var n = noty({
                        text: 'Preencha os campos vazios!',
                        type: 'warning'
                    });
                } else if (data.erro == true) {
                    var n = noty({
                        text: 'Erro desconhecido!',
                        type: 'error'
                    });
                } else if (data.erro_mysql == true) {
                    var n = noty({
                        text: 'Erro de conexão com o banco de dados',
                        type: 'error'
                    });
                }
            },
        });
    }
}