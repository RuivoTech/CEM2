$(document).ready(function () {
    link = "./";
    $("#proximo").next().hide();
    Verificar();
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

    var arr = $.map($('#listTblHead th'), function (el, i) {
        if($('#listTblHead th:eq(' + i + ')').attr("id") === "acoes"){
        }else{
           return [[$('#listTblHead th:eq(' + i + ')').attr("id").replace(/tbl_/g, '')]];
        }
    });
    if ($("#home").length) {
        Listar("tblMembros", arr, "");
    }
    if ($("#logs").length) {
        Listar("tblLogs", arr, "");
    }
    if ($("#membros").length | $("#relatorios").length) {
        Select("tblMinisterios");
    }
    if ($("#usuarios").length) {
        Select("tblNivel");
    }
    if ($("#menu").length) {
        Select("tblMenu");
        setTimeout(function () {
            Select("tblNivel");
        }, 300);
    }
    $("#estadoCivil").change(function () {
        if ($(this).val() == 2) {
            $("#nomeEspos").attr("disabled", false);
        } else {
            $("#nomeEspos").attr("disabled", true);
            $("#nomeEspos").val("");
            $("#idEspos").val("");
        }
    });
    $("input").attr("autocomplete", "off");
    $("#btnGravar").click(function () {
        Enviar("#btnGravar");
    });
    $("#btnEditar").click(function () {
        Enviar("#btnEditar");
    });
    $("#btnListar").click(function () {
        $("#divTable").toggle();
        var btnListar = $("#btnListar").val().replace(/tbl/g, '');
        if ($("#divTable").is(":visible")) {
            $("#btnListar").html("Cadastrar " + btnListar);
        } else {
            $("#btnListar").html("Mostrar " + btnListar);
        }
        $("#divFrm").toggle();
        $("#listTblBody").empty();
        if ($("#divTable").length) {
            Listar($(this).val(), arr, "");
        }
    });
    $("#listTblBody").delegate('tr', 'click', function () {
        $('form').each(function () {
            this.reset();
            var btnListar = $("#btnListar").val().replace(/tbl/g, '');
            $("#btnListar").html("Mostrar " + btnListar);
            $("input[name=ministerios]").prop('checked', $(this).prop('false'));
        });
        Selecionar($("#btnListar").val(), "*_todos", $(this).attr("id").replace(/listTblTr_/g, ''));
        //get <td> element values here!!??
    });
    $("#pesquisaTbl").keyup(function () {
        $("#listTblBody").empty();
        Listar($("#btnListar").val(), arr, $(this).val());
    });
    var options = {

        url: function (phrase) {
            return link + "selecionar.php";
        },
        getValue: "nome",
        template: {
            type: "custom",
            method: function (value, item) {
                return item.id + " - " + value + " (" + item.email + ")";
            }
        },
        list: {
            onSelectItemEvent: function () {

                var id = $(".selecionarNome").getSelectedItemData().id;
                $(".selecionarId").val(id).trigger("change");
            }
        },
        ajaxSettings: {
            dataType: "json",
            method: "POST",
            data: {

            }
        },
        preparePostData: function (data) {
            data.btn = "tblDizimos";
            data.lista = "id,nome,email";
            data.val = $(".selecionarNome").val();
            data.session = window.sessionStorage.getItem("session");
            return data;
        },
        requestDelay: 400
    };
    $(".selecionarNome").easyAutocomplete(options);
    $("#todosMinisterios").click(function () {
        $("input[name=ministerios]").prop('checked', $(this).prop('checked'));
    });
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
    }

//Quando o campo cep perde o foco.
    $("#cep").blur(function () {

//Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');
        //Verifica se campo cep possui valor informado.
        if (cep != "") {

//Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if (validacep.test(cep)) {

//Preenche os campos com "..." enquanto consulta webservice.
                $("#endereco").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#endereco").val(dados.logradouro);
                        $("#uf").val(dados.uf);
                        $("#cidade").val(dados.localidade);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        $("#mensagem").attr("class", "red");
                        $("#mensagem").css({"display": "block"});
                        $("#mensagem").html("Formato de CEP inválido.");
                    }
                });
            } //end if.
            else {
//cep é inválido.
                limpa_formulário_cep();
                $("#mensagem").attr("class", "red");
                $("#mensagem").css({"display": "block"});
                $("#mensagem").html("Formato de CEP inválido.");
            }
        } //end if.
        else {
//cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });

    $("#rg").mask("00.000.000-0");
    $("input[name=telefone]").mask("(00) 0000-0000");
    $("input[name=celular]").mask("(00) 00000-0000");
    $("#cep").mask("00000-000");
    $(".money").mask("#.##0,00", {reverse: true});
});
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
function Enviar(btn) {
    var ids = [];
    $('input:checked').each(function (i, e) {
        ids.push($(this).val());
    });
    var formData = $(btn).parent("form").serializeArray();
    if (btn == "#btnEditar" && ($("#idEspos").length | $("#idMembro").length)) {
        formData.push({name: "id", value: $("#id").val()}, {name: "idEspos", value: $("#idEspos").val()}, {name: "session", value: window.sessionStorage.getItem("session")});
    }
    if ($("input[name=idMembro]").length) {
        formData.push({name: "idMembro", value: $("#idMembro").val()}, {name: "session", value: window.sessionStorage.getItem("session")});
    }
    if ($("#frmNivel").length | $("#frmUsuarios").length | $("#frmMinisterios").length) {
        formData.push({name: "id", value: $("#id").val()});
    }
    if($("#ministerios").length){
        var name = "ministerios";
    }else if($("#menu").length){
        formData.push({name: "menuId", value: $("#id").val()});
        var name = "idNivel";
    }
    formData.push({name: "btn", value: $(btn).attr("name")}, {name: $(btn).attr("name"), value: $(btn).val()}, {name: name, value: ids}, {name: "session", value: window.sessionStorage.getItem("session")});
    $.ajax({
        async: false,
        url: link + $(btn).parent("form").attr("action"),
        type: "POST",
        data: formData,
        dataType: "JSON",
        success: function (dados) {
            if (dados.verifica === 0) {
                $("#mensagem").attr("class", "green");
                $("#mensagem").css({"display": "block"});
                $("#mensagem").html(dados.mensagem);
                setTimeout(function () {
                    $("#mensagem").fadeOut().empty();
                }, 3000);
            } else {
                $("#mensagem").attr("class", "red");
                $("#mensagem").css({"display": "block"});
                $("#mensagem").html(dados.mensagem);
                setTimeout(function () {
                    $("#mensagem").fadeOut().empty();
                }, 3000);
            }
            $("form").reset();
        }
    });
}
function Listar(btnValue, arr, val) {

    $.ajax({
        async: false,
        type: "POST",
        dataType: 'JSON',
        data: "btn=" + btnValue + "&lista=" + arr + "&val=" + val + "&session=" + window.sessionStorage.getItem("session"),
        cache: false,
        url: link + "selecionar.php",
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
                $("#listTblTr_" + dados[el].id).append("<td><button type='button' class='delete' name='Excluir' value='" + dados[el].id + "'>Excluir</button></td>");
                /*if (!$("#tbl_idade").length) {
                 $("#listTblTr_" + dados[el].id).append('<td><button type="button" id="visualizarItem" value="' + dados[el].id + '">Visualizar</button>');
                 }*/
            }
        }
    });
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
function calculateAge(dobString) {
    var dob = new Date(dobString);
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    var birthdayThisYear = new Date(currentYear, dob.getMonth(), dob.getDate());
    var age = currentYear - dob.getFullYear();
    if (birthdayThisYear > currentDate) {
        age--;
    }
    if (!age) {
        return "Erro!";
    } else {
        return age;
    }
}
function Selecionar(btnValue, arr, val) {
    $.ajax({
        async: false,
        type: 'POST',
        url: link + "selecionar.php",
        data: "btn=" + btnValue + "&lista=" + arr + "&val=" + val + "&session=" + window.sessionStorage.getItem("session"),
        dataType: 'JSON',
        success: function (dados) {
            for (var el in dados) {
                var obj = dados[el];
                var keys = Object.keys(obj);
                for (var i in keys) {
                    var key = keys[i];
                    if ($("#" + key + "_1").val() == obj[key]) {
                        $("#" + key + "_1").prop("checked", true);
                    } else {
                        $("#" + key + "_0").prop("checked", true);
                    }
                    if ((key == "ministerios" | key == "idNivel") && obj[key]) {
                        var separar = obj[key].split(",");
                        for (var i = 0; i <= separar.length; i++) {
                            if (key == "ministerios") {
                                $("#min_" + separar[i]).prop("checked", true);
                            } else if (key == "idNivel") {
                                $("#nivel_" + separar[i]).prop("checked", true);
                            }
                        }
                    }
                    $("#" + key).val(obj[key]);
                }
            }
            $("#divTable").toggle();
            $("#divFrm").toggle();
        }
    });
}