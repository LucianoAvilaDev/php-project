<?php

class Comentario
{
    public static function selecionarComentários($postId)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM comentario WHERE postagem_id = :id ORDER BY id DESC";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $postId, PDO::PARAM_INT);
        $sql->execute();

        $resultado = array();

        while ($row = $sql->fetchObject('Comentario')) {
            $resultado[] = $row;
        }

        return $resultado;
    }

}