<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Menu - CEM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./cem.png" type="image/x-icon" />
        <link rel="shortcut icon" href="cem.png" type="image/x-icon" />
        <link href="css/estilo.css" rel="stylesheet" type="text/css" />
        <link href="css/links.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/funcoes.js"></script>
    </head>
    <body id="menu">
        <input type="checkbox" id="bt_menu" />
        <label for="bt_menu">&#9776;</label>
        <nav class="menu"></nav>
        <div class="subMenu">
            <nav>
                <button type="button" id="btnListar" value="tblMenu" class="btnMenu">Mostrar Menu</button>
            </nav>
        </div>
        <div class="container">
            <div id="divTable">
                <label for="pesquisaTbl">Procurar:</label>
                <input type="text" name="pesquisa" id="pesquisaTbl" value="" size="90" /><br />
                <table id="tblLista">
                    <thead id="listTblHead">
                        <tr>
                            <th id="tbl_menuId">ID</th>
                            <th id="tbl_menuNome">Nome</th>
                            <th id="tbl_menuLink">Link</th>
                            <!--<th id="tbl_acoes">Ações</th> -->
                        </tr>
                    </thead>
                    <tbody id="listTblBody">
                    </tbody>
                </table>
            </div>
            <div id="divFrm">
                <form action="./registrar.php" method="POST" id="frmMenu">
                    <fieldset>
                        <label for="id">ID:</label>
                        <input type="text" name="menuId" id="id" size="5" disabled /><br />
                        <label for="nome">Nome:</label>
                        <input type="text" name="menuNome" id="nome" size="50" autofocus required />
                        <label for="subMenu">Sub-Menu:</label>
                        <select name="menuIdPai" id="menuIdPai" required>
                            <option value="0">Escolha...</option>
                        </select><br />
                        <label for="link">Link:</label>
                        <input type="text" name="menuLink" id="menuLink" required /><br />
                        <label for="nivel">Nível:</label><br />
                        <fieldset id="nivel">
                        </fieldset>
                        
                        <!--<input type="checkbox" name="nivel[0]" id="nivel_0" value="0" /><label for="nivel_0">Admin</label>
                        <input type="checkbox" name="nivel[1]" id="nivel_1" value="1" /><label for="nivel_1">Moderador</label>
                        <input type="checkbox" name="nivel[2]" id="nivel_2" value="2" /><label for="nivel_2">Financeiro</label>
                        <input type="checkbox" name="nivel[3]" id="nivel_3" value="3" /><label for="nivel_3">Padrão</label>-->
                    </fieldset>
                    <button type="button" name="gravar" value="menu" id="btnGravar">Gravar</button>
                    <button type="button" name="editar" value="menu" id="btnEditar">Editar</button>
                    <button type="reset" name="limpar" value="limpar" id="btnLimpar">Limpar</button>
                </form>
                <p id="mensagem"></p>
            </div>
        </div>
        <div id="proximo"></div>
    </body>
</html>
