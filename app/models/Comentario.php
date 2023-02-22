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

    public static function insert($data)
    {
        $conn = Connection::getConnection();

        $postagem_id = $data['id'];
        $nome = $data['nome'];
        $mensagem = $data['mensagem'];


        $sql = "INSERT INTO comentario (nome, mensagem, postagem_id) VALUES (:nome, :mensagem, :postagem_id)";
        $sql = $conn->prepare($sql);

        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':mensagem', $mensagem);
        $sql->bindValue(':postagem_id', $postagem_id, PDO::PARAM_INT);

        $res = $sql->execute();

        if ($res == 0) {
            throw new Exception('Falha ao inserir dados');
        }

        return true;
    }

}