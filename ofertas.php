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
        <link rel="stylesheet" href="css/easy-autocomplete.css"> 
        <script type="text/javascript" src="js/jquery.js"></script>
        <script src="js/jquery.easy-autocomplete.js"></script>
        <script type="text/javascript" src="js/funcoes.js"></script>
        <script src="js/jquery.mask.js"></script>
    </head>
    <body id="ofertas">
        <input type="checkbox" id="bt_menu" />
        <label for="bt_menu">&#9776;</label>
        <nav class="menu"></nav>
        <div class="subMenu">
            <nav>
                <button type="button" id="btnListar" value="tblOfertas" class="btnMenu">Mostrar Ofertas</button>
            </nav>
        </div>
        <div class="container">
            <div id="divTable">
                <label for="pesquisaTbl">Procurar:</label>
                <input type="text" name="pesquisa" id="pesquisaTbl" value="" size="90" /><br />
                <table id="tblListas">
                    <thead id="listTblHead">
                        <tr>
                            <th id="tbl_id">ID</th>
                            <th id="tbl_valorOferta">Oferta</th>
                            <th id="tbl_dataOferta">Data</th>
                            <th id="acoes">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="listTblBody">
                    </tbody>
                </table>
            </div>
            <div id="divFrm">
                <form action="./registrar.php" method="POST" id="frmFinanceiro">
                    <fieldset>
                        <label for="dataOferta">Data Oferta:</label>
                        <input type="date" name="dataOferta" id="dataOferta" required /><br />
                        <label for="valorOferta">Valor Oferta:</label>
                        <input type="text" name="valorOferta" id="valorOferta" class="money" required />
                    </fieldset>
                    <button type="button" name="gravar" value="ofertas" id="btnGravar">Gravar</button>
                    <button type="button" name="editar" value="ofertas" id="btnEditar">Editar</button>
                    <button type="reset" name="limpar" value="limpar" id="btnLimpar">Limpar</button>
                </form>
                <p id="mensagem"></p>
            </div>
        </div>
        <div id="proximo"></div>
    </body>
</html>
