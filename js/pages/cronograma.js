var carregarTodasAsParadas = function () {
    $.ajax({
        url: "../actions/parada_carregarTodas.php",
        type: "get",
        dataType: 'json',
        success: function (data) {
            var obj = JSON.parse(JSON.stringify(data));
            var count = Object.keys(obj).length;
            var arrayParada = [];

            // pega todas as paradas cadastradas no banco que estão sendo usadas em rotas
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
                arrayParada.push(parada);
            }
        },
    });
}

var adicionarParadaCronograma = function () {
    $.ajax({
        url: "../actions/parada_carregarTodas.php",
        type: "get",
        dataType: 'json',
        success: function (data) {
            var obj = JSON.parse(JSON.stringify(data));
            var count = Object.keys(obj).length;
            var arrayParada = [];

            // pega todas as paradas cadastradas no banco que estão sendo usadas em rotas
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
                arrayParada.push(parada);
            }

            var i = 0;
            var htmlStr = '';
            htmlStr += '<tr class="odd gradeX">';
            htmlStr += '<td id="horario" width="75px" class="form-inline"><input class="form-control" type="time" id="horarioParada" style="padding-right: 10px"></td>';
            htmlStr += '<td>';
            htmlStr += '<select id="idParada" class="form-control">';
            for (i; i < arrayParada.length; i++) {
                htmlStr += '<option value="' + arrayParada[i].idParada + '">' + arrayParada[i].nomeParada + '</option>';
            }
            htmlStr += '</select>';
            htmlStr += '</td>';
            htmlStr += '<td>';
            htmlStr += '<select id="sentido" class="form-control">';
            htmlStr += '<option value="norte">Norte</option>';
            htmlStr += '<option value="sul">Sul</option>';
            htmlStr += '</td>';
            htmlStr += '<td>';
            htmlStr += '<button type="button" class="btn btn-danger btn-circle" onclick="$(this).closest(&#39;tr&#39;).remove();"><i class="fa fa-remove"></i></button>';
            htmlStr += '</td>';
            htmlStr += '</tr>';
            $('#tbodyTabelaParadas').append(htmlStr);
        },
    });
}

var salvarCronograma = function () {
    var dadosCronograma = [];
    var horario;
    var idParada;
    var sentido;
    var count = 0;
    $('#tbodyTabelaParadas tr').each(function () {
        $(this).find('td').each(function () {
            $(this).find('#horarioParada').each(function () {
                horario = $(this).val();
            });
            $(this).find('#idParada').each(function () {
                idParada = $(this).val();
            });
            $(this).find('#sentido').each(function () {
                sentido = $(this).val();
            });
        });
        dadosCronograma[count] = {"horario": horario, "idParada": idParada, "sentido": sentido};
        count++;
    });
    for (var y = 0; y < dadosCronograma.length; y++) {
        alert(dadosCronograma[y].horario);
        alert(dadosCronograma[y].idParada);
        alert(dadosCronograma[y].sentido);
    }
};