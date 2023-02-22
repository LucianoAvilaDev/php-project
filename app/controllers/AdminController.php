<?php

require_once 'app/models/Postagem.php';
require_once 'app/lib/database/Connection.php';

class AdminController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('./app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('admin.html');

        $parametros = array();

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function create()
    {
        $loader = new \Twig\Loader\FilesystemLoader('./app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');

        $parametros = array();

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function insert()
    {

    }
}