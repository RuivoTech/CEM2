$(document).ready(function () {
    $("#proximo").next().hide();
    Verificar();
    $('#frmLogin').submit(function () { 	//Ao submeter formulário
        $.ajax({//Função AJAX
            url: "login.php", //Arquivo php
            type: "post", //Método de envio
            data: $("#frmLogin").serializeArray(), //Dados
            dataType: "JSON",
            success: function (result) {			//Sucesso no AJAX
                if (result.verifica == 1) {
                    $("#mensagem").attr("class", "green");
                    $('#mensagem').css({"display": "block"});		//Informa o erro
                    sessionStorage.setItem("session", result.session);
                    sessionStorage.setItem("nivel", result.nivel);
                    window.sessionStorage.removeItem("negar");
                    setTimeout(function () {
                        location.href = result.local;	//Redireciona
                    }, 3000);
                    $("#mensagem").html(result.mensagem);
                } else {
                    $("#mensagem").attr("class", "red");
                    $('#mensagem').css({"display": "block"});		//Informa o erro
                    setTimeout(function () {
                        $("#mensagem").fadeOut().empty();
                    }, 3000);
                    $("#mensagem").html(result.mensagem);
                }
            }
        });
        return false;	//Evita que a página seja atualizada
    });
});

function Verificar() {
    if (window.sessionStorage.getItem("negar") == 1) {
        $("#mensagem").attr("class", "red");
        $('#mensagem').css({"display": "block"});
        $("#mensagem").html("Acesso negado!!!");
    }
}