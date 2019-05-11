<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Frequentadores - CEM</title>
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
    <body id="frequentadores">
        <input type="checkbox" id="bt_menu" />
        <label for="bt_menu">&#9776;</label>
        <nav class="menu"></nav>
        <div class="subMenu">
            <nav>
                <button type="button" id="btnListar" value="tblFrequentadores" class="btnMenu">Mostrar Frequentadores</button>
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
                            <th id="tbl_nome">Nome</th>
                            <th id="tbl_email">E-mail</th>
                            <th id="tbl_telefone">Telefone</th>
                            <th id="tbl_celular">Celular</th>
                            <th id="tbl_dataVisita">Data Visita</th>
                            <th id="tbl_endereco">Endereço</th>
                            <th id="tbl_complemento">Complemento</th>
                            <th id="tbl_religiao">Religião</th>
                            <th id="acoes">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="listTblBody">
                    </tbody>
                </table>
            </div>
            <div id="divFrm">
                <form action="./registrar.php" method="POST" id="frmFRequentadores">
                    <fieldset>
                        <label for="id">ID:</label>
                        <input type="text" name="id" id="id" size="5" disabled /><br />
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" size="50" required autofocus/>
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" size="50" /><br />
                        <label for="telefone">Telefone:</label>
                        <input type="tel" name="telefone" id="telefone" />
                        <label for="celular">Celular:</label>
                        <input type="tel" name="celular" id="celular" /><br />
                        <label for="cep">CEP:</label>
                        <input type="text" name="cep" id="cep" size="8" /><br />
                        <label for="endereco">Endereço:</label>
                        <input type="text" name="endereco" id="endereco" size="50" />
                        <label for="complemento">Complemento</label>
                        <input type="text" name="complemento" id="complemento" /><br />
                        <label>Deseja uma visita?</label>
                        <label for="dataVisita">Data de Visita:</label>
                        <input type="date" name="dataVisita" id="dataVisita" />
                        <label for="religiao">Religião</label>
                        <input type="text" name="religiao" id="religiao" /><br />
                        <input type="radio" name="visita" id="visita_0" value="0" /><label for="visita">Sim</label><br />
                        <input type="radio" name="visita" id="visita_1" value="1" /><label for="visita">Não</label>
                    </fieldset>
                    <button type="button" name="gravar" value="frequentadores" id="btnGravar">Gravar</button>
                    <button type="button" name="editar" value="frequentadores" id="btnEditar">Editar</button>
                    <button type="reset" name="limpar" value="limpar" id="btnLimpar">Limpar</button>
                </form>
                <p id="mensagem"></p>
            </div>
        </div>
        <div id="proximo"></div>
    </body>
</html>
