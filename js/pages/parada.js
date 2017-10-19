var lastMarker;
var map;

function initMapNovaParada() {
    // Create a map object and specify the DOM element for display.
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -28.294883, lng: -54.257709},
        zoom: 14
    });

    function setarMarcador(posicao) {
        lastMarker = new google.maps.Marker({
            position: posicao,
            map: map,
            icon: '../imagens/bus-icon.png'
        });
    }

    google.maps.event.addListener(map, 'click', function (event) {

        if (lastMarker != null) {
            lastMarker.setMap(null);
        }

        setarMarcador(event.latLng);

        $('#coordenadasParada').val(event.latLng); // coloca as coordenadas dentro do input
        var coordenadas = String(event.latLng);
        var coordenadasAjustadas = coordenadas.replace(/[\s()]/g, ""); // tira espaço e parenteses das cordenadas
        $.ajax({
            url: "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + coordenadasAjustadas + "&sensor=true",
            type: "get",
            dataType: 'json',
            success: function (data) {
                var obj = JSON.parse(JSON.stringify(data));
                var numero_endereco = JSON.stringify(obj.results[0].address_components[0].long_name);
                var nome_endereco = JSON.stringify(obj.results[0].address_components[1].long_name);
                var numero_endereco = numero_endereco.replace(/["]/g, "");
                var nome_endereco = nome_endereco.replace(/["]/g, "");
                $('#localizacaoParada').val(nome_endereco + ", " + numero_endereco);
            },
        });
    });


}

function resizeMap() {
    window.setTimeout(function () {
        var center = map.getCenter();
        google.maps.event.trigger(map, 'resize');
        map.setCenter(center);
    }, 300);
}

function initMapEditarParada() {
    var position;
    var coordenadas = $('#coordenadasParada').val();
    var coordenadasAjustadas = coordenadas.replace(/[\s()]/g, "");
    var index = coordenadasAjustadas.indexOf(",");
    var lat = parseFloat(coordenadasAjustadas.substr(0, index));
    var lng = parseFloat(coordenadasAjustadas.substr(index + 1));
    position = {lat: lat, lng: lng};

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map'), {
        center: position,
        zoom: 18
    });

    function setarMarcador(posicao) {
        lastMarker = new google.maps.Marker({
            position: posicao,
            map: map,
            icon: '../imagens/bus-icon.png'
        });
    }

    setarMarcador(position);

    google.maps.event.addListener(map, 'click', function (event) {

        if (lastMarker != null) {
            lastMarker.setMap(null);
        }

        setarMarcador(event.latLng);

        $('#coordenadasParada').val(event.latLng); // coloca as coordenadas dentro do input
        var coordenadas = String(event.latLng);
        var coordenadasAjustadas = coordenadas.replace(/[\s()]/g, ""); // tira espaço e parenteses das cordenadas
        $.ajax({
            url: "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + coordenadasAjustadas + "&sensor=true",
            type: "get",
            dataType: 'json',
            success: function (data) {
                var obj = JSON.parse(JSON.stringify(data));
                var numero_endereco = JSON.stringify(obj.results[0].address_components[0].long_name);
                var nome_endereco = JSON.stringify(obj.results[0].address_components[1].long_name);
                var numero_endereco = numero_endereco.replace(/["]/g, "");
                var nome_endereco = nome_endereco.replace(/["]/g, "");
                $('#localizacaoParada').val(nome_endereco + ", " + numero_endereco);
            },
        });
    });
}

var salvarParada = function () {
    var campoVazio = false;
    if ($('#nomeParada').val() == "") {
        campoVazio = true;
    } else {
        var nome = $('#nomeParada').val();
    }
    if ($('#localizacaoParada').val() == "") {
        campoVazio = true;
    } else {
        var localizacao = $('#localizacaoParada').val();
    }
    if ($('#coordenadasParada').val() == "") {
        campoVazio = true;
    } else {
        var coordenadas = $('#coordenadasParada').val();
        var coordenadasAdj = coordenadas.replace(/[\s()]/g, "");
    }

    if (campoVazio) {
        var n = noty({
            text: "Preencha todos os campos do formulário.",
            type: 'warning'
        });
    }

    if (!campoVazio) {
        var postData = {
            "nomeParada": nome,
            "localizacaoParada": localizacao,
            "coordenadasParada": coordenadasAdj
        };

        $.ajax({
            url: "../actions/parada_inserir.php",
            type: "post",
            data: postData,
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == true) {
                    var n = noty({
                        text: "Parada cadastrada com sucesso!",
                        type: 'success'
                    });

                    // Limpa os inputs
                    $('#nomeParada').val("");
                    $('#localizacaoParada').val("");
                    $('#coordenadasParada').val("");

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
}

var salvarParadaNaRota = function () {
    var campoVazio = false;
    if ($('#nomeParada').val() == "") {
        campoVazio = true;
    } else {
        var nome = $('#nomeParada').val();
    }
    if ($('#localizacaoParada').val() == "") {
        campoVazio = true;
    } else {
        var localizacao = $('#localizacaoParada').val();
    }
    if ($('#coordenadasParada').val() == "") {
        campoVazio = true;
    } else {
        var coordenadas = $('#coordenadasParada').val();
        var coordenadasAdj = coordenadas.replace(/[\s()]/g, "");
    }

    if (campoVazio) {
        var n = noty({
            text: "Preencha todos os campos do formulário.",
            type: 'warning'
        });
    }

    if (!campoVazio) {
        var postData = {
            "nomeParada": nome,
            "localizacaoParada": localizacao,
            "coordenadasParada": coordenadasAdj
        };

        $.ajax({
            url: "../actions/parada_inserir.php",
            type: "post",
            data: postData,
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == true) {
                    var n = noty({
                        text: "Parada cadastrada com sucesso!",
                        type: 'success'
                    });

                    // Limpa os inputs
                    $('#nomeParada').val("");
                    $('#localizacaoParada').val("");
                    $('#coordenadasParada').val("");

                    montaDTParadas();
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
}

var montaDTParadas = function () {
    $.ajax({
        url: "../actions/parada_carregarTodas.php",
        type: "get",
        dataType: 'json',
        success: function (data) {
            var obj = JSON.parse(JSON.stringify(data));
            var count = Object.keys(obj).length;
            var tabelaDeParadas = $('#tabelaDeParadas');
            var arrayParadas = [];

            for (var i = 0; i < count; i++) {
                var idParada = obj[i].id;
                var nomeParada = obj[i].nome;
                var localizacaoParada = obj[i].localizacao;
                var coordenadasParada = obj[i].coordenadas;
                var sendoUsadaParada = obj[i].sendo_usada;
                var parada = {
                    idParada: idParada,
                    nomeParada: nomeParada,
                    localizacaoParada: localizacaoParada,
                    coordenadasParada: coordenadasParada,
                    sendoUsadaParada: sendoUsadaParada
                };
                arrayParadas.push(parada);
            }

            var htmlStr = '';
            htmlStr += '<table id="tabelaDataTable" class="display nowrap dataTable dtr-inline">';
            htmlStr += '<thead>';
            htmlStr += '<tr>';
            htmlStr += '<th>Horário</th>';
            htmlStr += '<th>Nome</th>';
            htmlStr += '<th>Localização</th>';
            htmlStr += '<th>Opções</th>';
            htmlStr += '</tr>';
            htmlStr += '</thead>';
            htmlStr += '<tbody id="tbodyTabelaParadas">';
            for (var count = 0; count < arrayParadas.length; count++) {
                htmlStr += '<tr class="odd gradeX" id="' + arrayParadas[count].idParada + '">';
                htmlStr += '<td id="inputsHorarios" width="75px" class="form-inline"><input class="form-control" type="time" id="horarioParada" style="padding-right: 10px"></td>';
                htmlStr += '<td>' + arrayParadas[count].nomeParada + '</td>';
                htmlStr += '<td>' + arrayParadas[count].localizacaoParada + '</td>';
                htmlStr += '<td>';
                htmlStr += '<button type="button" class="btn btn-primary btn-circle" onclick="editarParada(' + arrayParadas[count].idParada + ')"><i class="fa fa-eye"></i></button>\n';
                htmlStr += '<button type="button" class="btn btn-danger btn-circle" onclick="apagarParadaNaRota(' + arrayParadas[count].idParada + ');$(this).closest(&#39;tr&#39;).remove();"><i class="fa fa-remove"></i></button>';
                htmlStr += '</td>';
                htmlStr += '</tr>';
            }
            htmlStr += '</tbody>';
            htmlStr += '</table>';
            tabelaDeParadas.html(htmlStr);
            ativarDataTable();
        },
    });
}

var salvarParadaEditada = function (id) {
    var campoVazio = false;
    if ($('#nomeParada').val() == "") {
        campoVazio = true;
    } else {
        var nome = $('#nomeParada').val();
    }
    if ($('#localizacaoParada').val() == "") {
        campoVazio = true;
    } else {
        var localizacao = $('#localizacaoParada').val();
    }
    if ($('#coordenadasParada').val() == "") {
        campoVazio = true;
    } else {
        var coordenadas = $('#coordenadasParada').val();
    }

    if (campoVazio) {
        var n = noty({
            text: "Preencha todos os campos do formulário.",
            type: 'warning'
        });
    }

    if (!campoVazio) {
        var postData = {
            "idParada": id,
            "nomeParada": nome,
            "localizacaoParada": localizacao,
            "coordenadasParada": coordenadas
        };

        $.ajax({
            url: "../actions/parada_editar.php",
            type: "post",
            data: postData,
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == true) {
                    var n = noty({
                        text: "Parada atualizada com sucesso!",
                        type: 'success'
                    });

                    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'paradas');

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

var apagarParada = function (id) {
    var postData = {
        "idParada": id,
    };

    $.ajax({
        url: "../actions/parada_apagar.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                var n = noty({
                    text: "Parada deletada com sucesso!",
                    type: 'success'
                });

                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'paradas');

            } else if (data.sendo_usada == true) {
                var n = noty({
                    text: 'Você não pode apagar uma parada que está sendo usada em uma rota!',
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

var apagarParadaNaRota = function (id) {
    var postData = {
        "idParada": id,
    };

    $.ajax({
        url: "../actions/parada_apagar.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                var n = noty({
                    text: "Parada deletada com sucesso!",
                    type: 'success'
                });
            } else if (data.sendo_usada == true) {
                var n = noty({
                    text: 'Você não pode apagar uma parada que está sendo usada em uma rota!',
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

var editarParada = function (id) {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'paradas/editar.php?id=' + id);
}

