<?php
require  __DIR__ . '/../controllers/userController.php';
require __DIR__ . '/../models/teamModels.php';

//llama al controlador para imprimir la tabla
if (isset($_POST['action']) && $_POST['action'] == 'printTable') 
{
    $conn = new UserController;
    $show = $conn->printTable();
}
//llama al controlador para  crear un Usuario
if (isset($_POST['action']) && $_POST['action'] == 'createUser') 
{
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $teamId = $_POST['team_id'];

    $controller = new UserController;
    $up = $controller->createUser($userName, $email, $pass, $teamId);
}

//llama al controlador para editar un Usuario
if (isset($_POST['action']) && $_POST['action'] == 'editUser') 
{
    $id = $_POST['id'];
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $teamId = $_POST['teamId'];

    $controller = new UserController;
    $edit = $controller->editUser($id, $userName, $email, $pass, $teamId);
}

//llama al controlador para Eliminar un usuario
if (isset($_POST['action']) && $_POST['action'] == 'deleteUser') 
{
    $id = $_POST['id'];

    $controller = new UserController;
    $edit = $controller->deleteUse($id);
}

//Imprime las Opciones del select
if (isset($_POST['action']) && $_POST['action'] == 'printOptions') 
{
    $data = new TeamModel;
    $teams = $data->printOptions();
}
