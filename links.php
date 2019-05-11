<?php
require_once './init.php';

/**
 * Função imprimeMenuInfinito - Função recursiva utilizada para imprimir
 * menu com submenus em níveis infinitos.
 * 
 * @author MatiasRezende - contato@matiasrezende.com.br
 * @license http-~~-//creativecommons.org/licenses/by-sa/2.5/br/
 * @param array $menuTotal - Array do menu a ser impresso
 * @param $idPai - Id da categoria pai
 */
$session = filter_input(INPUT_POST, "session");
$newSession = base64_decode(substr($session, 22, strlen($session)));
$PDO = db_connect();
$userQuery = $PDO->prepare("SELECT usuarios.idMembro, usuarios.id_nivel, membros.nome FROM usuarios INNER JOIN membros ON usuarios.idMembro=membros.id WHERE membros.email='$newSession'");
$userQuery->execute();
$userDados = $userQuery->fetchAll();
$nome = $userDados[0]["nome"];
function imprimeMenuInfinito(array $menuTotal, $idPai = 0, $nivel = 0) {
    global $nome;
// abrimos a ul do menu principal
    if ($idPai == 0) {
        echo str_repeat("\t", $nivel), '<ul>', PHP_EOL;
    } else {
        echo str_repeat("\t", $nivel), '<ul>', PHP_EOL;
    }
// itera o array de acordo com o idPai passado como parâmetro na função
    foreach ($menuTotal[$idPai] as $idMenu => $menuItem) {
        // imprime o item do menu
        if ($menuItem["name"] == "Sair") {


            echo str_repeat("\t", $nivel + 1), '<li id="opcoes"><a id="sair">', $menuItem['name'], '</a>', PHP_EOL;
        } else {
            echo str_repeat("\t", $nivel + 1), '<li><a href="', $menuItem['link'], '">', $menuItem['name'], '</a>', PHP_EOL;
        }
        // se o menu desta iteração tiver submenus, chama novamente a função
        if (isset($menuTotal[$idMenu]))
            imprimeMenuInfinito($menuTotal, $idMenu, $nivel + 2);
        if ($menuItem["name"] == "Sair") {
            $nome = explode(" ", $nome);
            echo '<li id="bemVindo">' . $nome[0] . " " . $nome[1] . ' </b></li>';
        }
        // fecha o li do item do menu
        echo str_repeat("\t", $nivel + 1), '</li>', PHP_EOL;
    }
// fecha o ul do menu principal
    echo str_repeat("\t", $nivel), '</ul>', PHP_EOL;
}
$sql = "SELECT * FROM menu WHERE idNivel LIKE '%" . $userDados[0]["id_nivel"] . "%' ORDER BY menuId, menuIdPai ASC";
$query = $PDO->prepare($sql);
if ($query->execute()) {
    $dados = $query->fetchAll(PDO::FETCH_OBJ);
    foreach ($dados as $row) {
        $menuItens[$row->menuIdPai][$row->menuId] = array('link' => $row->menuLink, 'name' => $row->menuNome);
    }
}
imprimeMenuInfinito($menuItens);


/* require_once './init.php';

  $sql = "SELECT * FROM menu WHERE idNivel='1' ORDER BY menuIdPai ASC";
  $PDO = db_connect();
  $query = $PDO->prepare($sql);
  if($query->execute()){
  $dados = $query->fetchAll(PDO::FETCH_OBJ);
  }

  echo json_encode($dados);


 */
?>
<!--<nav class="menu">
    <ul>
        <li><a href="./home.php">Aniversariantes</a></li>
        <li><a href="./relatorios.php">Relatórios</a></li>
        <li><a href="./financeiro.php">Financeiro</a>
            <ul>
                <li><a href="dizimos.php">Dizimos</a></li>
                <li><a href="ofertas.php">Ofertas</a></li>
            </ul>

        </li>
        <li><a href="">Cadastro</a>
            <ul>
                <li><a href="./ministerios.php">Ministerios</a></li>
                <li><a href="./frequentadores.php">Frequentadores</a></li>
                <li><a href="./membros.php">Membros</a></li>
            </ul>
        </li>
        <li><a href="configuracoes.php">Configurações</a>
            <ul>
                <li><a href="./usuarios.php">Usuarios</a></li>
                <li><a href="./nivel.php">Nível</a></li>
                <li><a href="./menu.php">Menu</a></li>
            </ul>
        </li>
        <li id="bemVindo">
            <span><b id="nomeMenu"></b></span>
        </li>
        <li id="opcoes"><a href="sair.php">Sair</a></li>
    </ul>
</nav>
-->