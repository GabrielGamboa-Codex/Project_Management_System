<?php
include "models/user.models.php";

class StartController
{
    private $model;

    public function __construct()
    {
        
    }
    public function Start()
    {
        require_once "views/header.php";
        require_once "views/home.view.php";
        
    }
}


?>