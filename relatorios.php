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
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/relatorios.js"></script>
    </head>
    <body id="relatorios">
        <input type="checkbox" id="bt_menu" />
        <label for="bt_menu">&#9776;</label>
        <nav class="menu"></nav>
        <div class="subMenu">
            <nav>
                <button type="button" id="btnListarPessoas" value="divFiltrosPessoas" class="btnMenu">Filtrar Pessoas</button>
                <button type="button" id="btnListarDizimos" value="divFiltrosDizimos" class="btnMenu">Filtrar Dizimos</button>
            </nav>
        </div>
        <div class="container">
            <div id="divFiltrosPessoas">
                <form id="frmRelatorios">
                    <fieldset>
                        <label for="pessoa">-- Pessoa --</label><br />
                        <input type="radio" name="pessoa" id="pessoa" value="membros" checked="checked" /> <label for="pessoa">Membros</label>
                        <input type="radio" name="pessoa" id="pessoa" value="membros" /> <label for="pessoa">Frequentadores</label><br />
                        <label for="mes">Mês:</label>
                        <select name="mes" id="mes">
                            <option value="all">Mês</option>
                            <option value="01">Janeiro</option>
                            <option value="02">Fevereiro</option>
                            <option value="03">Março</option>
                            <option value="04">Abril</option>
                            <option value="05">Maio</option>
                            <option value="06">Junho</option>
                            <option value="07">Julho</option>
                            <option value="08">Agosto</option>
                            <option value="09">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select><br />
                        <label for="sexo">Sexo:</label>
                        <select name="sexo" id="sexo">
                            <option value="0">Sexo</option>
                            <option value="1">Homem</option>
                            <option value="2">Mulher</option>
                        </select><br />
                        <label id="faixa">-- Idade --</label><br />
                        <label for="min">Min:</label>    
                        <input type="text" name="faixaMin" id="faixaMin" size="5" placeholder="Min" aria-labelledby="faixa" /><br />
                        <label for="max">Max:</label>
                        <input type="text" name="faixaMax" id="faixaMax" size="5" placeholder="Max" aria-labelledby="faixa" /><br />
                        <label for="ministerios">-- Ministerios --</label><br />
                        <input type="checkbox" id="todosMinisterios" />
                        <label for="todosMinisterios" id="lblTodos">Selecionar todos</label><br />
                        <fieldset id="ministerios">
                        </fieldset>
                    </fieldset>
                    <button type="button" name="filtrar" id="btnGravar" value="filtrar">Filtrar</button>
                    <button type="reset" name="Limpar" id="btnLimpar">Limpar</button>
                </form>
            </div>
            <div id="divFiltrosDizimos">
                <form id="frmRelatorios">
                    <fieldset>
                        <label for="pessoa">-- Dizimo --</label><br />
                        <label for="mes">Mês:</label>
                        <select name="mes" id="mes">
                            <option value="all">Mês</option>
                            <option value="01">Janeiro</option>
                            <option value="02">Fevereiro</option>
                            <option value="03">Março</option>
                            <option value="04">Abril</option>
                            <option value="05">Maio</option>
                            <option value="06">Junho</option>
                            <option value="07">Julho</option>
                            <option value="08">Agosto</option>
                            <option value="09">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select><br />
                        <label for="sexo">Sexo:</label>
                        <select name="sexo" id="sexo">
                            <option value="0">Sexo</option>
                            <option value="1">Homem</option>
                            <option value="2">Mulher</option>
                        </select><br />
                        <label id="faixa">-- Idade --</label><br />
                        <label for="min">Min:</label>    
                        <input type="text" name="faixaMin" id="faixaMin" size="5" placeholder="Min" aria-labelledby="faixa" /><br />
                        <label for="max">Max:</label>
                        <input type="text" name="faixaMax" id="faixaMax" size="5" placeholder="Max" aria-labelledby="faixa" /><br />
                        
                    </fieldset>
                    <button type="button" name="filtrar" id="btnGravar" value="filtrar">Filtrar</button>
                    <button type="reset" name="Limpar" id="btnLimpar">Limpar</button>
                </form>
            </div>
            <div id="divTabela">
                <table id="tblMembros">
                    <thead id="listTblHead">
                        <tr>
                            <th id="tbl_id">ID</th>
                            <th id="tbl_nome">Nome</th>
                            <th id="tbl_telefone">Telefone</th>
                            <th id="tbl_dataNasc">Data Nascimento</th>
                            <th id="tbl_idade">Idade</th>
                        </tr>
                    </thead>
                    <tbody id="listTblBody">
                    </tbody>
                </table>
            </div>
        </div>
        <div id="proximo"></div>
    </body>
</html>
