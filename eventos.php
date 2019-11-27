<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Eventos - CEM</title>
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
    <body id="eventos">
        <input type="checkbox" id="bt_menu" />
        <label for="bt_menu">&#9776;</label>
        <nav class="menu"></nav>
        <div class="subMenu">
            <nav>
                <button type="button" id="btnListar" value="tblEventos" class="btnMenu">Mostrar Eventos</button>
            </nav>
        </div>
        <div class="container">
            <div id="divTable">
                <label for="pesquisaTbl">Procurar:</label>
                <input type="text" name="pesquisa" id="pesquisaTbl" value="" size="90" /><br />
                <table id="tblLista">
                    <thead id="listTblHead">
                        <tr>
                            <th id="tbl_id">ID</th>
                            <th id="tbl_descricao">Descrição</th>
                            <th id="tbl_dataInicio">Data Inicio</th>
                            <th id="tbl_dataFim">Data Fim</th>
                            <th id="tbl_valor">Valor</th>
                            <th id="tbl_ativo">Ativo</th>
                            <th id="acoes">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="listTblBody">
                    </tbody>
                </table>
            </div>
            <div id="divFrm">
                <form action="./registrar.php" method="POST" id="frmEventos" autocomplete="off">
                    <fieldset>
                        <label for="id">ID:</label>
                        <input type="text" name="id" id="id" disabled size="5" /><br />
                        <label for="descricao">Nome:</label>
                        <input type="text" name="descricao" id="descricao" size="60" autofocus required /><br>
                        <label for="ativo">Ativo:</label><br>
                        <input type="radio" name="ativo" id="ativo_1" value="1" /><label for="ativo_1">Sim</label><br />
                        <input type="radio" name="ativo" id="ativo_0" value="0" /><label for="ativo_0">Não</label><br>
                        <label for="dataInicio">Data Inicio:</label>
                        <input type="date" name="dataInicio" id="dataInicio" />
                        <label for="dataFim">Data Fim:</label>
                        <input type="date" name="dataFim" id="dataFim" /><br>
                        <label for="valor">Valor:</label>
                        <input type="text" name="valor" id="valor" class="money" placeholder="0,00" />
                    </fieldset>
                    <button type="button" name="gravar" value="eventos" id="btnGravar">Gravar</button>
                    <button type="button" name="editar" value="eventos" id="btnEditar">Editar</button>
                    <button type="reset" name="limpar" value="limpar" id="btnLimpar">Limpar</button>
                </form>
                <p id="mensagem"></p>
            </div>
        </div>
        <div id="proximo"></div>
    </body>
</html>