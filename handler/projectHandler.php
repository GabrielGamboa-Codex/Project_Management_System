<?php
require  __DIR__ . '/../controllers/projectController.php';
require __DIR__ . '/../models/teamModels.php';

//llama al controlador para imprimir la tabla
if (isset($_POST['action']) && $_POST['action'] == 'printTable') 
{
    $conn = new ProjectController;
    $show = $conn->printTable();
}
//llama al controlador para  crear un Usuario
if (isset($_POST['action']) && $_POST['action'] == 'createUser') 
{
    $projectName = $_POST['userName'];
    $description = $_POST['email'];
    $teamId = $_POST['team_id'];

    $controller = new ProjectController;
    $up = $controller->createProject($projectName, $description, $teamId);
}

//llama al controlador para editar un Usuario
if (isset($_POST['action']) && $_POST['action'] == 'editUser') 
{
    $id = $_POST['id'];
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $teamId = $_POST['team_id'];

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

if (isset($_POST['action']) && $_POST['action'] == 'printOptions') 
{
    $data = new TeamModels;
    $teams = $data->printOptions();
}
