var salvarRota = function () {
    var nomeRota = $('#nomeRota').val();
    var sentidoRota = $('#sentidoRota').val();
    var idOnibus = $('#idOnibus').val();

    $.ajax({
        url: "../actions/rota_inserir.php",
        type: "post",
        data: {nomeRota: nomeRota, idOnibus: idOnibus, sentidoRota: sentidoRota},
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                var sucesso = false;
                for (var i = 0; i < $('#tabelaDataTable tr').length; i++) {
                    if (salvarParadaNaRota(i)) {
                        var sucesso = true;
                    }
                }
                if (sucesso) {
                    notificacao('success', 'Rota cadastrada com sucesso!');
                }
            } else if (data.existente == true) {
                notificacao('warning', 'O nome digitado já existe!');
            } else if (data.erro == true) {
                notificacao('error', 'Ocorreu um erro ao inserir esta informação no banco de dados. Contate o suporte!');
            }
        },
    });

    var ultimaIDRota;
    $.ajax({
        url: "../actions/rota_ultimoID.php",
        type: "get",
        dataType: 'json',
        success: function (data) {
            ultimaIDRota = data;
        },
    });

    var salvarParadaNaRota = function (i) {
        var idParada = $('#idParada' + i).val();
        var horarioParada = $('#horarioParada').val();

        $.ajax({
            url: "../actions/rota_inserir_parada.php",
            type: "post",
            data: {idRota: ultimaIDRota, idParada: idParada, horario: horarioParada},
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == true) {
                    
                    return true;
                } else if (data.existente == true) {
                    var n = noty({
                        text: 'O nome digitado já existe!',
                        type: 'warning'
                    });
                    return false;
                } else if (data.erro == true) {
                    var n = noty({
                        text: 'Ocorreu um erro ao inserir esta informação no banco de dados. Contate o suporte!',
                        type: 'error'
                    });
                    return false;
                }
            },
        });
    }

    var inputCount = $('#inputsHorarios input').length;
    var inputPreenchido = 0;
    var dados = [];
    for (var i = 0; i < inputCount; i++) {
        if ($('#horarioParada' + i).val() != "") {
            inputPreenchido++;
            var rotaP = rotaParada();
            rotaP.horario = $('#horarioParada' + i).val();
            rotaP.id_bus_parada = $('#idParada' + i).val();
            dados.push(rotaP);
        }
    }

    $.ajax({
        url: "../actions/rota_inserir.php",
        type: "post",
        data: {ds: JSON.stringify(dados), qt: inputPreenchido, nr: nomeRota, io: idOnibus, po: periodoRota},
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                var n = noty({
                    text: "Rota cadastrada com sucesso!",
                    type: 'success'
                });

                // Limpa os inputs
                $('#nomeRota').val("");
                for (var i = 0; i < inputCount; i++) {
                    $('#horarioParada' + i).val("");
                }

            } else if (data.existente == true) {
                var n = noty({
                    text: 'O nome digitado já existe!',
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