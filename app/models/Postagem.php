<?php

    class Postagem{
        public static function selecionarTodos(){
            $conn = Connection::getConnection();

            $sql = "SELECT * FROM postagem ORDER BY id DESC";
            $sql = $conn->prepare($sql);
            $sql->execute();

            $resultado = array();

            while($row = $sql->fetchObject('Postagem')){
                $resultado[] = $row;
            }

            if(!$resultado){
                throw new Exception('Nenhum resultado encontrado!');
            }

            return $resultado;
        } 
    }