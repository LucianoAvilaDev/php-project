<?php

require_once 'app/lib/database/Connection.php';

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
        }

        return $resultado;
    }
}