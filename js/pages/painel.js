var localhost = "/~matheuscavallini/busroute/adm/";

var notificacao = function (tipo, mensagem) {
    var n = noty({
        text: mensagem,
        type: tipo
    });
}

$(document).ready(function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'index/home.php');
});

var menuSidebar_painel_inicio = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'index/home.php');
}

var menuSidebar_cronogramas_ver = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'cronogramas');
}

var menuSidebar_cronogramas_novo = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'cronogramas/novo.php');
}

var menuSidebar_paradas_ver = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'paradas');
}

var menuSidebar_paradas_novo = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'paradas/novo.php');
}

var menuSidebar_onibus_ver = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'onibus');
}

var menuSidebar_onibus_novo = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'onibus/novo.php');
}

var menuSidebar_usuarios_ver = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'usuarios');
}

var menuSidebar_usuarios_novo = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'usuarios/novo.php');
}

var menuSidebar_levels_ver = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'levels');
}

var menuSidebar_levels_novo = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'levels/novo.php');
}

var ativarDataTable = function () {
    $('#tabelaDataTable').DataTable();
    $('#tabelaDataTable').DataTable({"iDisplayLength": 25, retrieve: true});
    $('div.dataTables_filter input').addClass('form-control-searchbox');
    $('div.dataTables_filter input').attr("placeholder", "Pesquisar...");
    $('div.dataTables_length select').addClass('form-control-datatable');
}