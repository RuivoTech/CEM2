$(document).ready(function () {
    link = "./";
    $("#proximo").next().hide();
    Verificar();
    if($("#divFiltrosPessoas").length){
        Select("tblMinisterios");
    }
    var ultimoBotao = "divTabela";
    $(".btnMenu").click(function () {
        var proximoBotao = $(this).val();
        if(ultimoBotao == $(this).val()){
            proximoBotao = "divTabela";
        }
        
        $("#" + ultimoBotao).hide();
        $("#" + proximoBotao).show();
        
        ultimoBotao = proximoBotao;
    });

    $.ajax({
        type: 'POST',
        url: link + "links.php",
        data: "session=" + sessionStorage.getItem("session"),
        success: function (data) {
            $(".menu").html(data);
        }
    });

    setTimeout(function () {
        $("#sair").attr("href", "#sair");
        $("#sair").click(function (event) {
            event.preventDefault();
            window.sessionStorage.removeItem("session");
            window.sessionStorage.removeItem("nivel");
            Verificar();
        });
    }, 100);

});
function Procura() {
    var form = $("#frmRelatorios").serializeArray();
    $.ajax({
        url: link + "relatorio.php",
        dataType: 'JSON',
        data: form,
        success: function (dados) {
            for (var el in dados) {
                var obj = dados[el];
                var keys = Object.keys(obj); //Returns array of keys
                $("#listTblBody").append("<tr id='listTblTr_" + dados[el].id + "'>");
                $("#listTblBody tr").addClass("tblItem");
                for (var i in keys) {
                    var key = keys[i];
                    if (obj[key] === null) {
                        $("#listTblTr_" + dados[el].id).append("<td></td>");
                    } else {
                        if (key.substring(0, 4) === "data") {

                            var data = obj[key].split("-");
                            var dat = data[2] + "/" + data[1] + "/" + data[0];
                            $("#listTblTr_" + dados[el].id).append("<td>" + dat + "</td>");
                            if ($("#tbl_idade").length) {
                                var idade = calculateAge(data[0] + "-" + data[1] + "-" + data[2]);
                                $("#listTblTr_" + dados[el].id).append("<td>" + idade + "</td>");
                            }
                        } else {
                            $("#listTblTr_" + dados[el].id).append("<td>" + obj[key] + "</td>");
                        }
                    }
                }
                /*if (!$("#tbl_idade").length) {
                 $("#listTblTr_" + dados[el].id).append('<td><button type="button" id="visualizarItem" value="' + dados[el].id + '">Visualizar</button>');
                 }*/
            }
        }
    });
}
function Verificar() {

    var negar = window.sessionStorage.getItem("session");
    var permissao = window.sessionStorage.getItem("permissao");
    if (permissao == 1) {
        $("body").hide();
        $("#mensagem").attr("class", "red");
        $("#mensagem").css({"display": "block", "top": "10px"});
        $("#mensagem").html("Você não tem permissão para acessar a página!!!");
        setTimeout(function () {
            $("#mensagem").fadeOut().empty();
        }, 3000);
        sessionStorage.removeItem("permissao");
    }
    if (!negar) {
        $("body").hide();
        window.sessionStorage.setItem("negar", "1");
        window.location = "./";
    } else {
        $.ajax({
            type: 'POST',
            url: link + "verificar.php",
            dataType: 'JSON',
            data: "session=" + negar + "&page=" + $("body").attr("id"),
            success: function (data) {
                if (data.logado === 0) {
                    window.location = "./";
                } else if (data.logado === 2) {
                    window.sessionStorage.setItem("permissao", "1");
                    window.location = "./home.php";
                } else {
                    $("body").show();
                    $("#nomeMenu").html(data.nomeMenu);
                }
            }
        });
    }
}
function Select(btn) {
    $.ajax({
        url: link + "selecionar.php",
        type: 'POST',
        dataType: 'JSON',
        data: "btn=" + btn + "&lista=*&session=" + window.sessionStorage.getItem("session"),
        success: function (data) {
            var count = 1;
            for (var elemento in data) {
                if (btn == "tblMinisterios") {
                    $("#ministerios").append("<input type=\"checkbox\" name=\"ministerios\" value=\"" + data[elemento].id + "\" id=\"min_" + +data[elemento].id + "\" /><label for=\"min_" + data[elemento].id + "\" title=\"" + data[elemento].descricao + "\">" + data[elemento].nome + "</label>");
                    $("label[for='min_" + data[elemento].id + "'").css({"clear": "none"});
                    if (count == 9) {
                        $("label[for=min_" + data[elemento].id + "]").after("<br />");
                        count = 0;
                    }
                    //alert(count);
                    count++;
                } else if (btn == "tblNivel" | btn == "tblMenu") {
                    if ($("#usuarios").length) {
                        $("#nivel").append("<option value=\"" + data[elemento].id + "\" title=\"" + data[elemento].descricao + "\">" + data[elemento].nome + "</option>")
                    } else if (btn == "tblMenu") {
                        $("#menuIdPai").append("<option value=\"" + data[elemento].id + "\">" + data[elemento].nome + "</option>")
                    } else {
                        $("#nivel").append("<input type=\"checkbox\" name=\"idNivel\" value=\"" + data[elemento].id + "\" id=\"nivel_" + +data[elemento].id + "\" /><label for=\"nivel_" + data[elemento].id + "\" title=\"" + data[elemento].descricao + "\">" + data[elemento].nome + "</label>");
                        if (count == 9) {
                            $("label[for=nivel_" + data[elemento].id + "]").after("<br />");
                            count = 0;
                        }
                        //alert(count);
                        count++;
                    }
                }

            }
        }
    });
}