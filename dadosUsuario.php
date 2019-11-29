<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Usuarios - CEM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./cem.png" type="image/x-icon" />
        <link rel="shortcut icon" href="cem.png" type="image/x-icon" />
        <link href="css/estilo.css" rel="stylesheet" type="text/css" />
        <link href="css/links.css" rel="stylesheet" type="text/css" />
        <link href="css/easy-autocomplete.css" rel="stylesheet" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.easy-autocomplete.js"></script>
        <script type="text/javascript" src="js/funcoes.js"></script>
    </head>
    <body id="dadosUsuario">
        <input type="checkbox" id="bt_menu" />
        <label for="bt_menu">&#9776;</label>
        <nav class="menu"></nav>
        <div class="subMenu">
            <nav>
               
            </nav>
        </div>
        <div class="container">
            <div id="divFrm">
                <form action="./registrar.php" method="POST" id="frmUsuarios">
                    <fieldset>
                        <label for="id">ID:</label>
                        <input type="text" name="id" id="id" size="5" disabled />
                        <label for="id_membro">ID Membro:</label>
                        <input type="text" name="idMembro" id="idMembro" size="5" class="selecionarId" disabled /><br />
                        <label for="email">Usuario:</label>
                        <input type="text" id="email" size="50" required disabled /><br />
                        <label for="password">Senha:</label>
                        <input type="password" name="password" id="password" required />
                        <label for="confirmarSenha">Confirmar Senha:</label>
                        <input type="password" id="confirmarSenha" required />
                    </fieldset>
                    <button type="button" name="editar" value="usuarios" id="btnEditar">Editar</button>
                    <button type="reset" name="limpar" value="limpar" id="btnLimpar">Limpar</button>
                </form>
                <p id="mensagem"></p>
            </div>
        </div>
        <div id="proximo"></div>
    </body>
</html>
