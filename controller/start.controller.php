<?php

class StartController
{
    private $model;

    public function __construct()
    {
        //$this->model = new Productos;
    }
    public function Start()
    {
        $conection = Database::Connection();
        require_once "views/header.php";
        require_once "views/home.view.php";
    }
}


?>