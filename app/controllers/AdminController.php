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

        $objPostagens = Postagem::selecionarTodos();

        $parametros = array();
        $parametros['postagens'] = $objPostagens;

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
        try {
            Postagem::insert($_POST);

            echo '<script>alert("Publicação inserida com sucesso!")</script>';
            echo '<script>location.href="?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '")</script>';
            echo '<script>location.href="?pagina=admin&metodo=create"</script>';
        }
    }

    public function change($params)
    {
        $postagem = Postagem::selecionaPorId($params['id']);

        $loader = new \Twig\Loader\FilesystemLoader('./app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');

        $parametros = array();

        $parametros = array();
        $parametros['titulo'] = $postagem->titulo;
        $parametros['conteudo'] = $postagem->conteudo;
        $parametros['id'] = $postagem->id;

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function update()
    {
        try {
            Postagem::update($_POST);
            echo '<script>alert("Publicação alterada com sucesso!")</script>';
            echo '<script>location.href="?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '")</script>';
            echo '<script>location.href="?pagina=admin&metodo=change&id={{ $_POST["id"] }}</script>';
        }
    }

    public function delete($params)
    {
        try {
            Postagem::delete($params['id']);
            echo '<script>alert("Publicação deletada com sucesso!")</script>';
            echo '<script>location.href="?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '")</script>';
            echo '<script>location.href="?pagina=admin&metodo=index"</script>';
        }
    }

    public function addComentario()
    {
        try {
            Comentario::insert($_POST);
            header('Location:?pagina=post&id=' . $_POST["id"] . '');
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '")</script>';
            echo '<script>location.href="?pagina=admin&metodo=change&id={{ $_POST["id"] }}</script>';
        }
    }

}