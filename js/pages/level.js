var salvarLevel = function () {
    var nome = $('#nome').val();
    var level = $('#level').val();

    var levelValido = false;

    var testLevel = /^[0-9]/;
    if (testLevel.test(level)) {
        levelValido = true;
    } else {
        var n = noty({
            text: 'O level digitado não é válido!',
            type: 'warning'
        });
        level.focus;
    }

    if (levelValido) {
        var postData = {
            "nome": nome,
            "level": level
        };

        $.ajax({
            url: "../actions/level_inserir.php",
            type: "post",
            data: postData,
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == true) {
                    var n = noty({
                        text: "Level cadastrado com sucesso!",
                        type: 'success'
                    });

                    // limpa os inputs
                    $('#nome').val("");
                    $('#level').val("");

                } else if (data.existente == true) {
                    var n = noty({
                        text: 'O level digitado já existe!',
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

var salvarLevelEditado = function (id) {
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
            "idUsuario": id,
            "usuarioUsuario": usuario,
            "senhaUsuario": senha,
            "emailUsuario": email
        };

        $.ajax({
            url: "../actions/usuario_editar.php",
            type: "post",
            data: postData,
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == true) {
                    var n = noty({
                        text: "Usuário atualizado com sucesso!",
                        type: 'success'
                    });

                    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'usuarios');

                } else if (data.erro == true) {
                    var n = noty({
                        text: 'Ocorreu um erro ao atualizar esta informação no banco de dados. Contate o suporte!',
                        type: 'error'
                    });
                }
            },
        });
    }
}

var apagarUsuario = function (id) {
    $.ajax({
        url: "../actions/get_level.php",
        type: "get",
        success: function (data) {
            if (data > 3) {

                var id_usuario = id;

                var postData = {
                    "id_usuario": id_usuario
                };

                $.ajax({
                    url: "../actions/usuario_apagar.php",
                    type: "post",
                    data: postData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.sucesso == true) {
                            var n = noty({
                                text: "Usuário deletado com sucesso!",
                                type: 'success'
                            });

                            $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'usuarios');
                        } else if (data.erro == true) {
                            var n = noty({
                                text: 'Ocorreu um erro ao executar o comando no banco de dados',
                                type: 'error'
                            });
                        } else if (data.usuario_permitido == false) {
                            var n = noty({
                                text: 'Você não tem permissão para executar esta ação',
                                type: 'warning'
                            });
                        }
                    },
                });

            } else {
                var n = noty({
                    text: "Você não tem permissão para realizar esta ação!",
                    type: 'error'
                });
            }
        },
    });
}

var editarLevel = function (id) {
    $.ajax({
        url: "../actions/get_level.php",
        type: "get",
        success: function (data) {
            if (data == 100) {
                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'levels/editar.php?id=' + id);
            } else {
                var n = noty({
                    text: "Você não tem permissão para realizar esta ação!",
                    type: 'error'
                });
            }
        },
    });
}