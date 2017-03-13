<?php
header('Content-Type: text/html; charset=UTF-8');
header("Access-Control-Allow-Origin: *");
$f3 = require('../frameworks/f3/lib/base.php');
// Define que a pasta com classes sera a /public
$f3->set('AUTOLOAD','./models/');
// Define algumas variaveis globais iniciais
$f3->config('./setup/globals.cfg');
// Define o arquivo de configuracao de rotas
$f3->config('./setup/routes.cfg');
$f3->run();
?>
