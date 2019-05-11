<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio - CEM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./cem.png" type="image/x-icon" />
        <link rel="shortcut icon" href="cem.png" type="image/x-icon" />
        <link href="css/estilo.css" rel="stylesheet" type="text/css" />
        <link href="css/links.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.js"></script>
        <script src="js/funcoes.js"></script>
    </head>
    <body id="logs">
        <input type="checkbox" id="bt_menu" />
        <label for="bt_menu">&#9776;</label>
        <nav class="menu"></nav>
        <div class="subMenu"><p id="mensagem"></p></div>
        <div class="container">
            <table id="tblLista">
                <thead id="listTblHead">
                    <tr>
                        <th id="tbl_id">ID</th>
                        <th id="tbl_nome">Nome</th>
                        <th id="tbl_ip">IP</th>
                        <th id="tbl_hora">Hora</th>
                        <th id="tbl_mensagem">Mensagem</th>
                    </tr>
                </thead>
                <tbody id="listTblBody">
                </tbody>
            </table>
        </div>
        <div id="proximo"></div>
    </body>
</html>
