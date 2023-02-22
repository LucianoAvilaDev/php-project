<?php

require_once 'app/models/Postagem.php';
require_once 'app/lib/database/Connection.php';

class PostController
{
    public function index($params)
    {
        try {
            $postagem = Postagem::selecionaPorId($params['id']);

            $loader = new \Twig\Loader\FilesystemLoader('./app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');

            $parametros = array();
            $parametros['id'] = $postagem->id;
            $parametros['titulo'] = $postagem->titulo;
            $parametros['conteudo'] = $postagem->conteudo;
            $parametros['comentarios'] = $postagem->comentarios;

            $conteudo = $template->render($parametros);

            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


}