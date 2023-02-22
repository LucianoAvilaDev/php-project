<?php

require_once 'app/models/Postagem.php';
require_once 'app/lib/database/Connection.php';

class SobreController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('./app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('sobre.html');

        $parametros = array();

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }
}