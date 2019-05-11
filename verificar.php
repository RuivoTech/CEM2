<?php

require_once './init.php';
$session = filter_input(INPUT_POST, "session");
$pagina = filter_input(INPUT_POST, "page");
$usuario = base64_decode(substr($session, 22, strlen($session)));
$nome = "";
if (empty($usuario)) {
    $logado = 0;
} else {
    $PDO = db_connect();
    $sql = "SELECT usuarios.*, membros.email, membros.nome FROM usuarios INNER JOIN membros ON membros.id=usuarios.idMembro WHERE membros.email=:email";
    /* $sql = "SELECT usuarios.*, membros.nome,membros.email, menu.menuNome,menu.idNivel FROM usuarios
      INNER JOIN membros ON usuarios.idMembro = membros.id
      INNER JOIN menu ON usuarios.id_nivel = menu.idNivel
      WHERE membros.email='$usuario' AND menu.menuLink LIKE '%$page%'"; */
    $query = $PDO->prepare($sql);
    $query->bindParam(':email', $usuario);
    $query->execute();
    $users = $query->fetchAll();
    $page = "%" . $pagina . "%";
    $idNivel = "%" . $users[0]["id_nivel"] . "%";
    $sqlMenu = "SELECT menu.menuNome FROM menu WHERE menu.idNivel like ? AND menu.menuLink LIKE ?";
    $queryMenu = $PDO->prepare($sqlMenu);
    $queryMenu->bindParam(1, $idNivel);
    $queryMenu->bindParam(2, $page);
    $queryMenu->execute();
    $menu = $queryMenu->fetchAll();
    global $nome;
    if (count($users) <= 0) {
        $logado = 0;
    } else {
        if (count($menu) <= 0) {
            $logado = 2;
        } else {
            $logado = 1;
        }
    }
}
if (isset($pagina)) {
    $nome = $users[0]["nome"];
    $array = array("logado" => $logado, "nomeMenu" => $nome);
    echo json_encode($array);
}
