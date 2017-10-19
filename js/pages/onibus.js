var salvarOnibus = function () {
    var campoVazio = false;
    if ($('#numeroOnibus').val() == "") {
        campoVazio = true;
    } else {
        var numero = $('#numeroOnibus').val();
    }
    if ($('#modeloOnibus').val() == "") {
        campoVazio = true;
    } else {
        var modelo = $('#modeloOnibus').val();
    }
    if ($('#placaOnibus').val() == "") {
        campoVazio = true;
    } else {
        var placa = $('#placaOnibus').val();
    }

    if (campoVazio) {
        var n = noty({
            text: "Preencha todos os campos do formulário.",
            type: 'warning'
        });
    } else {
        var postData = {
            "numeroOnibus": numero,
            "modeloOnibus": modelo,
            "placaOnibus": placa
        };

        $.ajax({
            url: "../actions/onibus_inserir.php",
            type: "post",
            data: postData,
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == true) {
                    var n = noty({
                        text: "Ônibus cadastrado com sucesso!",
                        type: 'success'
                    });

                    // Limpa os inputs
                    $('#numeroOnibus').val("");
                    $('#modeloOnibus').val("");
                    $('#placaOnibus').val("");

                } else if (data.numero_existente == true) {
                    var n = noty({
                        text: 'O número digitado já existe no sistema!',
                        type: 'warning'
                    });
                } else if (data.placa_existente == true) {
                    var n = noty({
                        text: 'A placa digitada já existe no sistema!',
                        type: 'warning'
                    });
                } else if (data.erro == true) {
                    var n = noty({
                        text: 'Ocorreu um erro ao inserir esta informação no banco de dados. Contate o suporte!',
                        type: 'error'
                    });
                }
            },
        });
    }
}

var salvarOnibusEditado = function (id) {
    var campoVazio = false;
    if ($('#numeroOnibus').val() == "") {
        campoVazio = true;
    } else {
        var numero = $('#numeroOnibus').val();
    }
    if ($('#modeloOnibus').val() == "") {
        campoVazio = true;
    } else {
        var modelo = $('#modeloOnibus').val();
    }
    if ($('#placaOnibus').val() == "") {
        campoVazio = true;
    } else {
        var placa = $('#placaOnibus').val();
    }

    if (campoVazio) {
        var n = noty({
            text: "Preencha todos os campos do formulário.",
            type: 'warning'
        });
    }

    if (!campoVazio) {
        var postData = {
            "idOnibus": id,
            "numeroOnibus": numero,
            "modeloOnibus": modelo,
            "placaOnibus": placa
        };

        $.ajax({
            url: "../actions/onibus_editar.php",
            type: "post",
            data: postData,
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == true) {
                    var n = noty({
                        text: "Ônibus atualizado com sucesso!",
                        type: 'success'
                    });

                    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'onibus');

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

var apagarOnibus = function (id) {
    var postData = {
        "idOnibus": id,
    };

    $.ajax({
        url: "../actions/onibus_apagar.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                var n = noty({
                    text: "Ônibus deletado com sucesso!",
                    type: 'success'
                });

                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'onibus');

            } else if (data.sendo_usado == true) {
                var n = noty({
                    text: 'Você não pode apagar um ônibus que está sendo usado em uma rota!',
                    type: 'error'
                });
            } else if (data.erro == true) {
                var n = noty({
                    text: 'Ocorreu um erro ao solicitar esta função no banco de dados. Contate o suporte!',
                    type: 'error'
                });
            }
        },
    });
}

var editarOnibus = function (id) {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'onibus/editar.php?id=' + id);
}