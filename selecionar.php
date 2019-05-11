<?php

require_once './init.php';
if (!isLoggedIn()) {
    
}
$btn = strtolower(substr(filter_input(INPUT_POST, "btn"), 3));
$lista = filter_input(INPUT_POST, "lista");
$substLista = substr($lista, -6);
if ($substLista == ",idade" or $substLista == "_todos") {
    $lista = substr($lista, 0, -6);
}
$val = filter_input(INPUT_POST, "val");
$listaSeparada = explode(",", $lista);
$listaOpcoes = "";
$opcoes = "";
if ($btn) {
    switch ($btn) {
        case "logs":
            $sql = "SELECT logs.id, membros.nome, logs.ip, DATE_FORMAT(logs.hora,'%d/%m/%Y - %H:%m:%s') as hora, logs.mensagem FROM logs RIGHT JOIN membros ON logs.idMembro = membros.id WHERE logs.id LIKE '%%' ORDER By id ASC";
            //$listaOpcoes = "logs.id, membros.nome, logs.ip, DATE_FORMAT(logs.hora,'%d/%m/%Y - %H:%m:%s') as hora, logs.mensagem";
            //$btn = "logs RIGHT JOIN membros ON logs.idMembro = membros.id";
            //$opcoes = "logs.id LIKE '%%' ORDER By id ASC";
            break;
        case "menu":
            $condicao = ($val == "") ? "" : "WHERE $btn.menuId='$val'";
            if ($lista == "*") {
                $sql = "SELECT menuId id, menuNome nome, menuLink, menu.idNivel, menu.menuIdPai FROM $btn $condicao ORDER BY menuId ASC";
                //$listaOpcoes = "menuId id, menuNome nome, menuLink, menu.idNivel, menu.menuIdPai";
                //$opcoes = "$btn.menuId='$val' OR $btn.menuIdPai='$val' ORDER BY menuId ASC";
            } else {
                $sql = "SELECT menuId id, menuNome, menuLink FROM $btn $condicao ORDER BY menuId ASC";
                //$listaOpcoes = "menuId id, menuNome, menuLink";
                //$opcoes = "$btn.menuId LIKE '%$val%' ORDER BY menuId ASC";
            }
            break;
        case "ofertas":
            $sql = "SELECT $lista FROM $btn WHERE $btn.id LIKE '%$val%'";
            //$listaOpcoes = $lista;
            //$opcoes = "$btn.id LIKE '%$val%'";
            break;
        case "frequentadores":
            $condicao = is_numeric($val) ? "frequentadores.id='$val'" : "frequentadores.nome LIKE '%$val%'";
            $sql = "SELECT id,nome,email,telefone,celular,dataVisita,endereco,complemento,religiao FROM frequentadores WHERE $condicao ORDER BY id ASC";
            //$listaOpcoes = $lista;
            //$opcoes = "$btn.id LIKE '%$val%' OR $btn.nome LIKE '%$val%' ORDER BY nome ASC";
            break;
        case "membros":

            //$listaOpcoes = $lista;
            //$opcoes = "membros.id='$numero' OR (membros.nome LIKE $val OR membros.email LIKE $val) AND membros.ativo='1' ORDER BY nome ASC";

            if ($lista == "*") {
                $condicao = is_numeric($val) ? "membros.id='$val'" : "membros.nome LIKE '%$val%' OR membros.email LIKE '%$val%'";
                $sql = "SELECT $btn.*, membro.NOME AS nomeEspos FROM (membros LEFT JOIN membros membro ON membros.idEspos = membro.id)
                        WHERE $condicao AND membros.ativo='1' NOT IN(membros.nome='null') ORDER BY nome ASC";
                //$listaOpcoes = $btn . "." . $listaOpcoes . ", membro.NOME AS nomeEspos";
                //$btn = "(membros INNER JOIN membros membro ON membros.idEspos = membro.id)";
            } else {
                $condicao = is_int($val) ? "membros.id='$val'" : "membros.nome LIKE '%$val%' OR membros.email LIKE '%$val%'";
                $sql = "SELECT $lista FROM $btn WHERE $condicao AND membros.ativo='1' NOT IN(membros.nome='null') ORDER BY nome ASC";
            }
            break;
        case "dizimos":
            $condicao = is_numeric($val) ? "dizimos.id='$val'" : "(membros.nome LIKE '%$val%' OR membros.email LIKE '%$val%')";
            if ($lista == "id,nome,email") {
                $sql = "SELECT membros.id, membros.nome, membros.email FROM membros WHERE (membros.nome LIKE '%$val%' OR membros.email LIKE '%$val%')";
                //$listaOpcoes = "membros.id, membros.nome, membros.email";
                //$btn = "membros";
                //$opcoes = "(membros.nome LIKE '%$val%' OR membros.email LIKE '%$val%')";
            } else {
                if ($lista == "*") {
                    $sql = "SELECT dizimos.*, FORMAT(dizimos.valorDizimo, 2, 'pt_BR') valorDizimo,membros.nome FROM (dizimos JOIN membros ON membros.id = dizimos.idMembro) WHERE $condicao ORDER BY dizimos.id ASC";
                    //$listaOpcoes = "dizimos.*, FORMAT(dizimos.valorDizimo, 2, 'pt_BR') valorDizimo,membros.nome";
                } else {
                    $sql = "SELECT dizimos.id,membros.nome, dizimos.dataDizimo, FORMAT(dizimos.valorDizimo, 2, 'pt_BR') valorDizimo FROM (dizimos JOIN membros ON membros.id = dizimos.idMembro) WHERE $condicao ORDER BY dizimos.id ASC";
                    //$listaOpcoes = "dizimos.id,membros.nome, dizimos.dataDizimo, FORMAT(dizimos.valorDizimo, 2, 'pt_BR') valorDizimo";
                }
                //$btn = "(dizimos JOIN membros ON membros.id = dizimos.idMembro)";
                //$opcoes = "dizimos.id='$val' OR (membros.nome LIKE '%$val%' OR membros.email LIKE '%$val%') ORDER BY dizimos.id ASC";
            }

            break;
        case "usuarios":
            //$btn = "membros LEFT JOIN usuarios ON membros.id = usuarios.idMembro JOIN nivel ON nivel.id = usuarios.id_nivel";
            if ($lista == "*") {
                $sql = "SELECT usuarios.id, membros.email, usuarios.password, usuarios.password confirmarSenha, nivel.id nivel FROM membros LEFT JOIN usuarios ON membros.id = usuarios.idMembro JOIN nivel ON nivel.id = usuarios.id_nivel WHERE membros.id='$val' OR (membros.nome LIKE '%$val%' OR membros.email LIKE '%$val%')";
                //$listaOpcoes = "usuarios.id, membros.email, usuarios.password, usuarios.password confirmarSenha, nivel.id nivel";
            } else {
                $sql = "SELECT membros.id, membros.email, membros.nome, nivel.nome nomeNivel, nivel.descricao FROM membros LEFT JOIN usuarios ON membros.id = usuarios.idMembro JOIN nivel ON nivel.id = usuarios.id_nivel WHERE membros.id='$val' OR (membros.nome LIKE '%$val%' OR membros.email LIKE '%$val%')";
                //$listaOpcoes = "membros.id, membros.email, membros.nome, nivel.nome nomeNivel, nivel.descricao";
            }
            //$opcoes = "membros.id='$val' OR (membros.nome LIKE '%$val%' OR membros.email LIKE '%$val%')";
            break;
        case ("ministerios" or "nivel"):
            $condicao = is_numeric($val) ? "$btn.id='$val'" : "$btn.nome LIKE '%$val%'";
            $sql = "SELECT id,nome,descricao FROM $btn WHERE $condicao ORDER BY id ASC";
            //$listaOpcoes = $lista;
            //$opcoes = "$btn.id LIKE '%$val%' OR $btn.nome LIKE '%$val%' ORDER BY id ASC";
            break;
        default:
            $sql = "SELECT $lista FROM $btn WHERE $btn.id LIKE '%$val%'";
            //$listaOpcoes = $lista;
            //$opcoes = "$btn.id LIKE '%$val%'";
            break;
    }
    //$sql = "SELECT $listaOpcoes FROM $btn WHERE " . $opcoes;
    $PDO = db_connect();
    $query = $PDO->prepare($sql);
    if ($query->execute()) {
        $dados = $query->fetchAll(PDO::FETCH_OBJ);
    }
    //echo $sql . "<br>";
    //print_r($query->errorInfo());
    echo json_encode($dados);
}
