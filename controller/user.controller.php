<?php
//Clase de Usuarios
class UserController
{
    public function __construct() {
       
    }
    public function Start()
    {
        require_once "views/header.php";
        require_once "views/users.views.php";
        require "models/user.models.php";

    }

    public function showTable()
    {
        $userModel = new UserModel;
        $data = $userModel->showTable();
        return json_encode($data);
        
    }
}



        
?>