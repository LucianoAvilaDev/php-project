<?php

class HomeController
{
    public function index()
    {
        try{
            $postagens = Postagem::selecionarTodos();
            return $postagens;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
