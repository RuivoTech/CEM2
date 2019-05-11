<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <title>Sistema de Membros - CEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./cem.png" type="image/x-icon" />
    <link rel="shortcut icon" href="cem.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/index.js"></script>
</head>
<body>
    <div class="container" >
        <div class="content">      
            <div id="login">
                <form method="post" id="frmLogin"> 
                    <h1>Login</h1> 
                    <p> 
                        <label for="usuario">Seu e-mail</label>
                        <input id="usuario" name="usuario" required="required" type="text" placeholder="ex. ruivotech@hotmail.com" />
                    </p>
                    <p> 
                        <label for="senha">Sua senha</label>
                        <input id="senha" name="senha" required="required" type="password" placeholder="ex. senha" /> 
                    </p>
                    <p> 
                        <button type="submit" value="Logar" id="btnLogin">Logar</button>
                    </p>
                </form>
                <p id="mensagem"></p>
            </div>
        </div>
    </div>
    <div id="proximo"></div>
</body>
</html>