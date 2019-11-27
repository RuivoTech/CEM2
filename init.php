<?php
// header('Access-Control-Allow-Origin: *');
// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOST', 'localhost');
define('DB_USER', 'richieri');
define('DB_PASS', 'Beatricy1812@');
define('DB_NAME', 'systemcem');
 
// habilita todas as exibições de erros
error_reporting(E_ALL);
ini_set('display_errors', 1);
 
// inclui o arquivo de funçõees
require_once 'functions.php';
