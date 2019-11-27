<?php

require './init.php';

$login = filter_input(INPUT_POST, "usuario");
$password = filter_input(INPUT_POST, "senha");

if (empty($login) and empty($password)) {
    $json = array("verifica" => 0, "mensagem" => "Por favor, preencha todos os campos");
} else {
    $PDO = db_connect();
    $sql = "SELECT usuarios.*, membros.nome, membros.email FROM usuarios INNER JOIN membros ON membros.id=usuarios.idMembro WHERE membros.email=:email";
    $query = $PDO->prepare($sql);
    $query->bindParam(':email', $login);
    $query->execute();
    $users = $query->fetchAll();
    //echo "<pre>".print_r($users, true)."</pre>";
    if (password_verify($password, $users[0]["password"])) {
        if (count($users) <= 0) {
            $json = array('verifica' => 0, 'mensagem' => "Usuário ou senha incorretos.");
            $nome = explode(" ", $user["nome"]);
            $mensagem = $nome[0] . " " . $nome[1] . " tentou acessar o sistema.";
            salvaLog($mensagem, $user["idMembro"]);
        } else {
            $user = $users[0];
            $hash = salt() . base64_encode($users[0]["email"]);
            $nivel = salt() . base64_encode($users[0]["id_nivel"]);
            $sqlSenhaPadrao = "SELECT * from senhaPadrao";
            $senha = $PDO->prepare($sqlSenhaPadrao);
            $senha->execute();
            $senhaPadrao = $senha->fetch();
            if(password_verify($password, $senhaPadrao["senha"])){
                $json = array('verifica' => 1, 'mensagem' => "Por favor, altere sua senha...", 'local' => "dadosUsuario.php", 'session' => $hash, 'nivel' => $nivel);
            }else{
                $json = array('verifica' => 1, 'mensagem' => "Login bem sucedido, aguarde...", 'local' => "home.php", 'session' => $hash, 'nivel' => $nivel);
            }
            $nome = explode(" ", $user["nome"]);
            $mensagem = $nome[0] . " " . $nome[1] . " acessou o sistema.";
            salvaLog($mensagem, $user["idMembro"]);
        }
    } else {
        $json = array('verifica' => 0, 'mensagem' => "Senha incorreta.");
        $nome = explode(" ", $users[0]["nome"]);
        $mensagem = $nome[0] . " " . $nome[1] . " tentou acessar o sistema.";
        salvaLog($mensagem, $users[0]["idMembro"]);
    }
}
echo json_encode($json);
