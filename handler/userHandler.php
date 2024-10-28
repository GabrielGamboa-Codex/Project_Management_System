<?php
require '../controllers/userController.php';
//llama al controlador para imprimir la tabla
if(isset($_POST['action']) && $_POST['action'] == 'printTable')
{
    $conn = new userController;
    $show =$conn->printTable();
}
//llama al controlador para  crear un Usuario
if(isset($_POST['action']) && $_POST['action'] == 'createUser')
{
    $username = $_POST['username']; 
    $email = $_POST['email'];;
    $pass = $_POST['pass'];;
    $team_id = $_POST['team_id'];;

    $controller = new userController;
    $up = $controller->userCreate($username,$email,$pass,$team_id);
}

//llama al controlador para editar un Usuario
if(isset($_POST['action']) && $_POST['action'] == 'editUser')
{
    $id = $_POST['id']; 
    $username = $_POST['username']; 
    $email = $_POST['email'];;
    $pass = $_POST['pass'];;
    $team_id = $_POST['team_id'];;

    $controller = new userController;
    $edit = $controller->userEdit($id,$username,$email,$pass,$team_id);
}

//llama al controlador para Eliminar un usuario
if(isset($_POST['action']) && $_POST['action'] == 'deleteUser')
{
    $id = $_POST['id']; 

    $controller = new userController;
    $edit = $controller->userDelete($id);
}


?>