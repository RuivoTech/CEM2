<?php

/**
 * Conecta com o MySQL usando PDO
 */
function db_connect() {
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

    return $PDO;
}

/**
 * Cria o hash da senha, usando MD5 e SHA-1
 */
function make_hash($str) {
    return sha1(md5($str));
}

function salt() {
    $string = 'abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789';
    $retorno = '';
    for ($i = 1; $i <= 22; $i++) {
        $rand = mt_rand(1, strlen($string));
        $retorno .= $string[$rand - 1];
    }
    return $retorno;
}

/**
 * Verifica se o usuário está logado
 */
function isLoggedIn() {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        return false;
    }

    return true;
}

/**
 * Função para salvar mensagens de LOG no MySQL
 *
 * @param string $mensagem - A mensagem a ser salva
 *
 * @return bool - Se a mensagem foi salva ou não (true/false)
 */
function salvaLog($mensagem, $username) {
    $ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
    $hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
// Usamos o mysql_escape_string() para poder inserir a mensagem no banco
//   sem ter problemas com aspas e outros caracteres
// Monta a query para inserir o log no sistema
    $sql = "INSERT INTO logs(id, hora, ip, mensagem, idMembro) VALUES (NULL, ?, ?, ?, ?)";
    $PDO = db_connect();
    $query = $PDO->prepare($sql);
    $query->bindParam(1, $hora);
    $query->bindParam(2, $ip);
    $query->bindParam(3, $mensagem);
    $query->bindParam(4, $username);
    
    if ($query->execute()) {
        //echo $sql;
        return true;
    } else {
        return false;
    }
}
