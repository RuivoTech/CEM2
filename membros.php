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
        <script type="text/javascript" src="js/jquery.js"></script>
        <script src="js/jquery.easy-autocomplete.js"></script>
        <script type="text/javascript" src="js/funcoes.js"></script>
        <script src="js/jquery.mask.js"></script>
        <link rel="stylesheet" href="css/easy-autocomplete.css"> 
        <link href="css/estilo.css" rel="stylesheet" type="text/css" />
        <link href="css/links.css" rel="stylesheet" type="text/css" />
        
    </head>
    <body id="membros">
        <input type="checkbox" id="bt_menu" />
        <label for="bt_menu">&#9776;</label>
        <nav class="menu"></nav>
        <div class="subMenu">
            <nav>
                <button type="button" id="btnListar" value="tblMembros" class="btnMenu">Mostrar Membros</button>
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
                            <th id="tbl_dataNasc">Data Nascimento</th>
                            <th id="acoes">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="listTblBody">
                    </tbody>
                </table>
            </div>
            <div id="divFrm">
                <form action="./registrar.php" method="POST" id="frmMembros" autocomplete="off">
                    <fieldset>
                        <label for="id">ID:</label>
                        <input type="text" name="id" id="id" disabled size="5" /><br />
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" size="60" autofocus required />
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" size="60" /><br />
                        <label for="rg">RG:</label>
                        <input type="text" name="rg" id="rg" />
                        <label for="dataNasc">Data Nascimento:</label>
                        <input type="date" name="dataNasc" id="dataNasc" value="" />
                        <label for="sexo">Sexo:</label>
                        <select name="sexo" id="sexo">
                            <option value="0">Escolha...</option>
                            <option value="1">Homem</option>
                            <option value="2">Mulher</option>
                        </select><br />
                        <label for="profissao">Profissão:</label>
                        <input type="text" name="profissao" id="profissao" />
                        <label for="telefone">Telefone:</label>
                        <input type="tel" name="telefone" id="telefone" size="21" />
                        <label for="celular">Celular:</label>
                        <input type="tel" name="celular" id="celular" /><br />
                        <label for="cep">CEP:</label>
                        <input type="text" name="cep" id="cep" /><br />
                        <label for="endereco">Endereço:</label>
                        <input type="text" name="endereco" id="endereco" size="60" />
                        <label for="complemento">Complemento:</label>
                        <input type="text" name="complemento" id="complemento" /><br />
                        <label for="uf">Estado:</label>
                        <input type="text" name="uf" id="uf" />
                        <label for="cidade">Cidade:</label>
                        <input type="text" name="cidade" id="cidade" /><br />
                        <label>É batizado?</label>
                        <input type="radio" name="batizado" id="batizado_1" value="1" /> <label for="batizado_1">Sim</label>
                        <input type="radio" name="batizado" id="batizado_2" value="2" /> <label for="batizado_2">Não</label>
                        <label for="dataBatismo">Data do Batismo:</label>
                        <input type="date" name="dataBatismo" id="dataBatismo" value="" />
                        <label for="igrejaBatismo">Igreja Batizado:</label>
                        <input type="text" name="igrejaBatizado" id="igrejaBatizado" size="60" /><br />
                        <label for="ultimoPastor">Ultimo Pastor:</label>
                        <input type="text" name="ultimoPastor" id="ultimoPastor" size="60" />
                        <label for="ultimaIgreja">Ultima Igreja:</label>
                        <input type="text" name="ultimaIgreja" id="ultimaIgreja" size="60" /><br />
                        <label for="estadoCivil">Estado Civil:</label>
                        <select name="estadoCivil" id="estadoCivil">
                            <option value="0">Escolha...</option>
                            <option value="1">Solteiro(a)</option>
                            <option value="2">Casado(a)</option>
                            <option value="3">Divorciado(a)</option>
                            <option value="4">Viúvo(a)</option>
                            <option value="5">Separado(a)</option>
                        </select><br />
                        <label for="nomeEspos">Nome Esposa(o):</label>
                        <input type="text" id="nomeEspos" size="60" class="selecionarNome" disabled  />
                        <label for="idEspos">ID Esposa(o):</label>
                        <input type="text" name="idEspos" id="idEspos" class="selecionarId" disabled size="5" /><br />

                        <input type="checkbox" id="todosMinisterios" />
                        <label for="todosMinisterios" id="lblTodos">Selecionar todos</label><br />
                        <fieldset id="ministerios">
                        </fieldset>
                    </fieldset>
                    <button type="button" name="gravar" value="membros" id="btnGravar">Gravar</button>
                    <button type="button" name="editar" value="membros" id="btnEditar">Editar</button>
                    <button type="reset" name="limpar" value="limpar" id="btnLimpar">Limpar</button>
                </form>
                <p id="mensagem"></p>
            </div>
        </div>
        <div id="proximo"></div>
    </body>
</html>