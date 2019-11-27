<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscrições - CEM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./cem.png" type="image/x-icon" />
        <link rel="shortcut icon" href="cem.png" type="image/x-icon" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script src="js/jquery.easy-autocomplete.js"></script>
        <script type="text/javascript" src="js/funcoes.js"></script>
        <script src="js/jquery.mask.js"></script>
        <link rel="stylesheet" href="css/easy-autocomplete.css"> 
        <link href="css/estilo.css" rel="stylesheet" type="text/css" />
        <link href="css/links.css" rel="stylesheet" type="text/css" />
        
    </head>
    <body id="inscricoes">
        <input type="checkbox" id="bt_menu" />
        <label for="bt_menu">&#9776;</label>
        <nav class="menu"></nav>
        <div class="subMenu">
            <nav>
                <button type="button" id="btnListar" value="tblInscricoes" class="btnMenu">Mostrar Inscrições</button>
            </nav>
        </div>
        <div class="container">
            <div id="divTable">
                <label for="pesquisaTbl">Procurar:</label>
                <select name="eventos" id="eventos">
                </select>
                <button type="button" name="btnSelecionar" id="btnSelecionar">Selecinar</button>
                <table id="tblLista">
                    <thead id="listTblHead">
                        <tr>
                            <th id="tbl_id">ID</th>
                            <th id="tbl_nome">Nome</th>
                            <th id="tbl_email">E-mail</th>
                            <th id="tbl_telefone">Telefone</th>
                            <th id="tbl_pago">Pago</th>
                            <th id="tbl_descricao">Evento</th>
                            <th id="acoes">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="listTblBody">
                    </tbody>
                </table>
            </div>
            <div id="divFrm">
                <form action="./registrar.php" method="POST" id="frmInscricoes" autocomplete="off">
                    <fieldset>
                        <label for="id">ID:</label>
                        <input type="text" name="id" id="id" disabled size="5" /><br />
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" size="60" autofocus required /><br>
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" size="60" /><br>
                        <label for="celular">Telefone:</label>
                        <input type="text" name="celular" id="celular" /><br>
                        <label for="idEvento">Evento:</label>
                        <select name="idEvento" id="idEvento">
                		</select><br>
                        <label for="pago">Pago:</label><br>
                        <input type="radio" name="pago" id="pago_1" value="1" /><label for="pago_1">Sim</label><br />
                        <input type="radio" name="pago" id="pago_0" value="0" /><label for="pago_0">Não</label><br>
                    </fieldset>
                    <button type="button" name="gravar" value="inscricoes" id="btnGravar">Gravar</button>
                    <button type="button" name="editar" value="inscricoes" id="btnEditar">Editar</button>
                    <button type="reset" name="limpar" value="limpar" id="btnLimpar">Limpar</button>
                </form>
                <p id="mensagem"></p>
            </div>
        </div>
        <div id="proximo"></div>
    </body>
</html>