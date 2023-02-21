<?php

require_once 'app/models/Postagem.php';

class HomeController
{
    public function index()
    {
        try{
            $postagens = Postagem::selecionarTodos();

            $loader = new \Twig\Loader\FilesystemLoader('./app/view');
            $twig = new \Twig\Environment($loader);

            $template = $twig->load('home.html');

            $parametros = array();
            $parametros['postagens'] = $postagens;

            $conteudo = $template->render($parametros);

            echo $conteudo;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
