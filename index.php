<?php

require_once './app/core/Core.php';
require_once './app/controllers/HomeController.php';
require_once './app/controllers/ErroController.php';
require_once './app/controllers/PostController.php';
require_once './app/controllers/SobreController.php';
require_once './app/controllers/AdminController.php';
require_once './vendor/autoload.php';

$template = file_get_contents('./app/template/estrutura.html');

ob_start();
$core = new Core;
$core->start($_GET);

$saida = ob_get_contents();
ob_end_clean();

$tplPronto = str_replace('{{area_dinamica}}', $saida, $template);

echo $tplPronto;