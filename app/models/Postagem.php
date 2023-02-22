<?php

require_once 'app/lib/database/Connection.php';
require_once 'app/models/Comentario.php';

class Postagem
{
    public static function selecionarTodos()
    {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM postagem ORDER BY id DESC";
        $sql = $conn->prepare($sql);
        $sql->execute();

        $resultado = array();

        while ($row = $sql->fetchObject('Postagem')) {
            $resultado[] = $row;
        }

        if (!$resultado) {
            throw new Exception('Nenhum resultado encontrado!');
        }

        return $resultado;
    }

    public static function selecionaPorId($postId)
    {
        $con = Connection::getConnection();

        $sql = 'SELECT * FROM postagem WHERE id = :id';
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $postId, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject('Postagem');

        if (!$resultado) {
            throw new Exception('Nenhum resultado encontrado!');
        } else {
            $resultado->comentarios = Comentario::selecionarComentários($resultado->id);
        }

        return $resultado;
    }

    public static function insert($dadosPost)
    {
        if (empty($dadosPost['titulo']) or empty($dadosPost['conteudo'])) {
            throw new Exception('Preencha todos os campos');
        }

        $conn = Connection::getConnection();
        $sql = 'INSERT INTO postagem (titulo, conteudo) VALUES (:titulo, :conteudo)';
        $sql = $conn->prepare($sql);

        $sql->bindValue(':titulo', $dadosPost['titulo']);
        $sql->bindValue(':conteudo', $dadosPost['conteudo']);

        $res = $sql->execute();

        if ($res == 0) {
            throw new Exception('Falha ao inserir dados');
        }

        return true;
    }

    public static function update($dadosPost)
    {
        if (empty($dadosPost['titulo']) or empty($dadosPost['conteudo'])) {
            throw new Exception('Preencha todos os campos');
        }

        echo ($dadosPost['id']);

        $conn = Connection::getConnection();
        $sql = 'UPDATE postagem SET titulo = :titulo, conteudo = :conteudo WHERE id = :id';
        $sql = $conn->prepare($sql);

        $sql->bindValue(':titulo', $dadosPost['titulo']);
        $sql->bindValue(':conteudo', $dadosPost['conteudo']);
        $sql->bindValue(':id', $dadosPost['id']);

        $res = $sql->execute();

        if ($res == 0) {
            throw new Exception('Falha ao alterar dados');
        }

        return true;

    }
}