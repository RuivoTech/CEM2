<?php

require_once './init.php';
require_once './verificar.php';
$data = filter_input_array(INPUT_POST);
$campos = null;
$valores = null;
$first = true;
$PDO = db_connect();
$mensagemLog;

foreach ($data as $campo => $valor) {
//while (list($campo, $valor) = each($data)) {
    if (substr($campo, 0, 4) == "data" and $valor == "") {
        $valor = "0000-00-00";
    }
    if (substr($campo, 0, 5) == "valor") {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
    }
    if ($campo == "btn" or $campo == "session") {

        break;
    }
    if (filter_input(INPUT_POST, "btn") == "gravar") {

        $gravar = filter_input(INPUT_POST, "gravar");
        $id = filter_input(INPUT_POST, "id");
        if ($gravar == "usuarios") {
            $verificaSql = "SELECT usuarios.password FROM usuarios WHERE id='$id'";
            $query = $PDO->prepare($verificaSql);
            $query->execute();
            $dados = $query->fetch();
            $password = filter_input(INPUT_POST, "password");
            if ($dados["password"] == $password) {
                
            } else {
                if ($campo == "password") {
                    $valor = crypt($password, '$2a$10$' . salt() . '$');
                }
            }
        }
        if ($campos == null and $valores == null) {
            $campos = $campo;
            $valores = "'" . $valor . "'";
        } else {
            if ($gravar == "dizimo" and $campo == "nome") {
                $campos = $campo;
            } else {
                $campos = $campos . ", " . $campo;
                $valores = $valores . ", '" . $valor . "'";
            }
        }

        $sql = "INSERT INTO " . $gravar . "(" . $campos . ")VALUES(" . $valores . ")";
    } elseif (filter_input(INPUT_POST, "btn") == "editar") {

        $editar = filter_input(INPUT_POST, "editar");

        if ($editar == "menu") {
            $sqlId = "menuId";
            $id = filter_input(INPUT_POST, "menuId");
        } else {
            $sqlId = "id";
            $id = filter_input(INPUT_POST, "id");
        }
        if ($editar == "usuarios") {
            $verificaSql = "SELECT usuarios.password FROM usuarios WHERE id='" . $id . "'";
            $query = $PDO->prepare($verificaSql);
            $query->execute();
            $dados = $query->fetch();
            $password = filter_input(INPUT_POST, "password");
            if ($campo == "password" && $dados["password"] != $valor) {
                $valor = crypt($password, '$2a$10$' . salt() . '$');
            }
        }
        if ($first) {
            $resultado = $editar . "." . $campo . "='" . $valor . "'";
            $first = false;
        } else {
            $resultado = $editar . "." . $campo . "='" . $valor . "', " . $resultado;
        }
        $sql = "UPDATE " . $editar . " SET " . $resultado . " WHERE " . $editar . "." . $sqlId . "='" . $id . "'";
    }
}

if (filter_input(INPUT_POST, "btn") == "excluir") {
    $id = filter_input(INPUT_POST, "id");
    $sql = "DELETE FROM " . filter_input(INPUT_POST, "excluir") . " WHERE id=" . $id;
}

$query = $PDO->prepare($sql);
foreach ($data as $col => $val) {
    $query->bindParam($col, $val);
    if (filter_input(INPUT_POST, "btn") == "editar" && isset($data["id"])) {
        $id = $data["id"];
    }
}
$username = $users[0]["idMembro"];
if ($query->execute()) {
    global $mensagemLog;
    $btn = filter_input(INPUT_POST, "btn");
    $lastId = $PDO->lastInsertId();
    if ($btn == "gravar") {
        global $mensagemLog;
        $gravar = filter_input(INPUT_POST, "gravar");
        $mensagem = "Cadastro feito com sucesso!";
        $mensagemLog = $users[0]["nome"] . " cadastrou \"" . $gravar . "\" ID:" . $lastId;
    } elseif ($btn == "editar") {
        global $mensagemLog;
        $editar = filter_input(INPUT_POST, "editar");
        $mensagem = "Atualização feita com sucesso!";
        $mensagemLog = $users[0]["nome"] . " editou \"" . $editar . "\" ID:" . $id;
    } elseif ($btn == "excluir") {
        global $mensagemLog;
        $excluir = filter_input(INPUT_POST, "excluir");
        $mensagem = "Remoção feita com sucesso!";
        $mensagemLog = $users[0]["nome"] . " excluiu \"" . $excluir . "\" ID:" . $id;
    } else {
        $mensagem = "Erro! ";
    }
    salvaLog($mensagemLog, $username);
    $json = array('verifica' => 0, 'mensagem' => $mensagem);
} else {
    global $mensagemLog;
    if ($query->errorCode() == 23000) {
        $mensagem = "Erro! $gravar já cadastrado.";
    } else {
        $mensagem = "Erro!";
    }
    salvaLog($mensagemLog, $username);
    $json = array('verifica' => 1, 'mensagem' => $mensagem);
}
//echo $sql . "<br>";
//print_r($query->errorInfo());
//print_r($data,true);

echo json_encode($json);
